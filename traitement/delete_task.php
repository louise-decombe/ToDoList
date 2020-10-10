<?php

require '../class/config.php';
$delete_id= $_POST['delete_id'];
$response = $todolist->deleteTask($delete_id);

echo $response;
?>