<?php

class user {

    private $db;
    private $connect;
   

    public function __construct($db){

        $this->db= $db;
        $this->connect = $this->db->connect();
    }

    public function register($password, $password_confirm, $login){
 
        try{
            $req_login = $this->connect->prepare( "SELECT * FROM utilisateurs WHERE login = ?" );
           
            $req_login->execute([$login]);
            $compare_login= $req_login->fetchall();
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }


        if(count($compare_login) != 0){
            $error = "Désolé cet email est déjà utilisé";
           
            return json_encode(["erreur"=>$error]);

        }

        else{
            if($password == $password_confirm){

                $pwd_hash = password_hash($password, 
                PASSWORD_DEFAULT, ['cost' => 12]);

                $req_register= $this->connect->prepare("INSERT INTO `utilisateurs`(`login`, `password`) VALUES (?, ?)");
                $req_register->execute(array( $login, $pwd_hash));
              
                //header("Location:connexion.php");
                return json_encode(["msg"=>"registered"]);
                

            }
            else{
                $error =  "Votre mot de passe est différent";
                
                return json_encode(["erreur"=>$error]);;
            }
        }

    }

    public function connect_user($login, $password){


        if(!empty($login) && !empty($password)){

            try{
                $req_connect= $this->connect-> prepare( "SELECT * FROM `utilisateurs` WHERE `login` = ? " );
                $req_connect->execute(array($login));
                $data_users= $req_connect->fetch();
                
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }

           
            
            if(count($data_users) == 0)
            {
                $error = "Login ou mot de passe incorrect";
                return json_encode(["erreur" => $error]);
            }
            elseif(password_verify($password, $data_users['password']))
            {


                $req = $this->connect-> prepare("SELECT * FROM `utilisateurs` WHERE `login` = ? ");
                $req->execute(array($login));
                $users= $req->fetch();
               //session_start();
                $_SESSION["login"]= $users['login'];
                $_SESSION["id"]= $users['id'];
                $_SESSION['connected']=1;
                
                

                
                
                
                return  json_encode(["msg" => "connected"]);;
 
                
            }
            else
            {
                $error= "Login ou mot de passe incorrect";
                return json_encode(["erreur" => $error]);
            }
        }
        else{
            $error ="Veuillez remplir tous les champs";
            return json_encode(["erreur" => $error]);
        }

    }

    public function update($id, $password, $password_confirm, $login){

        if($password == $password_confirm){
            $pwd_hash = password_hash($password, 
            PASSWORD_DEFAULT, ['cost' => 12]);

            $req_update = $this->connect->prepare("UPDATE `utilisateurs` SET `password`= ?,`login`= ?,WHERE id= ?");
            $req_update->execute([$pwd_hash, $login, $id]);

            return true;
            
        }else{
            return "Mot de passe différents";
        }

    }

    public function getUserInfo($id){
        $req = $this->connect->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $req->execute([$id]);
        $data_user = $req->fetchAll();

        return $data_user ;
    }
}

?>
