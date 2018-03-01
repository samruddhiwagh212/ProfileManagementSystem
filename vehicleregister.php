<?php
include_once("inc/headertop.php");
require_once("classes/vehicle.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  try{
    $vehicle=new vehicle();
    $result = $vehicle->vehicleregister($_POST["vehiclename"], $_POST["vehicletype"], $_POST["plateno"], $_POST["vpass"]);
  }
  catch(PDOException $e)
{
 echo "Error:" . $e->getMessage();
}
  
}

?>

   <p>   </p>
   <p>    </p>
      <div class="col-sm-3"></div>
      <div class=" col-sm-4 col-md-6" id="vehicleregform">
<p class="text-center"><strong>VEHICLE REGISTRATION</strong></p>
  <form data-toggle="validator" method="post" action="">
    <div class="form-group has-feedback">
      <label for="vehiclename">Make:</label>
      <input type="vehiclename" class="form-control" name="vehiclename" id="vehiclename"required>
      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      <div class="help-block with-errors"> </div>
    </div>
    <div class="form-group has-feedback">
      <label for="text">Model:</label>
      <input type="text" class="form-control" name="vehicletype" id="type"required>
      <div class="help-block with-errors"> </div>
      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <div class="form-group has-feedback">
      <label for="text">Plate Number:</label>
      <input type="text" class="form-control" name="plateno" id="plateno"required>
      <div class="help-block with-errors"> </div>
      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
     <!--div class="form-group has-feedback">
      <label for="text">ParkingID:</label-->
      <input type="hidden" class="form-control" name="vpass" id="vpass">
      <!--div class="help-block with-errors"> </div>
      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div-->
     
   
  <p>
    <div class="form-inline">
      <div class="text-center">
    <button type="submit" value="send" id="submit" name="submit" class="btn btn-default">Submit</button>
    <button class="btn btn-default" type="reset">Reset</button>
    <a href="status.php" class="btn btn-default" role="button">Cancel</a>
    </div>
   <?php if ($result == true)
{
    echo "<div class=\"alert alert-success\">
  <strong>Success!</strong> Your Vehicle is Registered Successfully.
</div>";
}
?>
    
  </div>
    </p>  
  </form>
      </div>


    
    
    
  <?php
  include_once("inc/bottom.php");
  ?>
  