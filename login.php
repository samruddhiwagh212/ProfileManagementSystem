<?php
//phpinfo();
//die();
require_once("classes/Auth.php");
session_start();
//if(!empty($_POST))
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
 
try{

$auth = new Auth();
$result = $auth->login($_POST["email"],$_POST["password"]);
 
if(!$result)
{
      $error=true;
}
else {
      //set session variables
      $_SESSION["user"]=$_POST["email"];
      $_SESSION["user_id"]=$auth->get_userid();
      $_SESSION["is_Admin"]=$auth->get_isAdmin($_SESSION["user_id"]);
      header("location:main.php");
   $success=true;
}
}
catch(PDOException $e)
{
 echo "Error:" . $e->getMessage();
}
$conn = null;

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
  <style>
   
    

    
    /* Set gray background color and some padding */
    body{
      background-color:#333;
      
    }
    .navbar{
      background:#333;
      border-color: #333
      
    }
    
    #loginform, #signupform{
      background: #fff;
    }
    #loginform, #signupform {
      
      border-radius:10px;
     
}

  </style>
 
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-nav">
      
      <li><a href="#"></a></li>
      <li><a href="#"></a></li>
      <li><a href="#"></a></li>
    </ul>
  </div>
</nav>
  
<div class="container" id="content">
  <p id="loginform"></p>
    
<div class=" col-sm-4 col-md-6" id="loginform">
 <p class="text-center"><strong>LOGIN</strong></p>
  <form data-toggle="validator" method="post" action="">
    <div class="form-group has-feedback">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      <div class="help-block with-errors"> </div>
    </div>
    <div class="form-group has-feedback">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password" required>
      <div class="help-block with-errors"> </div>
      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember" id="remember"> Remember me</label>
    </div>
    <div class="form-inline">
    <button type="submit" value="LOGIN" id="submit" name="submit" class="btn btn-default">LOGIN</button>
    <button type="reset" class="btn btn-reset" name="reset" value="CLEAR">CLEAR</button>
    </div>
  </form>
<?php
  if($error == true){

 echo"  <div class=\"alert alert-danger\">
  <strong>Invalid Credentials.</strong> 
</div>";
}
else if ($success == true)
{
    echo "<div class=\"alert alert-success\">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>";
}

?>
   <p class="text-center"><strong>For New User</strong></p>
  <button type="button" class="btn btn-info center-block" name="button" data-toggle="collapse" data-target="#demo">SIGN UP</button>
  </div>
  <div id="demo" class="collapse">
 <div class="col-sm-4 col-md-offset-2" id="signupform">

    <p class="text-center"><strong>Sign Up</strong></p>
    <p class="text-center"><strong>Get started - it's free.</strong></p>
  <form data-toggle="validator" method="post" action="register.php" role="form">
    <div class="form-group has-feedback">
   <label for="reg-firstname">First name</label>
   <input type="text" class="form-control " name="firstname" id="reg-firstname" required>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   <div class="help-block with-errors"> </div>
   </div>
   <div class="form-group has-feedback">
   <label for="reg-lastname">Last name</label>
   <input type="text" class="form-control" name="lastname" id="reg-lastname" required>
   <div class="help-block with-errors"> </div>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   </div>
   <div class="form-group has-feedback">
   <label for="reg-email">Email</label>
   <input type="email" class="form-control" name="email" id="reg-email" required>
   <div class="help-block with-errors"> </div>
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   </div>
  <div class="form-group has-feedback">
  <label for="rgpwd">Password(8 or more characters)</label>
  <input type="password" class="form-control" name="password" id="rgpwd" data-minlength="8" required>
  <div class="help-block with-errors"> </div>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
  </div>
  <div class="form-group has-feedback">
  <label for="cfpwd">Confirm password(8 or more characters)</label>
  <input type="password" class="form-control" name="conpassword" id="cfpwd" data-match="#rgpwd" data-match-error="passwords don't match" required>
  <div class="help-block with-errors"> </div>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
  <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
  </div>
   
  <button type="submit" class="btn btn-success center-block">REGISTER NOW</button>
  
  </form>

  </div>
</div>

<footer class="container-fluid text-center">
  <p></p>
</footer>
</body>
</html>


