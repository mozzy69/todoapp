<?php
require_once 'connect.php';

$result = mysqli_query($db_server, "SELECT * FROM list_items ORDER BY ListItemID DESC");

$tempNum=0;
if (mysqli_num_rows($result) > 0) {
    $strikeArr = array();	
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
	$strikeArr[$tempNum] = $row["ListItemDone"];        
	$tempNum++;
    }
	echo json_encode($strikeArr);	
	exit();	
} else {
    echo "0 results";
}

?>
