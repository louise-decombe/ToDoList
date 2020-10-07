<?php

require '../class/config.php';

$name = htmlspecialchars($_POST['list_name']);
$id_user= $_SESSION['id'];
$user_name= htmlspecialchars($_POST['add_user']);

$result = $newlist->addlist($name, $id_user);
echo $result;
$new_result = json_decode($result, true) ;

if($new_result['msg'] == "liste ok"){
    $add_user = $newlist->adduser($user_name, $name);
    echo $add_user;
}

?>