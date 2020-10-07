<?php

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="src/fontello/css/fontello.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/script.js"></script>
    <title>Document</title>
</head>

<body>
    <main class="main_form">
        <section id="register_section">
            <h1 class="text-center">S'incrire</h1>
            <div id="error"></div>
            <form method="post" id="register_form">
                
                <div class="form-group">
                    <label for="login">Votre Login</label>
                    <input type="text" id="login" name="login" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Votre mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="pwd_confirm">Confirmation mot de passe</label>
                    <input type="password" id="pwd_confirm" name="pwd_confirm" class="form-control">
                </div>
                <button type="submit" id="btn_register" class="btn btn-success">S'incrire</button>
            </form>
            <p class="text-center">Déja inscrit ? <a href="#" id="connect" >Connectez vous</a></p>

        </section>

    </main>

</body>

</html>