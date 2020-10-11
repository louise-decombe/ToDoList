<?php

require '../class/config.php';

$id_list = $_POST['idlist'];

$data = $todolist->display_tasksDone($id_list);

echo $data;


?>