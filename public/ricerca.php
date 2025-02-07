<?php

// connessione al database
require "../db/db.php";

if (isset($_GET['query'])) {
    $query = ($_GET['query']);
    $sql = "SELECT * FROM animalimarini WHERE nome LIKE '%$query%'";
    $result = $conn->query($sql);

    $output = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '<p>' . $row['Nome'] . ' - ' . $row['Descrizione'] . ' - ' . $row['Latitudine'] . ' - ' . $row['Longitudine'] . ' - ' . $row['Specie'] . ' - ' . $row['DataAvvistamento'] .  '</p>';
        }
    } else {
        $output = 'Nessun risultato trovato';
    }

    echo $output;
}

$conn->close();
?>