<?php

// mise à jour quand la tâche est cliquée

include('db.php');

if($_POST["id"])
{

  $date_finished = date("Y-m-d H:i:s");

 $data = array(
  ':statut'  => 'oui',
  ':id'  => $_POST["id"],
  'finished_at' => $date_finished
 );

 $query = "
 UPDATE todo
 SET statut = :statut, finished_at = :finished_at
 WHERE id = :id
 ";

 $statement = $connect->prepare($query);

 if($statement->execute($data))
 {
  echo 'terminé pour aujourd\'hui';
 }
}

?>
