import os

from .base import *

SECRET_KEY = "django-insecure-=_1fy-d9@4z#=^-%l4snxp7_9zg7reom5q1rn+)$lb2bw(j0on"

DEBUG = True

ALLOWED_HOSTS = []

# Databases
# https://docs.djangoproject.com/en/3.2/ref/databases/

DATABASES = {
    "default": {
        "ENGINE": "django.db.backends.sqlite3",
        "NAME": os.path.join(BASE_DIR, "db.sqlite3"),
    }
}

# Static files (CSS, JavaScript, Images)
# https://docs.djangoproject.com/en/3.2/howto/static-files/

STATIC_ROOT = BASE_DIR / "static"
STATIC_URL = "/static/"

MEDIA_ROOT = BASE_DIR / "media"
MEDIA_URL = "/media/"
