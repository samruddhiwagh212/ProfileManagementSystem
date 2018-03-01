<?php

var_dump($_GET);
$location=$_GET['id'];
if(file_exists($location))
{
    if(is_dir($location))
    {
        echo "Deleting directory\n";
        foreach( new RecursiveIteratorIterator( 
        new RecursiveDirectoryIterator( $location, FilesystemIterator::SKIP_DOTS | FilesystemIterator::UNIX_PATHS ), 
        RecursiveIteratorIterator::CHILD_FIRST ) as $value ) {
            $value->isFile() ? unlink( $value ) : rmdir( $value );
        }
        rmdir( $location );
    }
    else
    {
        unlink($location);
    }
}
header("location:mydrive.php");
?>