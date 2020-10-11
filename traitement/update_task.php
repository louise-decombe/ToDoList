<?php

require '../class/config.php';

$date = new datetime('now', new DateTimeZone('Europe/Paris'));
$statut = 'oui';
$finish_at= $date->format('Y-m-d H:i');
$id=$_POST['id'];

echo $todolist->maj($statut, $finish_at, $id);



?>