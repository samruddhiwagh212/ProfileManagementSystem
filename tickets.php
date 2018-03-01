<?php
include_once("inc/headertop.php");
require_once("classes/vehicle.php");
try{
    $vehicle=new vehicle();
    $result = $vehicle->vehicleticket($_SESSION["user_id"]);
    $unpaid=false;
    $displayClass="";
     foreach($result as $value){
                if(empty($value['Paid_Date'])){
                    $unpaid=true;
                }
     }

//var_dump ($result);
}
catch(PDOException $e)
{
    echo "Error:" .$e->getMessage();
}

?>

    <p>   </p>
    <p>   </p>
 <?php
   if(count($result)<=0 || $unpaid==false){
    echo '<div class="alert alert-success">
  <p class="text-center"><strong>You have no outstanding tickets !!!</strong> </p>
</div>';
}
elseif(count($result)<5)
{
   echo '<div class="alert alert-warning">
  <p class="text-center"><strong>You have outstanding tickets !!!</strong> </p>
</div>';
}
else{
      echo '<div class="alert alert-danger">
  <p class="text-center"><strong>You are permanently prohibited from parking on campus !!! </strong></p>
</div> ';
}
  echo '<table class="table table-bordered">
    <thead>
        <tr class="active">
            <th>Ticket_ID</th>
            <th>Vehicle-ID</th>
            <th>Date</th>
            <th>Reason</th>
            <th>Due_Date</th>
            <th>Cost</th>
            <th>Paid_Date</th>
        </tr>
    </thead>';
   echo '<tbody>';
        
        
        foreach($result as $value){
            $displayClass='';
                if(empty($value['Paid_Date'])){
        $value['Paid_Date']='Outstanding Ticket';
        if($value['Due_Date'] > date('Y-m-d'))
        {			
            $displayClass="class='warning'";
        }
        else
        {
            $displayClass="class='danger'";
        }
    }
            echo "<tr $displayClass>
            <td>{$value['Ticket_ID']}</td>
            <td>{$value['Vehicle_ID']}</td>
            <td>{$value['Date']}</td>
            <td>{$value['Reason']}</td>
            <td>{$value['Due_Date']}</td>
            <td>{$value['Cost']}</td>
            <td>{$value['Paid_Date']}</td>
             </tr>";
            
        }
    
   echo '</tbody>
    </table>';


?>


    


    


<?php
include_once("inc/bottom.php");
?>