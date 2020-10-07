<?php

require '../class/config.php';

$id_user = htmlspecialchars($_POST['iduser']);
$name = htmlspecialchars($_POST['name']);

$username = htmlspecialchars($_POST['username']);


$result = $newlist->addlist($name, $id_user);




$new_result = json_decode($result, true);

if (isset($new_result['msg']) && $new_result['msg'] == "liste ok") {

    if($username != null){
        $add_user = $newlist->adduser($username, $name);

        $new_data = json_encode([
            "result1" => $result,
            "result2" => $add_user
        ]);
        echo $new_data;
    }

}


if(!isset($new_data)){
    echo $result;
}
