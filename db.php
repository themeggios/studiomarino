<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studiomarino";

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>