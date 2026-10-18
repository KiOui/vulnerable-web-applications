<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart RSS Reader</title>
    <link type="text/css" rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <center>
        <h1><a href="index.php" style="text-decoration: none; color: inherit;">Smart RSS Reader</a></h1>
    </center>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['rssfile'])) {
    $file = $_FILES['rssfile']['tmp_name'];
    $fileType = mime_content_type($file);

    if ($fileType !== 'application/xml' && $fileType !== 'text/xml') {
        die("Invalid file type. Please upload an XML file.");
    }

    $content = file_get_contents($file);

    if ($content === false) {
        die("Unable to read the uploaded file.");
    }

    ##libxml_disable_entity_loader(true);
    $doc = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOENT);

    if ($doc === false) {
        die("Error parsing the XML file.");
    }

    echo "<h1>" . htmlentities($doc->title) . "</h1><br/>";
    echo "<b>Description:</b><br><blockquote>" . htmlentities($doc->subtitle) . "</blockquote><br/>";

    $items = $doc->entry ?? [];
    foreach ($items as $item) {
        if (isset($item->link) && isset($item->title) && isset($item->content)) {
            echo "<h3><a href='" . htmlentities($item->link->href) .
                "'>" . htmlentities($item->title) . "</a><br/></h3>";
            echo "<blockquote>" . htmlentities($item->content) . "</blockquote><br/>";
        }
    }
} else {
    die("No file uploaded.");
}

?>
</div>


</body>
</html>
