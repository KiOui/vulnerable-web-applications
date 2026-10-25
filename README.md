# Vulnerable Web Applications

This repository contains intentionally vulnerable web applications for security education and secure-development practice. The applications are designed to run in local, isolated environments; do not expose them to the public internet or use them against systems you do not own or have permission to test.

# WARNING: THESE APPLICATIONS ARE VULNERABLE TO HACKING

> This repository intentionally contains exploitable security vulnerabilities. Run the applications only in an isolated environment for authorized education and testing. Never expose them to the public internet or deploy them in production.

## Applications

- [Apache RetroGame](applications/apache-retrogame/README.md): a retro-themed static site illustrating the risks of outdated web-server software and unsafe server configuration.
- [Electravia](applications/php-electravia/README.md): a superhero fan-club site demonstrating unsafe file inclusion in PHP.
- [Hackerstore](applications/php-hackerstore/README.md): a PHP shopping site focused on business-logic and cart-validation weaknesses.
- [PHP XXE RSS Reader](applications/php-xxe-rss-reader/README.md): an RSS feed uploader that illustrates risks in parsing untrusted XML.
- [CatScore](applications/python-catscore/README.md): a Django cat-score site demonstrating unsafe SQL query construction.
- [EnergyAPI](applications/python-energyapi/README.md): a FastAPI service for energy data that demonstrates unsafe NoSQL query handling and weak JWT configuration.

## Local Testing

Every application has a `test/` directory containing a `docker-compose.yml` file that starts its local test environment. Docker and the Docker Compose plugin are required. From the application's directory, run:

```sh
docker compose -f test/docker-compose.yml up --build
```

The applications are exposed on host port 80 by default, so make sure that port is available. Stop the test environment with:

```sh
docker compose -f test/docker-compose.yml down
```

These compose files provide runnable environments for manual testing; they do not run an automated test suite.
