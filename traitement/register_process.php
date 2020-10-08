<?php

require "../class/config.php";

$login =  htmlspecialchars($_POST['login']);
$password =  htmlspecialchars($_POST['password']);
$password_confirm= htmlspecialchars($_POST['pwd_confirm']);

if(!empty($login) && !empty($password) && !empty($password_confirm)){

   $result = $user->register($password, $password_confirm, $login);
    echo  $result;
}

?>