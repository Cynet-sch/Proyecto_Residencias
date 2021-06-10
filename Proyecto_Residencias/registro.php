<?php 
    require 'config.php';

    $message = '';

  if (!empty($_POST['Usuario']) && !empty($_POST['Contraseña'])) {
    $sql = "INSERT INTO users (user_n, password) VALUES (:user_n, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_n', $_POST['Usuario']);
    $password = password_hash($_POST['Contraseña'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registro</title>
        <link rel="stylesheet" href="Assets/CSS/style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php 
            require 'Partials/header.php'
        ?>

        <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <h1>SignUp</h1>

        <span> or <a href="login.php">Login</a></span>
        
        <form action="registro.php" method="post">
            <input type="text" name="Usuario" placeholder="Ingreas tu nombre de usuario">
    	    <input type="password" name="Contraseña" placeholder="Ingresa tu contraseña">
            <input type="password" name="Confirmar_Contraseña" placeholder="Confirma la contraseña">
            <input type="submit" value="Send">
        </form>
    </body>
</html>