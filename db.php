<?php

// Verbindungdaten zur Datenbank
$host = 'localhost';
$dbname = 'filmdb';
$user = 'avenger';
$password = '3ndG4m3';


// Aufbau der Verbindung zur Datenbank 
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);

?>