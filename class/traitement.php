
<?php

class Todolist
{
    private $db;
    private $connect;
    public function __construct($db)
    {
        $this->db= $db;
        $this->connect = $this->db->connect();
    }

  public function select($id_utilisateur){

    $req = $this->connect->prepare("SELECT * FROM todo WHERE id_utilisateur = ?");
    $req->execute([$id_utilisateur]);
    $data_todolist = $req->fetchAll();

    return $data_todolist ;

  }

    public function ajout($id_utilisateur, $nom, $create_at, $finished_at, $description, $statut, $assigned_to)
    {
        $query = $this->connect->prepare("INSERT INTO todo (id_utilisateur, nom, create_at, finished_at, description, statut, assigned_to) VALUES (:id_utilisateur,:nom,:create_at,description,statut,assigned_to)");
        $query->bindParam(':id_utilisateur', $id_utilisateur);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':create_at', $create_at);
        $query->bindParam(':finished_at', $finished_at);
        $query->bindParam(':description', $description);
        $query->bindParam(':statut', $statut);
        $query->bindParam(':assigned_to', $assigned_to);
        $query->execute();
    }

    public function supprimer($id)
    {
    }

    public function maj($id, $finished_at, $statut)
    {
        $update = $this->connect->prepare("UPDATE `todo` SET `finished_at`= ?,`statut`= ?,WHERE id= ?");
        $update->execute([$id,$finished_at,$statut]);
    }
};


 ?>
