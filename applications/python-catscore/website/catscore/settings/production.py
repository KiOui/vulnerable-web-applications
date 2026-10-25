import os
from .base import *

SECRET_KEY = os.environ.get("DJANGO_SECRET_KEY")

DEBUG = False

ALLOWED_HOSTS = os.environ.get("DJANGO_ALLOWED_HOSTS", "").split(",")

SESSION_COOKIE_SECURE = True

# Database
# https://docs.djangoproject.com/en/4.2/ref/settings/#databases

DATABASES = {
    "default": {
        "ENGINE": "django.db.backends.postgresql",
        "NAME": os.environ.get("POSTGRES_DB"),
        "USER": os.environ.get("POSTGRES_USER"),
        "PASSWORD": os.environ.get("POSTGRES_PASSWORD"),
        "HOST": os.environ.get("POSTGRES_HOST"),
        "PORT": os.environ.get("POSTGRES_PORT"),
        # Keep DB connections warm so we don't re-resolve `database` DNS
        # and re-handshake Postgres on every request. Health-checks the
        # cached connection cheaply before reuse, so a stale socket from
        # a Postgres restart drops cleanly instead of erroring out — which
        # was the root cause of the sporadic "could not translate host
        # name 'database'" Sentry events.
        "CONN_MAX_AGE": 600,
        "CONN_HEALTH_CHECKS": True,
    }
}

# Static files (CSS, JavaScript, Images)
# https://docs.djangoproject.com/en/4.2/howto/static-files/

STATICFILES_STORAGE = "django.contrib.staticfiles.storage.ManifestStaticFilesStorage"

STATIC_URL = os.environ.get("DJANGO_STATIC_URL")
MEDIA_URL = os.environ.get("DJANGO_MEDIA_URL")

STATIC_ROOT = os.environ.get("DJANGO_STATIC_ROOT")
MEDIA_ROOT = os.environ.get("DJANGO_MEDIA_ROOT")


# Logging
# https://docs.djangoproject.com/en/3.2/topics/logging/

LOGGING = {
    "version": 1,
    "disable_existing_loggers": False,
    "handlers": {
        "file": {
            "level": "ERROR",
            "class": "logging.FileHandler",
            "filename": "/var/log/django.log",
        },
        "console": {
            "level": "WARNING",
            "class": "logging.StreamHandler",
        },
    },
    "root": {
        "handlers": ["console"],
        "level": "WARNING",
    },
    "loggers": {
        "django": {
            "handlers": ["file", "console"],
            "level": "WARNING",
            "propagate": False,
        },
    },
}
