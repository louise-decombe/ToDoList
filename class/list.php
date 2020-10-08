<?php

class  lists
{

    private $db;
    private $connect;

    public function __construct($db)
    {
        $this->db = $db;
        $this->connect = $this->db->connect();
    }

    public function addlist($name, $id_user)
    {

        try {
            $req_list = $this->connect->prepare("SELECT * FROM `list` WHERE nom = ? ");

            $req_list->execute([$name]);
            $data_name = $req_list->fetchall();
        } catch (PDOException $error) {
            echo  $error->getMessage();
        }

        if (count($data_name) == 0) {
            try {
                $req = $this->connect->prepare("INSERT INTO `list`(`id_utilisateur`, `nom`) VALUES (? , ?)");
                $req->execute([$id_user, $name]);
                return json_encode(["msg" => "liste ok"]);
            } catch (PDOException $error) {
                echo  $error->getMessage();
            }
        } else {

            return json_encode(["erreur" => "Cette liste existe déja"]);
        }
    }

    public function adduser($user_name, $list_name)
    {

        try {
            $req = $this->connect->prepare("SELECT id FROM utilisateurs WHERE login = ?");
            $req->execute([$user_name]);
            $data_id = $req->fetch();
        } catch (PDOException $error) {
            echo  $error->getMessage();
        }

        if (count($data_id) == 0) {
            $error = "Cet utilisateur n'existe pas";
            return json_encode(["erreur" => $error]);
        } else {
            try {
                $req_check_list = $this->connect->prepare("SELECT * FROM list WHERE id = ? AND  nom = ?");
                $req_check_list->execute([$data_id['id'], $list_name]);
                $checkedlist = $req_check_list->fetchall();
            } catch (PDOException $error) {
                echo  $error->getMessage();
            }

            if (isset($checkedlist) && count($checkedlist) != 0) {
                $error = "L'utilisateur a déja été rajouté à la liste";
                return json_encode(["erreur" => $error]);
            } else {
                try {
                    $req = $this->connect->prepare("INSERT INTO `list`(`id_utilisateur`, `nom`) VALUES (? , ?)");
                    $req->execute([$data_id['id'], $list_name]);
                    return json_encode(["msg" => "Utilisateur ajouté à la liste"]);
                } catch (PDOException $error) {
                    echo  $error->getMessage();
                }
            }
        }
    }

    public function displayLists($id_user)
    {

        try {

            $req = $this->connect->prepare("SELECT * FROM  list WHERE id_utilisateur = ?");
            $req->execute([$id_user]);
            $data = $req->fetchall();

            return json_encode($data);

        } catch (PDOException $error) {
            echo  $error->getMessage();
        }
    }
}
