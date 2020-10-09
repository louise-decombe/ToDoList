<?php

require '../class/config.php';

$user_name = $_POST['user_name'];
$id_list = $_POST['id_list'];

$data = $newlist->addusertolist($user_name, $id_list);
echo $data;

?>