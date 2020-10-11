<?php
session_start();

require 'database.php';
$db = new DataBase("localhost","root","","todolist");

require 'user.php';
$user= new user($db);

require 'todolist.php';
$todolist= new Todolist($db);

require 'list.php';
$newlist = new lists($db)

?>
