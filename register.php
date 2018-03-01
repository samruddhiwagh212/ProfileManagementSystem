<?php


require_once("classes/Auth.php");

$firstname = $lastname = $email = $password = "";


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $firstname = sanatise_input($_POST["firstname"]);
    $lastname  = sanatise_input($_POST["lastname"]);
    $email     = sanatise_input($_POST["email"]);
    $password  = sanatise_input($_POST["password"]);
 
try{

$Auth = new Auth();
$result = $Auth->register($_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["password"]);
 
if(!$result==true)
{
      $error=true;
      if($result ==1062){
        $duplicate = true;
        die();
      }
}
else {
   header("location:registersuccess.php");
}
}
catch(Exception $e)
{
 echo "Error:" . $e->getMessage();
}
$conn = null;

}
function sanatise_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="inc/validator.min.js"></script>
 
</head>
<body>

<div class="container">
<div class=" col-sm-8 col-md-4">
    <p class="text-center"><strong>Sign Up</strong></p>
    <p class="text-center"><strong>Get started - it's free.</strong></p>
  <form data-toggle="validator" method="post" action="register.php" role="form">
    <div class="form-group has-feedback" >
   <label for="reg-firstname" class="control-label">First name</label>
   <!--input type="text" class="form-control " <?php //$stat=($error==true ? "value=".$_POST["firstname"]:"");// echo $stat; ?> name="firstname" id="reg-firstname"-->
   <input type="text" class="form-control " name="firstname" id="reg-firstname" required>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   <div class="help-block with-errors"> </div>
    </div>
   <div class="form-group has-feedback">
   <label for="reg-lastname" class="control-label">Last name</label>
   <input type="text" class="form-control" name="lastname" id="reg-lastname" required>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    <div class="help-block with-errors"></div>
   </div>
   <div class="form-group has-feedback">
   <label for="reg-email" class="control-label">Email</label>
   <input type="email" class="form-control" name="email" id="reg-email" data-error="email is invalid" required>
    <div class="help-block with-errors"></div>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   </div>
  <div class="form-group has-feedback">
  <label for="rgpwd" class="control-label">Password(8 or more characters)</label>
  <input type="password" class="form-control" name="password" data-minlength="8"  id="rgpwd" required>
   <div class="help-block"></div>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
  </div>
  <div class="form-group has-feedback">
  <label for="cfpwd" class="control-label">Confirm password(8 or more characters)</label>
  <input type="password" class="form-control" name="conpassword" id="cfpwd" data-match="#rgpwd" data-match-error="passwords don't match" required>
   <div class="help-block with-errors"></div>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
  </div>
   
  <button type="submit" class="btn btn-success center-block">REGISTER NOW</button>
  
  </form>

  </div>
</div>


</body>
</html>


