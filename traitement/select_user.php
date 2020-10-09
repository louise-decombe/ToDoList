<?php
require '../class/config.php';

$id_list=$_POST['id_list'];
$users_list = $newlist->showlistusers($id_list);

echo $users_list;



?>