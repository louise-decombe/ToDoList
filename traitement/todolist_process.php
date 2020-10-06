<?php


//on inclut le fichier de config qui charge les classes
require "../class/config.php";


// si on souhaite ajouter une tâche à la todolist
if(isset($_GET['ajouter'])){

  if ($_POST["nom_tache"]) {

      $id_utilisateur = $_SESSION['id_utilisateur'];
      $create_at = date("Y-m-d H:i:s");
      $nom = $_POST['nom_tache'];
      $description = $_POST['description'];
      $finished_at = null;
      $statut = 'non';
      $assigned_to = null;
     $result = $todolist->ajout($id_utilisateur,$create_at,$nom,$description,$finished_at,$statut,$assigned_to);
        echo  $result;
  }
}


// si on souhaite surligner la tâche au clique pour dire qu'elle est terminée
if(isset($_GET['maj'])){
}

//si on souhaite supprimer la tâche
if(isset($_GET['supprimer'])){

// si l'utilisateur clique sur la croix pour supprimer on récupère l'id de la tâche pour la supprimer
  if($_POST["id"])
  {

    $result3 = $todolist->supprimer($id);
}

}

 ?>
