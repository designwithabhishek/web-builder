<?php
session_start();
$id=$_REQUEST['id'];
echo $id;
$_SESSION['ActiveID']=$id;
?>