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
            $data_id = $req->fetchall();
        } catch (PDOException $error) {
            echo  $error->getMessage();
        }

        if (count($data_id) == 0) {
            $error = "Cet utilisateur n'existe pas";
            return json_encode(["erreur" => $error]);
        } else {
            try {
                $req_check_list = $this->connect->prepare("SELECT * FROM list WHERE id = ? AND  nom = ?");
                $req_check_list->execute([$data_id[0]['id'], $list_name]);
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
                    $req->execute([$data_id[0]['id'], $list_name]);
                    return json_encode(["msg" => "Utilisateur ajouté à la liste"]);
                } catch (PDOException $error) {
                    echo  $error->getMessage();
                }
            }
        }
    }
    public function addusertolist($user_name, $id_list)
    {

        try {
            $req = $this->connect->prepare("SELECT id FROM utilisateurs WHERE login = ?");
            $req->execute([$user_name]);
            $data_id = $req->fetchall();
           
        } catch (PDOException $error) {
            echo  $error->getMessage();
        }
        try {
            $req = $this->connect->prepare("SELECT nom FROM list WHERE id = ?");
            $req->execute([$id_list]);
            $data_name = $req->fetch();
        } catch (PDOException $error) {
            echo  $error->getMessage();
        }

        if (count($data_id) == 0) {
            $error = "Cet utilisateur n'existe pas";
            return json_encode(["erreur" => $error]);
        } else {
            try {
                $req_check_list = $this->connect->prepare("SELECT * FROM list WHERE id_utilisateur = ? AND  nom = ?");
                $req_check_list->execute([$data_id[0]['id'], $data_name['nom']]);
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
                    $req->execute([$data_id[0]['id'], $data_name['nom']]);
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

    public function showlistusers($list_id)
    {

        try {
            $req = $this->connect->prepare("SELECT nom FROM list WHERE id= ?");
            $req->execute([$list_id]);
            $list_name = $req->fetchall();
        } catch (PDOException $error) {
            echo  $error->getMessage();
        }

        try {
            $req_login = $this->connect->prepare("SELECT login FROM utilisateurs INNER JOIN list on utilisateurs.id = list.id_utilisateur WHERE list.nom = ? ");

            $req_login->execute([$list_name[0]['nom']]);
            $users = $req_login->fetchall();

            return json_encode($users);
        } catch (PDOException $error) {
            echo  $error->getMessage();
        }
    }
    public function getIdlist($id_user){
        $req= $this->connect->prepare("SELECT id FROM list WHERE id_utilisateur = ?");
        $req->execute([$id_user]);
        $ids_list =$req->fetchall();

        return json_encode($ids_list);
        
    }


    public function getListName($id_list)
    {

        try {
            $req_name = $this->connect->prepare("SELECT nom FROM list WHERE id = ?");
            $req_name->execute([$id_list]);
            $list_name = $req_name->fetchall();

            return json_encode($list_name);
        } catch (PDOException $error) {
            echo  $error->getMessage();
        }
    }

    public function deleteList($id_list){

        try{
            $req_delete = $this->connect->prepare("DELETE FROM `list` WHERE id = ?");
            $req_delete->execute([$id_list]);

            return json_encode(["msg" => "Cette liste a bien été effacée"]);

        }catch (PDOException $error) {
            echo  $error->getMessage();
        }
    }
}
