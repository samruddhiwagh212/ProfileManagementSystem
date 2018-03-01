<?php
include_once("inc/headertop.php");
require_once("classes/profile.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  try{
    if(!empty($_POST["search"]) && strlen($_POST["search"])>2)
    {
        //search for stuff
        $profile=new profile();
        $result = $profile->searchUser($_POST["search"]);
        $resultCount=count($result);
        $display=true;
        //var_dump($result);
        
    }
    else{
        //missing something in search. need to handle this.
        $showWarning=true;
    }
  }
 catch(PDOException $e)
{
 echo "Error:" . $e->getMessage();
}
 
}
else{
  
 //method not post. 
  
}

?>

<p>
  <div class="col-sm-2"></div>
      <div class=" col-sm-4 col-md-8" >
        
<div class="row"></div> 
    <form data-toggle="validator" method="post" action="" role="form" >
           <div class="form-group has-feedback">
   
        <div class="input-group stylish-input-group">
            <input type="text" class="form-control" name="search" placeholder="Search: John Doe" >
            <span class="input-group-addon">
                <button type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>  
            </span>
        </div>
  </form>

<?php
//display search results
if($showWarning)
{
echo '<p> <div class="alert alert-danger">
  <strong>Invalid Search!</strong> Search required a minimum of 3 characters.
</div> </p>';
}
if($display)
{
     echo"
    <hgroup >
            <h1>Search Results</h1>
            <h2 class='lead'><strong class='text-danger'>$resultCount</strong> results were found for search <strong class='text-danger'>{$_POST["search"]}</strong></h2>								
        </hgroup>
        ";
    foreach($result as $person)
    {
		$picpath="avatar/{$person['User_ID']}/profile.png";
		if(!file_exists($picpath))
		{
      $picpath="http://placehold.it/380x500";
		}
    echo "
    <article class='search-result row'>
			<div class='col-xs-12 col-sm-12 col-md-3'>
				<a href='#' title='{$person['First_Name']} {$person['Last_name']}' class='thumbnail'><img src='$picpath' alt='Lorem ipsum' /></a>
			</div>
            <div class='col-xs-12 col-sm-12 col-md-2'>
				<ul class='meta-search'>
					<li><i class='glyphicon glyphicon-calendar'></i><span>{$person['Birthday']}</span></li>
					<li><i class='glyphicon glyphicon-record'></i> <span>{$person['Gender']}</span></li>
					<li><i class='glyphicon glyphicon-tags'></i> <span>{$person['Occupation']}</span></li>
				</ul>
			</div>
            <div class='col-xs-12 col-sm-12 col-md-7 excerpet'>
				<h3><a href='#' title=''>{$person['First_Name']} {$person['Last_name']}</a></h3>
				<p>PlaceHolder Description for user.</p>
                <ul class='meta-search'>
                <li><p><i class='glyphicon glyphicon-home'></i> <span>{$person['Address']}</span></p></li>
                <li><p><i class='glyphicon glyphicon-envelope'></i> <span>{$person['Email']}</span></p></li>
                <li><p><i class='glyphicon glyphicon-phone'></i> <span>{$person['Mobile']}</span></p></li>
                </ul>
                
			</div>
            </article>
            ";
   
    }
}
?>
        
        
        
      </div>
</div>


</p>












<?php
  include_once("inc/bottom.php");
  ?>
