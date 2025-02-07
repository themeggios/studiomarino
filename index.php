<html>
<body>

<p><b>Ricerca AJAX</b></p>
<form action="">
  <label for="fname">Nome:</label>
  <input type="text" id="Nome" name="Nome" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>

<script>
    function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "public/ricerca.php?query=" + str, true);
    xmlhttp.send();
  }
}
</script>

<?php

// connessione al database
require "db/db.php";

// prepara ed esegue la query
$sql = "SELECT * FROM animalimarini;";
$result = $conn->query($sql);

// crea una tabella 
echo '<table>';
echo '<tr><th>Nome</th><th>Lat</th><th>Lon</th><th>Specie</th><th>Descrizione</th><th>Avvistamento</th></tr>';

// cicla il database e popola la tabella
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo "<td>{$row['Nome']}</td>";
        echo "<td>{$row['Latitudine']}</td>";
        echo "<td>{$row['Longitudine']}</td>";
        echo "<td>{$row['Specie']}</td>";
        echo "<td>{$row['Descrizione']}</td>";
        echo "<td>{$row['DataAvvistamento']}</td>";
        echo '</tr>';
    }
} 

echo '</table>';

// chiude la connessione
$conn->close();

?>
</body>
</html>