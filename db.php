<?php

$connect = new PDO("mysql:host=localhost;dbname=todolist", "root", "");

session_start();

$_SESSION["id_utilisateur"] = "1";

$_SESSION["login"]="sarah";

?>
