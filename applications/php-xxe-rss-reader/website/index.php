<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <a href="index.php"><title>Smart RSS Reader</title></a>
    <link type="text/css" rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">

        <center>
        <h1><a href="index.php" style="text-decoration: none; color: inherit;">Smart RSS Reader</a></h1>
           
            <fieldset class="generate_form">
                <form action="/read.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="rssfile" accept=".xml" required><br>
                    <input type="submit" value="Let's start reading!" class="btn">
                </form>
            </fieldset>
            <br>
            <img src="readingcat.webp" alt="Reading Cat">
        </center>
    </div>
</body>
</html>
