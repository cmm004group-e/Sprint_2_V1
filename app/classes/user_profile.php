<?php
class User_profile{

    // database connection and table name
    private $conn;
    private $table_name = "user_profile";

    // object properties
    public $prof_id;
    public $telephone;
    public $employer;
    public $role_description;
    public $linkedin;
    public $github;
    public $twitter;
    public $facebook;
    public $instagram;
    public $time_updated;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function save(){

        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    telephone=:telephone, employer=:employer, role_description=:role_description,
                    linkedin=:linkedin, github=:github, twitter=:twitter,
                    facebook=:facebook, instagram=:instagram, time_updated=:time_updated";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));
        $this->employer=htmlspecialchars(strip_tags($this->employer));
        $this->employer=htmlspecialchars(strip_tags($this->role_description));
        $this->linkedin=htmlspecialchars(strip_tags($this->linkedin));
        $this->github=htmlspecialchars(strip_tags($this->github));
        $this->facebook=htmlspecialchars(strip_tags($this->facebook));
        $this->twitter=htmlspecialchars(strip_tags($this->twitter));
        $this->time_updated=htmlspecialchars(strip_tags($this->time_updated));

        // bind values
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":employer", $this->employer);
        $stmt->bindParam(":role_description", $this->role_description);
        $stmt->bindParam(":linkedin", $this->linkedin);
        $stmt->bindParam(":github", $this->github);
        $stmt->bindParam(":facebook", $this->facebook);
        $stmt->bindParam(":twitter", $this->twitter);
        $stmt->bindParam(":time_updated", $this->time_updated);

        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;

    }
    // login user
   /* function login(){
        // select all query
        $query = "SELECT
                    `telephone`, `employer`, `role_description`, `linkedin`, 
                    `github`, `facebook`, `twitter`, `time_updated`
                FROM
                    " . $this->table_name . " 
                WHERE
                    username='".$this->username."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
   */
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                prof_id='".$this->prof_id."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}