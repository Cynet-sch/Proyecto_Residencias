<?php
    session_start();

    require 'config.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT ID, user_n, password FROM users WHERE ID = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $user = null;
    
        if (count($results) > 0) {
          $user = $results;
        }
      }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Biblioteca de Residencias</title>
        <link rel="stylesheet" href="Assets/CSS/style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>

    <?php if(!empty($user)): ?>
      <br> Bienvenido. <?= $user['user_n']; ?>
      <br>Tu sesion se inicio satisfactoriamente
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="login.php">Login</a> or
      <a href="registro.php">SignUp</a>
    <?php endif; ?>
    </body>    
</html>