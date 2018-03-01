
<?php
include_once("top.php");
require_once("../classes/vehicle.php");

try{
    $vehicle=new vehicle();
    $result = $vehicle->getallticketstatus();
    //var_dump ($result);   
}
catch(PDOException $e)
{
    echo "Error:" .$e->getMessage();
}
?>


<h2 class="text-center"><strong>Ticket Management</strong></h2>
<p></p>
<hr>
<p>
	<table class="table table-bordered">
		<thead>
			<tr class="active">
			<th>Name</th>
			<th>Vehicle</th>
			<th>Plate-Number</th>
			<th>Ticket Date</th>
			<th>Reason</th>
			<th>Fine</th>
			<th>Pay By</th>
			<th>Paid</th>
            <th>...</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($result as $value){
				$displayClass="";
				if(empty($value['Paid_Date'])){
					$value['Paid_Date']='Pending';
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
				<td>{$value['First_Name']} {$value['Last_Name']}</td>
				<td>{$value['Vehicle_Name']} {$value['TypeOf_Vehicle']}</td>
				<td>{$value['Plate_Number']}</td>
				<td>{$value['ticketDate']}</td>
				<td>{$value['Reason']}</td>
				<td>\${$value['Cost']}</td>
				<td>{$value['Due_Date']}</td>
				<td>{$value['Paid_Date']}</td>
                <td>
                    <form data-toggle='validator' method='post' action='editTicket.php'>
                    <input type='hidden' class='form-control' name='ticketid' id='ticketid' value='{$value['Ticket_ID']}' >
                    <button type='submit' value='send' id='submit' name='submit' class='btn btn-default'>update</button>
                    </form>
                </td>
				</tr>";			
			}
			?>
		</tbody>
	</table>    

</p>
<h3></h3>
<p></p>


<?php
include_once("bottom.php");
?>

