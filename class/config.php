<?php
session_start();

require 'database.php';
$db = new DataBase("localhost","root","","todolist");

require 'user.php';
$user= new user($db);



?>