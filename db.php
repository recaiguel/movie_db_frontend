<?php

// Verbindungdaten zur Datenbank
$host = 'localhost';
$dbname = 'filmdb';
$user = 'avenger';
$password = '3ndG4m3';


// Aufbau der Verbindung zur Datenbank 
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>