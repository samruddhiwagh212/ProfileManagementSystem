<?php

require_once("db.php");

class userfunctions
{
  private $db;

  public function __construct()
  {

    $this->db = new Db();
  }


  public function register($firstname, $lastname, $email, $password)
  {
       try
       {
    $this->db->query("Insert into User (First_Name, Last_Name, Email, Password) values (:firstname, :lastname, :email, :password)");
    $this->db->bind(":firstname",$firstname);
    $this->db->bind(":lastname",$lastname);
    $this->db->bind(":email",$email);
    $this->db->bind(":password",$password);
    $row =$this->db->execute();
    return true;
       }
       catch(PDOException $e){
        echo $e->getMessage();
         
         }
        
       }
   

  

}





?>
