
<?php
session_start();
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("location:../login.php");
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
    <link rel="stylesheet" href="../inc/profile.css">
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
          <li class="active"><a href="../main.php">Home</a></li>
            
          
          <li><a href="manageUsers.php">User Management</a></li>
          <li><a href="manageVehicle.php">Vehicle Management</a></li>
          <li><a href="manageTicket.php">Tickets Management</a></li>
          <li><a href="registered.php">Registered Vehicles</a></li>
          
          
          
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
        </ul>
        </div>
        </div>
    </nav>
    <div class="container-fluid text-center">    
    <div class="row content">
    <div class="col-sm-2 sidenav"></div>
    <div class="col-sm-8 text-left" id="centercol">