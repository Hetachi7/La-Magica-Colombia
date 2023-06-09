<?php 
   
session_start();

  if(isset($_SESSION['user_id'])){
    header('Location: /php-login');
  }
    
  
  require 'database.php'; 

  if (!empty($_POST['email']) && !empty ($_POST['password'])){
    $records = $conn->prepare('SELECT id, email, contraseña FROM usuarios WHERE email=:email' );  
    $records->bindParam(':email', $$_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO :: FETCH_ASSOC);

    $message ='';

    if (count($results) > 0 && password_verify($_POST['password'], $results ['password'])){
      $_SESSION['user_id']= $results['id'];
      header('Location: /php-login');
    }else {
        $message = 'losiento los credenciales no coinciden ';
    }
  }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="assets/css/Styles.css">
    
 
    <title>Iniciar sesion</title>
</head>
<body>

<?php require 'partials/header.php'?>
 <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>


  <section id="login">
  <div class="logo">
  <img src="img/logo.png" alt="">
  </div>
  
    <h1>Iniciar sesion</h1>
    <span> o  <a href="registrarse.php">  Registrarse</a></span>
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Ingresa tu email">
        <input type="password" name="password" placeholder="Ingresa tu contraseña">
        <input type="submit" value="Enviar">
    </form>
    
  </section>
 

 
</body>
</html>