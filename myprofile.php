<?php
include_once("inc/headertop.php");
require_once("classes/profile.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  try{
    
    $profile=new profile();
   
    $result = $profile->myprofile($_POST["addr"], $_POST["mobile"], $_POST["occu"], $_POST["bthd"], $_POST["gender"], $_POST["photo"]);
    $address = $_POST["addr"];
  }
  
  catch(PDOException $e)
{
 echo "Error:" . $e->getMessage();
}
 
}
else{
  
  $profile = new profile();
  $result = $profile->getfromuser($_SESSION["user_id"]);
  $address = $result[0]["Address"];
  //var_dump($result);
  
}

?>

  <div class="col-sm-3"></div>
      <div class=" col-sm-4 col-md-6" id="myprofileform">
        <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="userid" id=userid value='<?php echo $_SESSION["user_id"]?>' >
    <input type="submit" value="Upload Image" name="submit">
</form>

       <form data-toggle="validator" method="post" action="" role="form" >
           <div class="form-group has-feedback">
   <label for="firstname">First name</label>
   <input type="text" class="form-control " name="firstname" id="reg-firstname" value='<?php echo $result[0]["First_Name"]?$result[0]["First_Name"]:$_POST["firstname"]?>' required>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   <div class="help-block with-errors"> </div>
   </div>
   <div class="form-group has-feedback">
   <label for="lastname">Last name</label>
   <input type="text" class="form-control" name="lastname" id="reg-lastname" value='<?php echo $result[0]["Last_name"]?$result[0]["Last_name"]:$_POST["lastname"]?>' required>
   <div class="help-block with-errors"> </div>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   </div>
   <div class="form-group has-feedback">
   <label for="email">Email</label>
   <input type="email" class="form-control" name="email" id="reg-email" value='<?php echo $result[0]["Email"]?$result[0]["Email"]:$_POST["email"]?>' required>
   <div class="help-block with-errors"> </div>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   </div>
  <div class="form-group has-feedback">
  <label for="addr">Address</label>
  <input type="text" class="form-control" name="addr" id="add" value='<?php echo $result[0]["Address"]? $result[0]["Address"]:$_POST["addr"]?>' required>
  <div class="help-block with-errors"> </div>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
  </div>
  <div class="form-group has-feedback">
  <label for="mobile">Mobile</label>
  <input type="text" class="form-control" name="mobile" id="mb" value='<?php echo $result[0]["Mobile"]?$result[0]["Mobile"]:$_POST["mobile"]?>' required>
  <div class="help-block with-errors"> </div>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
  
  </div>
  <div class="form-group has-feedback">
  <label for="occu">Occupation</label>
  <input type="text" class="form-control" name="occu" id="oc" value='<?php echo $result[0]["Occupation"]?$result[0]["Occupation"]:$_POST["occu"]?>' required>
  <div class="help-block with-errors"> </div>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
  </div>
  <div class="form-group has-feedback">
  <label for="gender">Gender</label>
  <select  id="ge" class="form-control" name= "gender" value='<?php echo $result[0]["Gender"]?$result[0]["Gender"]:$_POST["gender"]?>' required>
   <option <?php if ($_POST['gender'] == 'M') { ?>selected="true" <?php }; ?>value="M">Male</option>
  <option <?php if ($_POST['gender'] == 'F') { ?>selected="true" <?php }; ?>value="F">Female</option>
  </select>
  <div class="help-block with-errors"> </div>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
  
  </div>
  <div class="form-group has-feedback">
     <label for="gender">Birthday</label>
     <div class="input-group date" data-provide="datepicker">
      
    <input type="text" class="form-control datepicker" name="bthd" data-date-format="yyyy-mm-dd" value='<?php echo $result[0]["Birthday"]?$result[0]["Birthday"]:$_POST["bthd"]?>'>
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
        <div class="help-block with-errors"> </div>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
</div>
      
     </div>
   
  <button type="submit" class="btn btn-success center-block" name="upload" value="upload image">SAVE</button>
  
  </form>

        
        
        
  
</div>















<?php
  include_once("inc/bottom.php");
  ?>

