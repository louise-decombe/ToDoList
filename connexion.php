<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <title>Document</title>
</head>
<body>
<section >
        <h1>Se connecter</h1>
        <div id="error"></div>
        <form action="" method="post" id="connect_form">
            <input type="text" id="login" name="login" placeholder="Login">
            <input type="password" id="password" name="password" placeholder="Mot de passe">
            <button type="submit" id="btn_connect">Valider</button>
        
        </form>
         <p>Pas de compte? <a href="#" id="register">S'incrire</a></p>
        
</section>
</body>
</html>