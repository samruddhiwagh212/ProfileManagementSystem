<?php
include_once("inc/headertop.php");
require_once("classes/profile.php");
require_once("classes/vehicle.php");
$avatar_path="avatar/".$_SESSION["user_id"]."/profile.png";
if(!file_exists($avatar_path))
{
  $path="inc/avatar.png";
}
else{
  $path=$avatar_path;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  try{
    
    $profile=new profile();
   
    $user = $profile->myprofile($_POST["addr"], $_POST["mobile"], $_POST["occu"], $_POST["bthd"], $_POST["gender"], $_POST["photo"]);
    $address = $_POST["addr"];
  }
  catch(PDOException $e)
     { 
   echo "Error:" . $e->getMessage();
  }
 
}
else{
  
  $profile = new profile();
  $user = $profile->getfromuser($_SESSION["user_id"]);
  $address = $user[0]["Address"];
  
  $vehicle = new vehicle();
  $vehicleandticketinfo = $vehicle->vehicleandticketstatus($_SESSION["user_id"]);
  
  //var_dump($user);
//var_dump($vehicleandticketinfo);
  
}
 /*$user[0]["First_Name"]
  *$user[0]["Last_name"]
  *$user[0]["Email"]
  *$user[0]["Address"]
  *$user[0]["Mobile"]
  * $user[0]["Occupation"]
  * $user[0]["Gender"]
  * $user[0]["Birthday"]
  */
?>
<p>
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="<?php echo $path; ?>" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4><?php echo $user[0]["First_Name"]." ".$user[0]["Last_name"]?></h4>
                         <p><?php echo $user[0]["Occupation"] ?></p>
                         <p><?php echo $user[0]["Gender"] ?></p>
                        <p><i class="glyphicon glyphicon-envelope"></i> <?php echo $user[0]["Email"] ?></p>
                         <p><i class="glyphicon glyphicon-home"></i>  <?php echo $user[0]["Address"] ?></p>
                         <p><i class="glyphicon glyphicon-phone"></i>  <?php echo $user[0]["Mobile"] ?></p>
                         <p><i class="glyphicon glyphicon-gift"></i><?php echo  $user[0]["Birthday"] ?></p>

                    </div>
                    <a href="myprofile.php" class="btn btn-link" role="button">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
   <?php 
if(!empty($vehicleandticketinfo[0]['Vehicle_Name']))
{
    echo "<div class='row'>
        <div class='col-xs-12 col-sm-6 col-md-6'>
            <div class='well well-sm'>";
 }
else
{
  unset($vehicleandticketinfo);
  $vehicleandticketinfo=NULL;
}
            
             for($i=0;$i<count($vehicleandticketinfo);$i++)
             {
              echo "
              <div class='row'>
                    <div class='col-sm-6 col-md-4'>
                        <h4>{$vehicleandticketinfo[$i]['Vehicle_Name']} {$vehicleandticketinfo[$i]['TypeOf_Vehicle']}</h4>
                        <p><i class='glyphicon glyphicon-calendar'></i> {$vehicleandticketinfo[$i]['registered']}</p>
                        <p><i class='glyphicon glyphicon-tag'></i> {$vehicleandticketinfo[$i]['Plate_Number']}</p>
                    </div>
                    <div class='col-sm-6 col-md-8'>";
                    if($vehicleandticketinfo[$i]['Reason'])
                    {
                      if($vehicleandticketinfo[$i]['Paid_Date'])
                      {
                        $msg = " Paid: {$vehicleandticketinfo[$i]['Paid_Date']}";
                      }
                      else{
                        $msg = " Due: {$vehicleandticketinfo[$i]['Due_Date']}";
                      }
                      echo "<h4>Vehicle History</h4>
                          ";
                          $currentVehicle=$vehicleandticketinfo[$i]['Vehicle_ID'];
                      while($vehicleandticketinfo[$i]['Vehicle_ID']==$currentVehicle){
                      echo"
                          <p><i class='glyphicon glyphicon-tags'></i> Ticket: {$vehicleandticketinfo[$i]['Reason']} <i class='glyphicon glyphicon-tags'></i> \${$vehicleandticketinfo[$i]['Cost']}
                          <i class='glyphicon glyphicon-calendar'></i> Issued: {$vehicleandticketinfo[$i]['ticketDate']} <i class='glyphicon glyphicon-calendar'></i>$msg
                          </p>
                     
                      ";
                      $i++;
                      }
                      $i--;
                      
                    }
                    echo "</div>
                </div>";
             }
             
             
             
if(!empty($vehicleandticketinfo[0]['Vehicle_Name']))
{
         echo " <a href='status.php' class='btn btn-link' role='button'>View Details</a>
            </div>
            
        </div>
    </div>";

}
    ?>
  </div>
  </p>

<?php
  include_once("inc/bottom.php");
  ?>
