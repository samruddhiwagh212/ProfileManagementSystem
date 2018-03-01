<?php
include_once("inc/headertop.php");
require_once("classes/profile.php");
require_once("classes/vehicle.php");
require_once("inc/resources/DirectoryLister.php");
?>
<p>
<?php
$directory="personal/";//move path to config file
if (!file_exists($directory.$_SESSION["user_id"])) {
    mkdir($directory.$_SESSION["user_id"], 0777, true);
}
$lister = new DirectoryLister();
if (isset($_GET['dir']) && strpos($_GET['dir'],$directory.$_SESSION["user_id"])===0) {            
     $dirArray = $lister->listDirectory($_GET['dir']);
  } else {
     $dirArray = $lister->listDirectory("personal/".$_SESSION["user_id"]);
  }
//var_dump($dirArray);
if (!defined('THEMEPATH')) {
   define('THEMEPATH', $lister->getThemePath());
  }

// Set path to theme index
$themeIndex = $lister->getThemePath(true) . '/index.php';

// Initialize the theme
if (file_exists($themeIndex)) {
  include($themeIndex);
} else {
  die('ERROR: Failed to initialize theme');
}
//require('personal/1/index.php');
?>
</p>

<?php
  include_once("inc/bottom.php");
?>
