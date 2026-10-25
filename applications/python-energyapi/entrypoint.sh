#!/bin/sh

set -e

echo "Initializing MongoDB"
uv run python -m app.init_db

echo "Starting uvicorn"
exec uv run uvicorn main:app --host 0.0.0.0 --port 80