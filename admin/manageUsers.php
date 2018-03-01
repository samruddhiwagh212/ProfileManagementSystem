
<?php
include_once("top.php");
require_once("../classes/profile.php");

try{
    $profile=new profile();
    $result = $profile->getalluser();
    //var_dump ($result);   
}
catch(PDOException $e)
{
    echo "Error:" .$e->getMessage();
}
?>


<h2 class="text-center"><strong>User Management</strong></h2>
<p></p>
<hr>
<p>
	<table class="table table-bordered">
		<thead>
			<tr class="active">
			<th>Name</th>
			<th>Email</th>
			<th>Address</th>
			<th>Contact</th>
			<th>Occupation</th>
			<th>Birthday</th>
			<th>Gender</th>
			<th>...</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($result as $value){
				$displayGender="Male";
				if($value['Gender']=='F')
				{
					$displayGender="Female";
				}
				echo "<tr>
				<td>{$value['First_Name']} {$value['Last_Name']}</td>
				<td>{$value['Email']}</td>
				<td>{$value['Address']}</td>
				<td>{$value['Mobile']}</td>
				<td>{$value['Occupation']}</td>
				<td>{$value['Birthday']}</td>
				<td>{$displayGender}</td>
                <td>
                    <form data-toggle='validator' method='post' action='editUser.php'>
                    <input type='hidden' class='form-control' name='userid' id='userid' value='{$value['User_ID']}' >
                    <button type='submit' value='send' id='submit' name='submit' class='btn btn-default'>edit</button>
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

