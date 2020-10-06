<?php

// Ajout d'une tâche sur la page todolist.php

include('db.php');

if ($_POST["nom_tache"]) {
    $date = date("Y-m-d H:i:s");

    $data = array(
  ':id_utilisateur'  => $_SESSION['id_utilisateur'],
  ':nom' => trim($_POST["nom_tache"]),
  ':create_at' => $date,
  ':finished_at' => null,
  ':description' => null,
  ':statut' => 'non'
 );

    $query = "
 INSERT INTO todo
 (id_utilisateur, nom, create_at, finished_at, description, statut)
 VALUES (:id_utilisateur, :nom, :create_at, :finished_at, :description, :statut)
 ";

    $statement = $connect->prepare($query);


    if ($statement->execute($data)) {
        $todo_id = $connect->lastInsertId();
        echo '<a href="#" class="list-group-item" id="list-group-item-'.$todo_id.'" data-id="'.$todo_id.'">'.$_POST["nom_tache"].' <span class="badge" data-id="'.$todo_id.'">X</span></a>';
    }
}
