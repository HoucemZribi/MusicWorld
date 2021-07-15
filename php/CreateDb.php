<?php


class CreateDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $connexion;

    public function __construct(
        $dbname = "NewDb",
        $tablename = "Product",
        $servername = "localhost",
        $username = "root",
        $password = ""
    )
    {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        //Connection
        $this->connexion = mysqli_connect($servername, $username, $password);
        if (!$this->connexion) {
            die("Failure" . mysqli_connect_error());
        }
        //Creation
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        //execution
        if (mysqli_query($this->connexion, $sql)) {
            $this->connexion = mysqli_connect($servername, $username, $password, $dbname);
            //Create table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename(id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name varchar(20) NOT NULL,
     price FLOAT , 
     image VARCHAR(100));";

            if (!mysqli_query($this->connexion, $sql)) {
                echo "Error in Creating Table : " . mysqli_error($this->connexion);
            }
        } else {
            return false;
        }
    }

        //Access to database to get article
        public function getData()
        {
            $sql = "SELECT *FROM $this->tablename";
            $result = mysqli_query($this->connexion, $sql);
            if(mysqli_num_rows($result)>0){
                return $result ;
            }
        }
    }




