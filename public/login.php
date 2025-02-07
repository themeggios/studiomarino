<?php
// include il file per la navbar e la connessione al database
require "navbar.php";
require "db.php";

// verifica se il metodo di richiesta è POST (indicando che il modulo è stato inviato)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // recupera i dati dal modulo
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // prepara la query SQL per cercare l'utente nel database
    $sql = "SELECT email, username, password, ruolo FROM utenti WHERE username = ?";
    // crea un'istruzione preparata
    $stmt = $conn->prepare($sql);
    // binda il parametro alla query
    $stmt->bind_param("s", $username);
    // esegue la query
    $stmt->execute();
    // ottiene il risultato della query
    $result = $stmt->get_result();

    // controlla se è stato trovato un utente
    if ($result->num_rows == 1) {
        // recupera i dati dell'utente
        $row = $result->fetch_assoc();
        // verifica se la password fornita corrisponde a quella memorizzata
        if (password_verify($password, $row['password'])) {
            // se la password è corretta, imposta le variabili di sessione
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['ruolo'] = $row['ruolo'];
            // reindirizza l'utente alla pagina principale
            header("Location: index.php");
            exit(); // termina lo script per evitare ulteriori output
        } else {
            // se la password non è valida, imposta un messaggio di errore
            $error = "Password non valida";
        }
    } else {
        // se l'username non è stato trovato, imposta un messaggio di errore
        $error = "Username non trovato";
    }
}
?>

<div class="form-container">
<h2>Login</h2>
<?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; // mostra eventuali errori ?>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<p>Non hai un account? <a href="registrazione.php">Registrati qui</a></p>
</div>
</body>
</html>