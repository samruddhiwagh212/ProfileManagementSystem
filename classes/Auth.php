<?php

require_once("db.php");

class Auth 
{
  private $db;
  private $userid;
  private $Is_Admin=0;
 
  public function get_userid(){  
    return $this->userid;
  }
 
  public function __construct()
  {
    $this->db = new Db();
  }
  
  public function get_isAdmin($_userid=null){
    try
      {
        if($_userid==null)
        {
          return $this->Is_Admin;
        }
        $this->db->query("SELECT Is_Admin FROM User where User_ID=:userid");
        $this->db->bind(":userid",$_userid);
        $row = $this->db->resultset();
        return $row[0]["Is_Admin"];

       }
       catch(PDOException $e){
        echo $e->getMessage();
        return 0;
      } 
  }
  
  public function hash_password($password){
    
    return password_hash($password,PASSWORD_DEFAULT);
    
  }
 

public function register($firstname, $lastname, $email, $password)
  {
    try
      {
        $password_hash=$this->hash_password($password);
        if($password_hash!=NULL)
        {
        
        $this->db->query("Insert into User (First_Name, Last_Name, Email, Password) values (:firstname, :lastname, :email, :password)");
        $this->db->bind(":firstname",$firstname);
        $this->db->bind(":lastname",$lastname);
        $this->db->bind(":email",$email);
        $this->db->bind(":password",$password_hash);
        $row =$this->db->execute();
        return true;
        }
        else{
          
          return false;
           }
       }
       catch(PDOException $e){
        echo $e->getMessage();
         
         }   
}
   
  public function login($email, $password, $remember=0)
  {
      try { 
        $this->db->query("SELECT User_ID,Email,Password, Is_Admin FROM User where Email=:email"); //Get admin value as well
        $this->db->bind(":email",$email);
        $row =$this->db->resultset();

        if(count($row) <= 0)
          {
                return false;
          }
    else {
      //echo $row[0]["User_ID"];
       $this->userid = $row[0]["User_ID"];
       $this->Is_Admin = $row[0]["Is_Admin"];
       //get and set Admin
      // echo $this->userid;
       return password_verify($password,$row[0]["Password"]);
        }
    
  }
  catch(Exception $e)
  {
    echo $e->getMessage();
    return null;
  }

  }

}





?>
