<?php

class DataBase {

    private $host;
    private $user;
    private $password;
    private $name;
    private $db;

    public function __construct($host,$user,$password,$name){
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->name = $name;
    }

    public function connect(){
        try{
            $this->db = new PDO("mysql:host=$this->host; dbname=$this->name",  $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            json_encode(["status"=> "OK"]);
            return $this->db;
        }
        catch(PDOException $e){
            echo 'Échec lors de la connexion : ' . $e->getMessage();
        }
    }

    // pour faire une requête : $db->query('SELECT * FROM table')
    public function query($sql, $data = array())
    {
        $req =$this->db->prepare($sql);
        $req->execute($data);
        //le résultat est retourné sous forme d'objet
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}




?>
