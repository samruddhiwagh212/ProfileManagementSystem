<?php

include_once("inc/headertop.php");
$directory="personal/".$_SESSION["user_id"];
?>
<link href="inc/dropzone.css" type="text/css" rel="stylesheet" />
<script src="inc/dropzone.js"></script>
<p>
    
<h4>Upload Documents to your personal drive</h4>

<form action="inc/upload.php" class="dropzone">
    <input type="hidden" id="path" name="path" value="<?php echo $directory;?>"/>
</form> 


    
    
    
    
    
    
</p>




    


    


<?php
include_once("inc/bottom.php");
?>