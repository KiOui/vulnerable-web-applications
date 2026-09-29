<?php

// Common functions file

// Function to connect to the database
function connectDB()
{
    try {
        $con = new PDO("mysql:host=localhost;dbname=store", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

// Function to sanitize inputs
function sanitize($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}
