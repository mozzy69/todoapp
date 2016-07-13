<?php
    include_once "base.php";
    include_once "log.php";
 
    if(!empty($_POST['username'])):
        include_once "inc/class.users.inc.php";
        $users = new ColoredListsUsers($db);
        echo $users->createAccount();
    else:
?>
