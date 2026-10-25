# Electravia

## Description
Electravia is a superhero fan-club website with pages selected dynamically by a PHP entrypoint. Its file-loading behavior is intentionally vulnerable for secure-development training.

## Vulnerability Focus
Local file inclusion caused by using request input to choose a PHP file.

## Technology
PHP with Apache HTTP Server.

## Solution
[`index.php`](electravia/www/index.php) includes user input with a fixed suffix:
```php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    include($file . '.php');
}
```
Because `.php` is appended, use the `php://filter` wrapper to disclose source, e.g. read `index.php` back as base64:
```
/index.php?file=php://filter/convert.base64-encode/resource=index
```
The check uses exactly this to confirm the LFI. To reach the flag at `/tmp/flag.txt` (the `.php` suffix blocks a direct read), use a `php://filter` chain to gain code execution and `cat` it.

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
Map user-facing page names to a fixed allow-list; never pass untrusted request data to `include` or `require`.
