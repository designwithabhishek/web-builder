<?php
$activepage=$_REQUEST['apagename'];
$activestyle=$_REQUEST['astyle'];
$activedrag=$_REQUEST['dragm'];
//$activepage=explode('.',$activepage)[0];
session_start();
$_SESSION['activepage']=$activepage;
$_SESSION['activestyle']=$activestyle;
$_SESSION['activedragmod']=$activedrag;
echo var_dump($_SESSION);
?>