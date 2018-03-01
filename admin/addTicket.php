
<?php
include_once("top.php");
require_once("../classes/vehicle.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	try{
		$vehicle=new vehicle();
		if (!empty($_POST["save"]))
		{
			$cost=str_replace("$","",$_POST["cost"]);
			$due = date("Y-m-d", strtotime($_POST["duedate"]));
			$operationStat = $vehicle->addTicket($_POST["vehicleid"], $_POST["ticketdate"], $_POST["reason"], $due, $_POST["cost"], null);
		}
			$status="Paid";
			$result = $vehicle->getTicket($_POST["ticketid"]);
			$button='';
			if(empty($result[0]['Paid_Date'])){
				$status="Pending";
				$button="";
			}
			
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


<h2 class="text-center"><strong>Ticket Management</strong></h2>
<p></p>
<hr>
<p>
	<div class="col-sm-3"></div>
      <div class=" col-sm-4 col-md-6" id="vehicleregform">
	<form data-toggle="validator" method="post" action="">
		<div class="form-group has-feedback">
		  <label for="vehiclename">Name:</label>
		  <input type="vehiclename" class="form-control" name="name" id="name" value="<?php echo $_POST['First_Name']." ". $_POST['Last_Name'] ?>" readonly>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		  <div class="help-block with-errors"> </div>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Plate Number:</label>
		  <input type="text" class="form-control" name="plateno" id="plateno" value="<?php echo $_POST['Plate_Number'] ?>" readonly>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Registered:</label>
		  <input type="text" class="form-control" name="registered" id="registered" value="<?php echo $_POST['date'] ?>" readonly>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Fine ($):</label>
		  <input type="text" class="form-control" name="cost" id="cost" required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Due Date:</label>
		  <div class="input-group date" data-provide="datepicker">
		  <input type="text" class="form-control datepicker" name="duedate" data-date-format="yyyy-mm-dd" value="<?php echo date('m/d/Y') ?>" required>
<div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
        <div class="help-block with-errors"> </div>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
</div>
		  
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Reason:</label>
		  <input type="text" class="form-control" name="reason" id="reason" required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 
	   
	  <p>
		<div class="form-inline">
		<div class="text-center">
		<button type='submit' value='send' id='submit' name='submit' class='btn btn-default'>Add</button>
		<a href="manageVehicle.php" class="btn btn-default" role="button">Back</a>
		</div>
		<input type="hidden" class="form-control" name="save" id="save" value="true">
		<input type="hidden" class="form-control" name="vehicleid" id="vehicleid" value="<?php echo $_POST['vehicleid']?>">
		<input type="hidden" class="form-control" name="ticketdate" id="ticketdate" value="<?php echo date('Y-m-d') ?>">
		<input type="hidden" class="form-control" name="paiddate" id="paiddate" value="">

		
	   <?php if ($operationStat == true)
	{
		echo "<div class=\"alert alert-success\">
	  <strong>Success!</strong> Ticket added Successfully.
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

