import secrets

from django.conf import settings
from django.db import migrations

USERNAMES = [
    *(f"Client{number}" for number in range(1, 21)),
    "eve",
    "rick",
    "bob",
    "alice",
]


def create_default_users(apps, schema_editor):
    app_label, model_name = settings.AUTH_USER_MODEL.split(".")
    user_model = apps.get_model(app_label, model_name)
    user_manager = user_model._default_manager.db_manager(
        schema_editor.connection.alias
    )

    for username in USERNAMES:
        if not user_manager.filter(username=username).exists():
            user_manager.create_user(
                username=username,
                password=secrets.token_urlsafe(32),
            )


class Migration(migrations.Migration):
    initial = True

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
    ]

    operations = [
        migrations.RunPython(create_default_users, migrations.RunPython.noop),
    ]
