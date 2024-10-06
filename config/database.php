<?php
const HOST = "localhost";
const USER = "root";
const PASSWORD = "";
const DATABASE = "artbox";

try {
    $db = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    // ...
}
