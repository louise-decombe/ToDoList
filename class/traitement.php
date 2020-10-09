
<?php

class Todolist
{
  private $db;
  private $connect;
  public function __construct($db)
  {
    $this->db = $db;
    $this->connect = $this->db->connect();
  }

  public function select()
  {
    $req = $this->connect->prepare("SELECT * FROM todo ORDER BY id desc LIMIT 1");
    $req->execute();
    $data_todolist = $req->fetchAll();

    return $data_todolist;
  }


  public function select_last()
  {
    $req = $this->connect->prepare("SELECT * FROM todo WHERE statut='oui' ORDER BY id desc LIMIT 1");
    $req->execute();
    $data_todolist = $req->fetchAll();

    return $data_todolist;
  }



  public function ajout($id_utilisateur, $nom, $statut, $create_at, $finished_at, $description, $assign_to,$id_list)
  {

    $query = $this->connect->prepare("INSERT INTO todo (id_utilisateur, nom, statut, create_at, finished_at, description, assign_to,idlist)
VALUES(:id_utilisateur,:nom,:statut,:create_at,:finished_at,:description,:assign_to,:idlist)");
    $query->bindParam(':id_utilisateur', $id_utilisateur);
    $query->bindParam(':nom', $nom);
    $query->bindParam(':statut', $statut);
    $query->bindParam(':create_at', $create_at);
    $query->bindParam(':finished_at', $finished_at);
    $query->bindParam(':description', $description);
    $query->bindParam(':assign_to', $assign_to);
    $query->bindParam(':idlist', $id_list);
    $query->execute();
  }

  public function maj($statut, $finished_at, $id)
  {
    $update = $this->connect->prepare("UPDATE `todo` SET `statut`= ?, `finished_at`= ? WHERE id= ?");
    $update->execute([$statut, $finished_at, $id]);
  }



  public function supprimer($id)
  {
  }
};
?>
