<?php
require "../class/config.php";


$login = htmlspecialchars($_POST['login']);
$password= htmlspecialchars($_POST['password']);

if(!empty($login) && !empty($password) ){

    $result = $user->connect_user($login, $password);
     echo  $result;
 }


?>