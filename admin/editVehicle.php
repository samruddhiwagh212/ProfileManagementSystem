
<?php
include_once("top.php");
require_once("../classes/vehicle.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	try{
		$vehicle=new vehicle();
		$vpass=$_POST["category"].":".$_POST["tag"];
		if (!empty($_POST["save"]))
		{
			$operationStat = $vehicle->updatevehicle($_POST["vehiclename"], $_POST["vehicletype"], $_POST["plateno"], $vpass, $_POST["vehicleid"]);
		}
			$result = $vehicle->getvehicle($_POST["vehicleid"]);
			$temp = explode(":",$result[0]['Vehicle_Pass']);
			$Category=$temp[0];
			$Tag=$temp[1];
		//var_dump ($result);   
	}
	catch(PDOException $e)
	{
		echo "Error:" .$e->getMessage();
	}
}
else
{
	header("location:manageVehicle.php");
}
?>


<h2 class="text-center"><strong>Vehicle Management</strong></h2>
<p></p>
<hr>
<p>
	<div class="col-sm-3"></div>
      <div class=" col-sm-4 col-md-6" id="vehicleregform">
	<form data-toggle="validator" method="post" action="">
		<div class="form-group has-feedback">
		  <label for="vehiclename">Make:</label>
		  <input type="vehiclename" class="form-control" name="vehiclename" id="vehiclename" value="<?php echo $result[0]['Vehicle_Name'] ?>" readonly>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		  <div class="help-block with-errors"> </div>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Model:</label>
		  <input type="text" class="form-control" name="vehicletype" id="type" value="<?php echo $result[0]['TypeOf_Vehicle'] ?>" readonly>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Plate Number:</label>
		  <input type="text" class="form-control" name="plateno" id="plateno" value="<?php echo $result[0]['Plate_Number'] ?>" readonly>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Registered:</label>
		  <input type="text" class="form-control" name="registered" id="registered" value="<?php echo $result[0]['Date'] ?>" readonly>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 <div class="form-group has-feedback">
		  <label for="text">Parking Category:</label>
		  <select  id="category" class="form-control" name= "category" value='<?php echo $Category ?>' required>
		   <option <?php if ($Category == 'Red') { echo 'selected="true"'; } ?>value="Red">Red</option>
		   <option <?php if ($Category == 'Black') { echo 'selected="true"'; } ?>value="Black">Black</option>
	       <option <?php if ($Category == 'Blue') { echo 'selected="true"';} ?>value="Blue">Blue</option>
	       <option <?php if ($Category == 'Yellow') { echo 'selected="true"';} ?>value="Yellow">Yellow</option>
	       <option <?php if ($Category == 'Orange') { echo 'selected="true"';} ?>value="Orange">Orange</option>
	       <option <?php if ($Category == 'Green') { echo 'selected="true"';} ?>value="Green">Green</option>
	       <option <?php if ($Category == 'White') { echo 'selected="true"';} ?>value="White">White</option>
	      </select>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 <div class="form-group has-feedback">
		  <label for="text">Parking Tag:</label>
		  <input type="text" class="form-control" name="tag" id="tag" value='<?php echo $Tag ?>' required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 
		 
	   
	  <p>
		<div class="form-inline">
		  <div class="text-center">
		<button type="submit" value="send" id="submit" name="submit" class="btn btn-default">Submit</button>
		<a href="manageVehicle.php" class="btn btn-default" role="button">Cancel</a>
		</div>
		<input type="hidden" class="form-control" name="save" id="save" value="true">
		<input type="hidden" class="form-control" name="vehicleid" id="vehicleid" value="<?php echo $_POST["vehicleid"]?>">

		
	   <?php if ($operationStat == true)
	{
		echo "<div class=\"alert alert-success\">
	  <strong>Success!</strong> Your Vehicle has been edited Successfully.
	</div>";
	}
	?>
		
	  </div>
		</p>  
	  </form>
	  </div>
	  
</p>
<h3></h3>
<p></p>


<?php
include_once("bottom.php");
?>

