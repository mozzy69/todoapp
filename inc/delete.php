<?php
require_once 'connect.php';
$checkNumA = $_POST['val'];

$sql = "DELETE FROM list_items WHERE ListID='$checkNumA' ";

if (mysqli_query($db_server, $sql)) {
    	echo "Record deleted successfully";
	unset($sql);
} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($db_server);
}
?>
