<?php

require_once("db.php");

class vehicle
{
  private $db;

  public function __construct()
  {

    $this->db = new Db();
  }
  
public function addTicket($vehicleid, $date, $reason, $duedate, $cost, $paid_date)
{
       try
       {
   
    $this->db->query("Insert into Ticket (Vehicle_ID, Date, Reason, Due_Date, Cost)
                     values (:vehicleid, :date, :reason, :duedate, :cost)");
  
    $this->db->bind(":vehicleid",$vehicleid);
    $this->db->bind(":date",$date);
    $this->db->bind(":reason",$reason);
    $this->db->bind(":duedate",$duedate);
    $this->db->bind(":cost",$cost);
    
    $row =$this->db->execute();
    
    return $row;
    }
      
       catch(PDOException $e){
        echo $e->getMessage();
         echo $e;
         }
        
}  

public function vehicleregister($vehiclename, $typeofvehicle, $platenumber, $vehiclepass)
{
       try
       {
   
    $this->db->query("Insert into vehicleregistration (User_ID, Vehicle_Name, TypeOf_Vehicle, Plate_Number, Vehicle_Pass, Date)
                     values ('$_SESSION[user_id]', :vehiclename, :typeofvehicle, :platenumber, :vehiclepass, now())");
    
    
    $this->db->bind(":vehiclename",$vehiclename);
    $this->db->bind(":typeofvehicle",$typeofvehicle);
    $this->db->bind(":platenumber",$platenumber);
    $this->db->bind(":vehiclepass",$vehiclepass);
    
    $row =$this->db->execute();
    
    return $row;
    }
      
       catch(PDOException $e){
        echo $e->getMessage();
         
         }
        
}

  public function updatevehicle($vehiclename, $typeofvehicle, $platenumber, $vehiclepass, $vehicleid)
  {
    try
    {
      $this->db->query("Update vehicleregistration set Vehicle_Name=:vehiclename, TypeOf_Vehicle=:typeofvehicle, Plate_Number=:platenumber, Vehicle_Pass=:vehiclepass
                    where Vehicle_ID=:vehicleid");
      
      $this->db->bind(":vehiclename",$vehiclename);
      $this->db->bind(":typeofvehicle",$typeofvehicle);
      $this->db->bind(":platenumber",$platenumber);
      $this->db->bind(":vehiclepass",$vehiclepass);
      $this->db->bind(":vehicleid",$vehicleid);
      
      $row =$this->db->execute();
      
      return $row;
    }
    catch(PDOException $e){
     echo $e->getMessage();
    }
  }

  public function updateTicket($vehicleid, $date, $reason, $duedate, $cost, $paid_date, $ticketid)
  {
    try
    {
      $this->db->query("Update Ticket set Vehicle_ID=(select Vehicle_ID from vehicleregistration where Vehicle_ID=:vehicleid), Date=:date, Reason=:reason, Due_Date=:duedate, Cost=:cost, Paid_Date=:paiddate
                    where Ticket_ID=:ticketid");
      
      $this->db->bind(":vehicleid",$vehicleid);
      $this->db->bind(":date",$date);
      $this->db->bind(":reason",$reason);
      $this->db->bind(":duedate",$duedate);
      $this->db->bind(":cost",$cost);
      $this->db->bind(":paiddate",$paid_date);
      $this->db->bind(":ticketid",$ticketid);
      
      $row =$this->db->execute();
      
      return $row;
    }
    catch(PDOException $e){
     echo $e->getMessage();
    }
  }
        
      public function getvehicle($vehicleid){
        
        try{
          
          $this->db->query("SELECT User_ID, Vehicle_ID, Vehicle_Name, TypeOf_Vehicle, Plate_Number, Vehicle_Pass, Date from vehicleregistration 
                             where Vehicle_ID=:vehicleID");
          $this->db->bind(":vehicleID",$vehicleid);
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
        
       }
       
       public function vehiclestatus($userid){
        
        try{
          
          $this->db->query("SELECT User_ID, Vehicle_ID, Vehicle_Name, TypeOf_Vehicle, Plate_Number, Vehicle_Pass, Date from vehicleregistration 
                             where User_ID=:userID");
          $this->db->bind(":userID",$userid);
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
        
       }
   
   public function vehicleticket($userid){
    
    try{
      
      $this->db->query("SELECT Ticket_ID, Ticket.Vehicle_ID, Ticket.Date, Reason, Due_Date, Cost, Paid_Date FROM Ticket
                       left join vehicleregistration on Ticket.Vehicle_ID = vehicleregistration.Vehicle_ID
                       where User_ID=:userID");
          $this->db->bind(":userID",$userid);
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
   }

   public function getTicket($ticketid){
    
    try{
      
      $this->db->query("SELECT First_Name, Last_Name, Ticket_ID, Ticket.Vehicle_ID, Ticket.Date, Reason, Due_Date, Cost, Paid_Date, Plate_Number FROM Ticket
                       left join vehicleregistration on Ticket.Vehicle_ID = vehicleregistration.Vehicle_ID left join User on vehicleregistration.User_ID=User.User_ID
                       where Ticket_ID=:ticketID");
          $this->db->bind(":ticketID",$ticketid);
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
   }

   public function getallticketstatus(){
       try{
          $this->db->query("select User.User_ID, First_Name, Last_Name, Email, vehicleregistration.Vehicle_ID, vehicleregistration.Vehicle_Name, vehicleregistration.TypeOf_Vehicle, vehicleregistration.Plate_Number, vehicleregistration.Date as registered, Vehicle_Pass,
          Ticket.Date as ticketDate, Ticket.Ticket_ID, Ticket.Reason, Ticket.Due_Date, Ticket.Cost, Ticket.Paid_Date
          from Ticket
          left join vehicleregistration
          on vehicleregistration.Vehicle_ID=Ticket.Vehicle_ID
          left join User           
          on vehicleregistration.User_ID=User.User_ID");
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
   }
   
      public function getallvehicle(){
       try{
          $this->db->query("select User.User_ID, First_Name, Last_Name, Email, vehicleregistration.Vehicle_ID, vehicleregistration.Vehicle_Name, vehicleregistration.TypeOf_Vehicle, vehicleregistration.Plate_Number, vehicleregistration.Date as registered, Vehicle_Pass
          from vehicleregistration
          left join User
          on vehicleregistration.User_ID=User.User_ID");
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
   }

   public function vehicleandticketstatus($userid){
        
        try{
          
          /*$this->db->query("select User.User_ID, vehicleregistration.Vehicle_ID, vehicleregistration.Vehicle_Name, vehicleregistration.TypeOf_Vehicle, vehicleregistration.Plate_Number, vehicleregistration.Date as registered,
          Ticket.Date as ticketDate, Ticket.Reason, Ticket.Due_Date, Ticket.Cost, Ticket.Paid_Date
          from User
          left join vehicleregistration
          on User.User_ID=vehicleregistration.User_ID
          left join Ticket 
          on vehicleregistration.Vehicle_ID=Ticket.Vehicle_ID
          where User.User_ID=:userID");*/
          $this->db->query("select User.User_ID, First_Name, Last_Name, Email, vehicleregistration.Vehicle_ID, vehicleregistration.Vehicle_Name, vehicleregistration.TypeOf_Vehicle, vehicleregistration.Plate_Number, vehicleregistration.Date as registered, Vehicle_Pass,
          Ticket.Date as ticketDate, Ticket.Reason, Ticket.Due_Date, Ticket.Cost, Ticket.Paid_Date
          from User
          left join vehicleregistration
          on User.User_ID=vehicleregistration.User_ID
          left join Ticket 
          on vehicleregistration.Vehicle_ID=Ticket.Vehicle_ID
          where User.User_ID=:userID");
          $this->db->bind(":userID",$userid);
          $row =$this->db->resultset();
          return $row;
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
        
       }

}





?>
