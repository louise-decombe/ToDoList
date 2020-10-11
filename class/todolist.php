
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



  public function ajout($id_utilisateur, $nom, $statut, $create_at, $finished_at, $description, $assign_to, $id_list, $name_list)
  {

    try{

      $req_guest = $this->connect->prepare("SELECT id, id_guest FROM list WHERE nom = ?");
      $req_guest->execute([$name_list]);
      $ids_guest = $req_guest->fetchall();
      
    } catch (PDOException $error) {
      echo  $error->getMessage();
    }
    for($i=0; $i < count($ids_guest); $i++){
      $query = $this->connect->prepare("INSERT INTO todo (id_utilisateur, nom, statut, create_at, finished_at, description, assign_to, idlist, id_guest)
      VALUES(:id_utilisateur,:nom,:statut,:create_at,:finished_at,:description,:assign_to,:idlist, :id_guest)");
      $query->bindParam(':id_utilisateur', $id_utilisateur);
      $query->bindParam(':nom', $nom);
      $query->bindParam(':statut', $statut);
      $query->bindParam(':create_at', $create_at);
      $query->bindParam(':finished_at', $finished_at);
      $query->bindParam(':description', $description);
      $query->bindParam(':assign_to', $assign_to);
      $query->bindParam(':idlist', $ids_guest[$i]['id']);
      $query->bindParam(':id_guest', $ids_guest[$i]['id_guest']);
      $query->execute();

    }

  }

  public function maj($statut, $finished_at, $id)
  {
    $update = $this->connect->prepare("UPDATE `todo` SET `statut`= ?, `finished_at`= ? WHERE id= ?");
    $update->execute([$statut, $finished_at, $id]);

    return json_encode(["msg" => "requete effectuée"]);
  }



  public function deleteTask($id_task)
  {
    try {
      $req = $this->connect->prepare("DELETE FROM `todo` WHERE id = ?");
      $req->execute([$id_task]);

      return json_encode(["msg" => "requete effectuée"]);
    } catch (PDOException $error) {
      echo  $error->getMessage();
    }
  }

  public function taskassignto($id_task)
  {

    try {
      $req = $this->connect->prepare("SELECT assign_to from todo WHERE id =?");
      $req->execute([$id_task]);
    } catch (PDOException $error) {
      echo  $error->getMessage();
    }
  }

  public function display_tasks($id_list)
  {
    try {
      $req = $this->connect->prepare("SELECT * FROM todo  INNER JOIN list on todo.idlist = list.id WHERE idlist = ? and statut = 'non'");
      $req->execute([$id_list]);
      $tasks = $req->fetchall();



      return json_encode($tasks);
    } catch (PDOException $error) {
      echo  $error->getMessage();
    }
  }

  public function display_tasksDone($id_list)
  {
    try {
      $req = $this->connect->prepare("SELECT * FROM todo WHERE idlist = ? and statut = 'oui' ORDER BY finished_at DESC");
      $req->execute([$id_list]);
      $tasks = $req->fetchall();

      return json_encode($tasks);
    } catch (PDOException $error) {
      echo  $error->getMessage();
    }
  }
};
?>
