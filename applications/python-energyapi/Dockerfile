FROM python:3.14-slim

# Set environment variables
ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

# Install system dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends curl \
    && rm -rf /var/lib/apt/lists/*

# Install uv
ADD https://astral.sh/uv/install.sh /uv-installer.sh
RUN sh /uv-installer.sh && rm /uv-installer.sh
ENV PATH="/root/.local/bin/:$PATH"
ENV UV_NO_DEV=1

# Set the working directory in the container
WORKDIR /app

# Copy only the requirements file to leverage Docker cache
COPY pyproject.toml uv.lock /app/

# Install dependencies
RUN uv sync --locked --group prod

# Copy the current directory contents into the container at /app
COPY website /app
COPY entrypoint.sh /

EXPOSE 80

# Command to run uWSGI
CMD ["/bin/sh", "/entrypoint.sh"]