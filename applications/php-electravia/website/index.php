<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Superhelden Fan Club</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .navbar {
            background-color: #2d2d30;
        }
        .navbar-brand, .nav-link {
            color: #d5d5d5 !important;
        }
        .navbar-nav .nav-link:hover {
            color: #fff !important;
        }
        .hero-theme {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .hero-theme h1 {
            font-size: 2.5rem;
        }
        .hero-theme p {
            font-size: 1.2rem;
        }
        footer {
            background-color: #2d2d30;
            color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }
        footer a {
            color: #f5f5f5;
        }
        footer a:hover {
            color: #777;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center 
            py-3 mb-4 border-bottom navbar navbar-expand-lg navbar-dark">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 
                me-md-auto text-dark text-decoration-none navbar-brand">
                <span class="fs-4">Superhelden Fan Club</span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="/" class="nav-link" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="/403.php" class="nav-link">Superhelden Video's</a></li>
                <li class="nav-item"><a href="/index.php?file=users" class="nav-link">Gebruikers</a></li>
            </ul>
        </header>

        <div class="hero-theme text-center">
            <h1>Welkom bij de Superhelden Fan Club</h1>
            <p>Ontdek de geweldige helden die strijden voor de bescherming van onze energiesector!</p>
        </div>

        <?php
        if (isset($_GET['file'])) {
            $file = $_GET['file'];
            include($file . '.php');
        } else {
            $html = file_get_contents('home.html');
            echo ($html);
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Superhelden Fan Club. Alle rechten voorbehouden.</p>
        <p><a href="#">Privacybeleid</a> | <a href="#">Voorwaarden</a></p>
    </footer>
</body>
</html>
