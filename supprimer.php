
<?php

//supprimer une tâche de la todolist

include('db.php');

if($_POST["id"])
{
 $data = array(
  ':id'  => $_POST['id']
 );

 $query = "
 DELETE FROM todo
 WHERE id = :id
 ";

 $statement = $connect->prepare($query);

 if($statement->execute($data))
 {
  echo 'correctement supprimé';
 }
}

?>
