<?php


//on inclut le fichier de config qui charge les classes
require "../class/config.php";


// si on souhaite ajouter une tâche à la todolist
if (isset($_GET['ajouter'])) {


    if ($_GET["nom_tache"]) {
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $nom = $_GET['nom_tache'];
        $statut = "non";
        $create_at = date("Y-m-d H:i");
        $finished_at = null;
        $description = $_GET['description'];
        $assigned_to = null;
        $result = $todolist->ajout($id_utilisateur, $nom, $statut, $create_at, $finished_at, $description, $assigned_to);
        echo  $result;

if($result = $todolist->ajout($id_utilisateur, $nom, $statut, $create_at, $finished_at, $description, $assigned_to)
){

         $task_list_id = $result->lastInsertId();

         echo '<a href="#" class="list-group-item" id="list-group-item-'.$task_list_id.'" data-id="'.$task_list_id.'">'.$_POST["task_name"].' <span class="badge" data-id="'.$task_list_id.'">X</span></a>';
        }


    }
}


// si on souhaite surligner la tâche au clique pour dire qu'elle est terminée
if (isset($_GET['maj'])) {

// on sélectionn l'id
  if($_GET["id"])
  {
$date_finished = date("Y-m-d H:i:s");
$id = $_GET['id'];
$statut= 'oui';
  }
}

//si on souhaite supprimer la tâche
if (isset($_GET['supprimer'])) {

  //supprimer une tâche de la todolist
    $connect = new PDO("mysql:host=localhost;dbname=todolist", "root", "");

    // si l'utilisateur clique sur la croix pour supprimer on récupère l'id de la tâche pour la supprimer
    if ($_GET["id"]) {
        $data = array(
    ':id'  => $_GET['id']
   );
        $query = "DELETE FROM todo WHERE id = :id";

        $statement = $connect->prepare($query);
        if ($statement->execute($data)) {
            echo 'correctement supprimé';
        }
    }
}
