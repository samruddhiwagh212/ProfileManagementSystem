
<?php
include_once("top.php");
require_once("../classes/profile.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	try{
		$profile=new profile();
		if (!empty($_POST["save"]))
		{
			
			$operationStat = $profile->updateUser($_POST["userid"], $_POST["address"], $_POST["mobile"], $_POST["occupation"], $_POST["birthday"], $_POST["gender"], null, $_POST["idprofile"], $_POST["firstname"], $_POST["lastname"], $_POST["admin"], $_POST["email"]);
		}
			$result = $profile->getfromuser($_POST["userid"]);
			if($result[0]['Is_Admin']==0)
			{
				$user="Standard";	
			}
			else{
				$user="Administrator";
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
	header("location:manageUsers.php");
}
?>


<h2 class="text-center"><strong>User Management</strong></h2>
<p></p>
<hr>
<p>
	<div class="col-sm-3"></div>
      <div class=" col-sm-4 col-md-6" id="vehicleregform">
	<form data-toggle="validator" method="post" action="">
		<div class="form-group has-feedback">
		  <label for="vehiclename">First Name:</label>
		  <input type="vehiclename" class="form-control" name="firstname" id="firstname" value="<?php echo $result[0]['First_Name'] ?>" required>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		  <div class="help-block with-errors"> </div>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Last Name:</label>
		  <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $result[0]['Last_name'] ?>" required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Email Address:</label>
		  <input type="text" class="form-control" name="email" id="email" value="<?php echo $result[0]['Email'] ?>" required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		<div class="form-group has-feedback">
		  <label for="text">Address:</label>
		  <input type="text" class="form-control" name="address" id="address" value="<?php echo $result[0]['Address'] ?>" required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 <div class="form-group has-feedback">
		  <label for="text">Contact Number:</label>
		  <input type="text" class="form-control" name="mobile" id="mobile" value='<?php echo $result[0]['Mobile'] ?>' required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 <div class="form-group has-feedback">
		  <label for="text">Occupation:</label>
		  <input type="text" class="form-control" name="occupation" id="occupation" value='<?php echo $result[0]['Occupation'] ?>' required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 <div class="form-group has-feedback">
		  <label for="text">Birth Day:</label>
		  <input type="text" class="form-control" name="birthday" id="birthday" value='<?php echo $result[0]['Birthday'] ?>' required>
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 <div class="form-group has-feedback">
		  <label for="text">Gender:</label>
		  <select  id="gender" class="form-control" name= "gender" value='<?php echo $result[0]["Gender"] ?>' required>
		   <option <?php if ($result[0]['Gender'] == 'M') { echo 'selected="true"'; } ?>value="M">Male</option>
	       <option <?php if ($result[0]['Gender'] == 'F') { echo 'selected="true"';} ?>value="F">Female</option>
	      </select>
		  <!--input type="text" class="form-control" name="gender" id="gender" value='<?php //echo $result[0]['Gender'] ?>' required-->
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 <div class="form-group has-feedback">
		  <label for="text">Is Admin:</label>
		  <select  id="admin" class="form-control" name= "admin" value='<?php echo $result[0]['Is_Admin'] ?>' required>
		  <option <?php if ($result[0]['Is_Admin'] == 0) { echo 'selected="true"';  } ?>value=0>Standard User</option>
	      <option <?php if ($result[0]['Is_Admin'] == 1) { echo 'selected="true"'; } ?>value=1>Administrator</option>
	      </select>
		  <!--input type="text" class="form-control" name="admin" id="admin" value='<?php //echo $user ?>' required-->
		  <div class="help-block with-errors"> </div>
		  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
		 
	   
	  <p>
		<div class="form-inline">
		  <div class="text-center">
		<button type="submit" value="send" id="submit" name="submit" class="btn btn-default">Submit</button>
		<a href="manageUsers.php" class="btn btn-default" role="button">Cancel</a>
		</div>
		<input type="hidden" class="form-control" name="save" id="save" value="true">
		<input type="hidden" class="form-control" name="userid" id="userid" value="<?php echo $_POST["userid"]?>">
		<input type="hidden" class="form-control" name="idprofile" id="idprofile" value="<?php echo $result[0]["idProfile"]?>">

		
	   <?php if ($operationStat == true)
	{
		echo "<div class=\"alert alert-success\">
	  <strong>Success!</strong> User has been updated Successfully.
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

