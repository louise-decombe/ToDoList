<?php

require '../class/config.php';

$name = $newlist->getListName($_POST['id_list']);

echo $name;
?>