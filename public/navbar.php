<?php
session_start();
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>

 <!-- Barra di navigazione -->
 <nav>
  <ul>
    <li><a href="index.php">Home</a></li>

    <?php if (isset($_SESSION['email'])): ?>
      <li><a href="inserisci.php">Inserisci ricetta</a></li>
        <?php if ($_SESSION['ruolo'] == 'admin'): ?>
          <li><a href="admin.php">Amministrazione</a></li>
        <?php elseif ($_SESSION['ruolo'] == 'moderator'): ?>
          <li><a href="gestisci_ricette.php">Gestione ricette</a></li>
        <?php else: ?>
          <li><a href="gestisci_ricette.php">Le mie ricette</a></li>
        <?php endif; ?>
      <li class="nav-right"><a href="logout.php">Logout</a></li>
    <?php else: ?>
      <li class="nav-right"><a href="login.php">Login</a></li>
      <li class="nav-right"><a href="registrazione.php">Registrazione</a></li>
    <?php endif; ?>

  </ul>
</nav>