
<?php
session_start();
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("location:login.php");
}

if(isset($_SESSION["is_Admin"]) && $_SESSION["is_Admin"] > 0 ){
    $admin=true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css"/>
    <style>

    </style>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="main.php">Home</a></li>
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">MY PROFILE
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="viewprofile.php">My Profile</a></li>
          <li><a href="myprofile.php">Edit Profile</a></li>
          <!--li><a href="#">Settings & Privacy</a></li-->          
          </ul>
          </li>
          
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">VEHICLE INFORMATION
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="vehicleregister.php">Vehicle Registration</a></li>
          <li><a href="tickets.php">Tickets & Status</a></li>
          <li><a href="status.php">Registered Vehicles</a></li>
          </ul>
          </li>
          
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">DIRECTORY MANAGEMENT
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="search.php">Search</a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          </ul>
          </li>
          
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">DOCUMENT MANAGEMENT
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="mydrive.php">My Drive</a></li>
          <li><a href="uploads.php">Upload Document</a></li>
          </ul>
          </li>
          <?php
          if ($admin) echo "<li><a href='admin/'>ADMINISTRATOR</a></li>";
          ?>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
        </ul>
        </div>
        </div>
    </nav>
    <div class="container-fluid text-center">    
    <div class="row content">
    <div class="col-sm-2 sidenav"></div>
    <div class="col-sm-8 text-left" id="centercol">