<?php
require_once 'connect.php';
$checkNumA = $_POST['val'];

echo $checkNumA;

$sql = "UPDATE list_items SET ListItemDone='1'
	WHERE ListID='$checkNumA' ";

if (mysqli_query($db_server, $sql)) {
    	echo "New record created successfully";
	unset($sql);
} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($db_server);
}
?>
