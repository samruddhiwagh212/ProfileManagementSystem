
<?php
include_once("top.php");
require_once("../classes/vehicle.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	try{
		$vehicle=new vehicle();
		if (!empty($_POST["save"]))
		{
			$cost=str_replace("$","",$_POST["cost"]);
			$operationStat = $vehicle->updateTicket($_POST["vehicleid"], $_POST["registered"], $_POST["reason"], $_POST["duedate"], $cost, $_POST["paiddate"],$_POST["ticketid"]);
		}
			$status="Paid";
			$result = $vehicle->getTicket($_POST["ticketid"]);
			$button='';
			if(empty($result[0]['Paid_Date'])){
				$status="Pending";
				$button="<button type='submit' value='send' id='submit' name='submit' class='btn btn-default'>Mark Paid</button>";
			}
			
	//	var_dump ($result);   
	}
	catch(PDOException $e)
	{
		echo "Error:" .$e->getMessage();
	}
}
else
{
	header("location:manageTicket.php");
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
		  <input type="vehiclename" class="form-control" name="name" id="name" value="<?php echo $result[0]['First_Name']." ". $result[0]['Last_Name'] ?>" readonly>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		  <div class="help-block with-errors"> </div>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Fine:</label>
		  <input type="text" class="form-control" name="cost" id="cost" value="<?php echo "$".$result[0]['Cost'] ?>" readonly>
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
		  <label for="text">Due Date:</label>
		  <input type="text" class="form-control" name="duedate" id="duedate" value="<?php echo $result[0]['Due_Date'] ?>" readonly>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Reason:</label>
		  <input type="text" class="form-control" name="reason" id="reason" value="<?php echo $result[0]['Reason'] ?>" readonly>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 <div class="form-group has-feedback">
		  <label for="text">Status:</label>
		  <input type="text" class="form-control" name="status" id="status" value='<?php echo $status ?>' readonly>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 
	   
	  <p>
		<div class="form-inline">
		  <div class="text-center">
		<?php echo $button?>
		<a href="manageTicket.php" class="btn btn-default" role="button">Back</a>
		</div>
		<input type="hidden" class="form-control" name="save" id="save" value="true">
		<input type="hidden" class="form-control" name="ticketid" id="ticketid" value="<?php echo $result[0]['Ticket_ID']?>">
		<input type="hidden" class="form-control" name="vehicleid" id="vehicleid" value="<?php echo $result[0]['Vehicle_ID']?>">
		<input type="hidden" class="form-control" name="paiddate" id="paiddate" value="<?php echo date('Y-m-d') ?>">

		
	   <?php if ($operationStat == true)
	{
		echo "<div class=\"alert alert-success\">
	  <strong>Success!</strong> Ticket edited Successfully.
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

