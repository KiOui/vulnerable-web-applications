from django.contrib.auth.mixins import LoginRequiredMixin
from django.views.generic import TemplateView
from django.contrib.auth import get_user_model, login
from django.utils.http import url_has_allowed_host_and_scheme
from django.conf import settings
from django.shortcuts import resolve_url
from django.db import ProgrammingError, connection
from django.views.generic.edit import FormView
from .forms import InjectableLoginForm
from .hashers import UnsaltedMD5PasswordHasher

User = get_user_model()


class IndexView(LoginRequiredMixin, TemplateView):
    template_name = "catscore/index.html"


class CommentsView(LoginRequiredMixin, TemplateView):
    template_name = "catscore/comments.html"


class AboutView(LoginRequiredMixin, TemplateView):
    template_name = "catscore/about.html"


class VulnerableLoginView(FormView):
    """
    INTENTIONALLY VULNERABLE — for classroom/demo use only.
    Builds raw SQL via string interpolation instead of parameterized
    queries, so it's susceptible to SQL injection.
    """

    template_name = "catscore/login.html"
    form_class = InjectableLoginForm

    def get_success_url(self):
        next_url = self.request.POST.get("next") or self.request.GET.get("next")

        if next_url and url_has_allowed_host_and_scheme(
            url=next_url,
            allowed_hosts={self.request.get_host()},
            require_https=self.request.is_secure(),
        ):
            return next_url

        return resolve_url(settings.LOGIN_REDIRECT_URL)

    def form_valid(self, form):
        username = form.cleaned_data["username"]
        password = form.cleaned_data["password"]

        # VULNERABLE: username is interpolated directly into the query.
        query = (
            "SELECT id, username, password, is_superuser "
            f"FROM auth_user WHERE username = '{username}' LIMIT 1"
        )

        with connection.cursor() as cursor:
            # Only run `executescript` when running in DEBUG mode as this is an SQLite only function.
            if settings.DEBUG is True:
                # This executes multiple queries when the user is trying to inject.
                connection.connection.executescript(query)

            # Separate, clean SELECT to retrieve the row for the login check.
            try:
                cursor.execute(query)
                row = cursor.fetchone()
            except ProgrammingError:
                return self.render_to_response(
                    self.get_context_data(form=form, login_failed=True)
                )

        if row:
            user_id, _, hashed_password, _ = row
            hasher = UnsaltedMD5PasswordHasher()
            if hasher.verify(password, hashed_password):
                # Fetch the real User instance — login() needs a model
                # instance, not the raw tuple from the cursor.
                user = User.objects.get(pk=user_id)

                # We skip authenticate() here (since we did our own raw
                # lookup), so Django requires us to specify which auth
                # backend "vouches" for this user.
                user.backend = "django.contrib.auth.backends.ModelBackend"
                login(self.request, user)
                return super().form_valid(form)

        return self.render_to_response(
            self.get_context_data(form=form, login_failed=True)
        )

    def form_invalid(self, form):
        return self.render_to_response(self.get_context_data(form=form))
