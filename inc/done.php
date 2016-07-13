<?php
require_once 'connect.php';
$checkNumA = $_POST['val'];

$result = mysqli_query($db_server, "SELECT ListItemDone FROM list_items 
				    WHERE ListID='$checkNumA'");
$row = mysqli_fetch_row($result);
//echo $row[0];

if($row[0]==0){
	$sql = "UPDATE list_items SET ListItemDone='1'
	WHERE ListID='$checkNumA' ";

	if (mysqli_query($db_server, $sql)) {
		unset($sql);
		echo 1;
	} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($db_server);
	}
}else{
	$sql = "UPDATE list_items SET ListItemDone='0'
	WHERE ListID='$checkNumA' ";

	if (mysqli_query($db_server, $sql)) {
		unset($sql);
		echo 0;
	} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($db_server);
	}
}

//echo $checkNumA;


?>
