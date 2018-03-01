<?php

$ds=DIRECTORY_SEPARATOR;
//$storeFolder = '../personal/24';//***
$storeFolder = "../".$_POST["path"];
if(!empty($_FILES)){
    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = dirname(__FILE__).$ds.$storeFolder.$ds;
    $targetFile=$targetPath.$_FILES['file']['name'];
    move_uploaded_file($tempFile,$targetFile);
    }
    ?>