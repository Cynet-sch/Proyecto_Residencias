<?php 

    session_start();
    require 'config.php';

    if (!empty($_POST['Usuario']) && !empty($_POST['Contraseña'])) {
        $records = $conn->prepare('SELECT ID, user_n, password FROM users WHERE user_n = :user_n');
        $records->bindParam(':user_n', $_POST['Usuario']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';
    
        if (count($results) > 0 && password_verify($_POST['Contraseña'], $results['password'])) {
          $_SESSION['user_id'] = $results['ID'];
          header("Location: /Proyecto_Residencias");
        } else {
          $message = 'Lo sentimos, los datos de Usuario o contraseña no coinciden';
        }
      }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inicio de Sesion </title>
        <link rel="stylesheet" href="Assets/CSS/style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php 
            require 'Partials/header.php'
        ?>
        <h1>Inicio de Sesion</h1>
        <span> or <a href="registro.php">SignUp</a></span>

        <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <input type="text" name="Usuario" placeholder="Ingreas tu nombre de usuario">
    	    <input type="password" name="Contraseña" placeholder="Ingresa tu contraseña">
            <input type="submit" value="Send">
        </form>
    </body>
</html>