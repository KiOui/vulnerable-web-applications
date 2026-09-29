<?php
$host = getenv('MYSQL_HOST') ?: 'database';
$name = getenv('MYSQL_DATABASE') ?: 'store';
$user = getenv('MYSQL_USER') ?: 'store';
$pass = getenv('MYSQL_PASSWORD') ?: 'password';

// Wait until the database is reachable.
$pdo = null;
for ($i = 1; $i <= 30; $i++) {
    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$name;charset=utf8mb4",
            $user, $pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        break;
    } catch (PDOException $e) {
        echo "Database not ready yet...\n";
        sleep(2);
    }
}
if (!$pdo) {
    fwrite(STDERR, "Database unreachable\n");
    exit(1);
}

if ( ! ( (bool) $pdo->query("SHOW TABLES LIKE 'items';")->fetchColumn() ) ) {
    $pdo->exec("
        CREATE TABLE `items` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `price` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $pdo->exec("
        INSERT INTO `items` (`id`, `name`, `price`) VALUES
            (1, 'Flipper', 230),
            (2, 'Hoody', 80),
            (3, 'Lockpick set', 30),
            (4, 'Rubber ducky', 150),
            (5, 'Flag', 1337);
    ");
    echo "Created and initialized table 'items'";
}

if ( ! ( (bool) $pdo->query("SHOW TABLES LIKE 'users';")->fetchColumn() ) ) {
    $pdo->exec("
        CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255)  NULL,
            `email` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `contact` varchar(255)  NULL,
            `city` varchar(255)  NULL,
            `address` varchar(255)  NULL,
            `budget` decimal(10,2) NOT NULL DEFAULT 0.00
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $pdo->exec("
        INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`, `budget`) VALUES
            (1, 'admin', 'admin@admin.nl', '57f231b1ec41dc6641270cb09a56f897', '8899889988', 'Indore', '100 palace colony, Indore', 0.00),
            (2, 'John Doe', 'john@example.com', 'password', '1234567890', 'City', 'Address', 0.00),
            (3, 'Jane Doe', 'jane@example.com', 'password', '0987654321', 'City', 'Address', 0.00);
    ");
    echo "Created and initialized table 'users'";
}

if ( ! ( (bool) $pdo->query("SHOW TABLES LIKE 'users_items';")->fetchColumn() ) ) {
    $pdo->exec("
        CREATE TABLE `users_items` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` int(11) NOT NULL,
            `item_id` int(11) NOT NULL,
            `quantity` int(11) NOT NULL,
            `status` enum('Added to cart','Confirmed') NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $pdo->exec("
        ALTER TABLE `users_items`
            ADD CONSTRAINT `users_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            ADD CONSTRAINT `users_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
    ");
    echo "Created table 'users_itesm'";
}

echo "Database initialized";
