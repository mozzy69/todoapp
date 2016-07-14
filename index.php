<?php 
//Login Data
require_once 'inc/query.php';
//The Add List Item functionallity
require_once 'inc/add.php'; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/todo.css">  
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
       
  
  </head>
  <body>

<div class="container-fluid">
    
   

<button data-toggle="collapse" data-target="#infoToggle" type="button" class="btn btn-info"><span class="glyphicon glyphicon-info-sign"></span></button><h1>Online Todo List</h1> 
    
    
    <div class="collapse" id="infoToggle">
  
      With this simple list making app you can,
      <ul>
          <li>
          <span class="glyphicon glyphicon-plus"></span> Add Items to the list  
          </li>
          <li>
          <span class="glyphicon glyphicon-ok"></span> Check items off the list  
          </li>  
          <li>
          <span class="glyphicon glyphicon-remove"></span> Delete items from the list  
          </li>
      </ul>  
   
      
</div>
    
<div class="panel panel-default">    
<div class="panel-body">  
 <ul>

<?php

$todo_res = mysqli_query($db_server, "SELECT * FROM list_items ORDER BY ListItemID DESC");

//check sucess of building resource
if(!$todo_res)die("Database access failed :" . mysqli_error());

//require 'inc/updateListID.php'; 
$tempNum=0;

if (mysqli_num_rows($todo_res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($todo_res)) {
        echo "<li>" . $row["ListText"]. "</li>";
	$ListIDCount = $row["ListItemID"];
	$sql_listID = "UPDATE list_items SET ListID='$tempNum'
	       	       WHERE ListItemID='$ListIDCount' ";
	
	if (mysqli_query($db_server, $sql_listID)) {
    		//echo "New record created successfully";
		$tempNum++;
		unset($sql_listID);
	} else {
    		echo "Error: " . $sql_listID . "<br>" . mysqli_error($db_server);
	}	

    }
} else {
    echo "0 results";
}

?>

</ul>    
</div><!--close panel-body-->    
</div><!--close panel panel-default-->
    
    
 <form class="form-inline" role="form" action="index.php" method="post">
      
    <input type="text" class="form-control" name="add" id="addID">
  
  <button type="submit" class="btn btn-default">Add</button>
</form>    
    
</div><!--Close .container-fluid-->

      
<script src="js/todo.js"></script>
<script type="text/javascript">
    cleanUp();
</script>

<?php mysqli_close($db_server); ?>      
</body>    
    
</html>
