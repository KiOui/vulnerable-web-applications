#!/bin/sh

echo "🔍 Checking database connection..."
uv run manage.py check --database=default

echo "📊 Checking migration status..."
uv run manage.py showmigrations --plan

echo "🚀 Running migrations..."
uv run manage.py migrate --noinput

echo "🌐 Starting uWSGI server..."
uv run uwsgi --http :80 --wsgi-file /app/catscore/wsgi.py --master --processes 4 --threads 2 --enable-threads --py-call-uwsgi-fork-hooks --uid nobody --gid nogroup --disable-logging --static-map ${DJANGO_STATIC_URL}=${DJANGO_STATIC_ROOT} --static-map ${DJANGO_MEDIA_URL}=${DJANGO_MEDIA_ROOT}