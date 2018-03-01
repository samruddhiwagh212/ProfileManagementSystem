
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


<h2 class="text-center"><strong>Registered Vehicles</strong></h2>
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

