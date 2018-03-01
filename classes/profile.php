<?php
require_once("db.php");

class profile {
    
    private $db;
    
     public function __construct()
  {

    $this->db = new Db();
  }

   public function updateUser($userid=null, $address, $mobile, $occupation, $birthday, $gender, $photo=null, $idprofile,$firstname, $lastname, $isadmin, $email){
    
    try{
        if($userid==null)
        {
            $userid=$_SESSION[user_id];
        }
        $birthday = date("Y-m-d", strtotime($birthday));
        
      //  $this->db->query("Update Profile Set Address=:address, Mobile=:mobile, Occupation=:occupation, Photo=:photo, Birthday=:birthday, Gender=:gender
        //                 where idProfile=:idprofile");
        $this->db->query("Insert into Profile(User_ID, Address, Mobile, Occupation, Photo, Birthday, Gender)
                         values (:userid, :address, :mobile, :occupation, :photo, :birthday, :gender)
                         on duplicate key update Address =:address, Mobile=:mobile, Occupation=:occupation, Photo=:photo,
                         Birthday=:birthday, Gender=:gender, User_ID=:userid");
        $this->db->bind(":address",$address);
        $this->db->bind(":mobile",$mobile);
        $this->db->bind(":occupation",$occupation);
        $this->db->bind(":birthday",$birthday);
        $this->db->bind(":gender",$gender);
        $this->db->bind(":photo",$photo);
        $this->db->bind(":userid",$userid);
        //$this->db->bind(":idprofile",$idprofile);
        
        $row= $this->db->execute();
        
        $this->db->query("Update User Set Email=:email, First_Name=:firstname, Last_Name=:lastname, Is_Admin=:isadmin
                         where User_ID=:userid");
        $this->db->bind(":email",$email);
        $this->db->bind(":firstname",$firstname);
        $this->db->bind(":lastname",$lastname);
        $this->db->bind(":isadmin",$isadmin);
        $this->db->bind(":userid",$userid);
        $row1= $this->db->execute();
        
        if($row && $row1)
        {
            return true;
        }
        return false;
    }
         catch(PDOException $e){
        echo $e->getMessage();
         
         }
        
    } 
  
  public function myprofile($address, $mobile, $occupation, $birthday, $gender, $photo){
    
    try{
        
        $birthday = date("Y-m-d", strtotime($birthday));
        
        $this->db->query("Insert into Profile(User_ID, Address, Mobile, Occupation, Photo, Birthday, Gender)
                         values ('$_SESSION[user_id]', :address, :mobile, :occupation, :photo, :birthday, :gender)
                         on duplicate key update Address =:address, Mobile=:mobile, Occupation=:occupation, Photo=:photo,
                         Birthday=:birthday, Gender=:gender");
        $this->db->bind(":address",$address);
        $this->db->bind(":mobile",$mobile);
        $this->db->bind(":occupation",$occupation);
        $this->db->bind(":birthday",$birthday);
        $this->db->bind(":gender",$gender);
        $this->db->bind(":photo",$photo);
        
        $row= $this->db->execute();
         return $row;
    }
         catch(PDOException $e){
        echo $e->getMessage();
         
         }
        
    }
    
    public function getfromuser($userid){
        
         try{
          
          $this->db->query("SELECT Profile.idProfile, User.User_ID, Is_Admin, First_Name, Last_name,Email, Address, Mobile, Occupation, Photo, Birthday, Gender
                           from User
                           left join Profile
                           on User.User_ID = Profile.User_ID
                             where User.User_ID=:userID");
          $this->db->bind(":userID",$userid);
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
       }
       
    public function getalluser(){
        
         try{
          
          $this->db->query("SELECT User.User_ID, First_Name, Last_Name,Email, Address, Mobile, Occupation, Photo, Birthday, Gender
                           from User
                           left join Profile
                           on User.User_ID = Profile.User_ID");
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
       }
       
    public function searchUser($searchField){
        $searchArray = explode(" ",$searchField);
        $searchString="";
        foreach($searchArray as $name)
        {
            
            $searchString.=" and (First_Name = '$name' or Last_Name = '$name')";
        }
         try{
          
          $this->db->query("SELECT User.User_ID, First_Name, Last_name, Email, Address, Mobile, Occupation, Photo, Birthday, Gender
                           from User
                           left join Profile
                           on User.User_ID = Profile.User_ID
                             where 1=1 $searchString Limit 10");
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
    }
   
        
    }
  

?>
