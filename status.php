


<?php
include_once("inc/headertop.php");
require_once("classes/vehicle.php");

try{
$vehicle=new vehicle();
$result = $vehicle->vehiclestatus($_SESSION["user_id"]);
//var_dump ($result);
}
catch(PDOException $e)
{
    echo "Error:" .$e->getMessage();
}
?>

    <p>   </p>
    <p>
        <a href="vehicleregister.php" class="btn btn-default" role="button">Add Vehicle</a>
        <a href="tickets.php" class="btn btn-default" role="button">View Tickets</a>
<table class="table table-bordered">
    <thead>
        <tr class="active">
            <th>User-ID</th>
            <th>Vehicle-ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Plate-Number</th>
            <th>Pass</th>
            <th>Registered Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($result as $value){
            echo "<tr>
            <td>{$value['User_ID']}</td>
            <td>{$value['Vehicle_ID']}</td>
            <td>{$value['Vehicle_Name']}</td>
            <td>{$value['TypeOf_Vehicle']}</td>
            <td>{$value['Plate_Number']}</td>
            <td>{$value['Vehicle_Pass']}</td>
            <td>{$value['Date']}</td>
             </tr>";
            
        }
        ?>
    </tbody>
</table>    
    
    </p>
    


 <?php
  include_once("inc/bottom.php");
  ?>




