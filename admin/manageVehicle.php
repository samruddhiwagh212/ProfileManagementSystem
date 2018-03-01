
<?php
include_once("top.php");
require_once("../classes/vehicle.php");

try{
    $vehicle=new vehicle();
    $result = $vehicle->getallvehicle();
	
    //var_dump ($result);   
}
catch(PDOException $e)
{
    echo "Error:" .$e->getMessage();
}
?>


<h2 class="text-center"><strong>Vehicle Management</strong></h2>
<p></p>
<hr>
<p>
	<table class="table table-bordered">
		<thead>
			<tr class="active">
			<th>Name</th>
			<th>Email</th>
			<th>Vehicle</th>
			<th>Plate-Number</th>
			<th>Tag Category</th>
			<th>Tag Number</th>
			<th>Registered Date</th>
            <th>...</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($result as $value){
				$temp = explode(":",$value['Vehicle_Pass']);
				$Category=$temp[0];
				$Tag=$temp[1];
				echo "<tr>
				<td>{$value['First_Name']} {$value['Last_Name']}</td>
				<td>{$value['Email']}</td>
				<td>{$value['Vehicle_Name']} {$value['TypeOf_Vehicle']}</td>
				<td>{$value['Plate_Number']}</td>
				<td>{$Category}</td>
				<td>{$Tag}</td>
				<td>{$value['registered']}</td>
                <td>
                    <form data-toggle='validator' method='post' action='editVehicle.php'>
                    <input type='hidden' class='form-control' name='vehicleid' id='vehicleid' value='{$value['Vehicle_ID']}' >
                    <button type='submit' value='send' id='submit' name='submit' class='btn btn-default'>edit</button>
                    </form>
                    <form data-toggle='validator' method='post' action='addTicket.php'>
                    <input type='hidden' class='form-control' name='First_Name' id='First_Name' value='{$value['First_Name']}' >
                    <input type='hidden' class='form-control' name='Last_Name' id='Last_Name' value='{$value['Last_Name']}' >
                    <input type='hidden' class='form-control' name='vehicleid' id='vehicleid' value='{$value['Vehicle_ID']}' >
                    <input type='hidden' class='form-control' name='vehiclename' id='vehiclename' value='{$value['Vehicle_Name']}' >
                    <input type='hidden' class='form-control' name='Plate_Number' id='Plate_Number' value='{$value['Plate_Number']}' >
                    <input type='hidden' class='form-control' name='date' id='date' value='{$value['registered']}' >
                    <button type='submit' value='send' id='submit' name='submit' class='btn btn-default'>Add Ticket</button>
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

