<?php
session_start();
$name=$_REQUEST['filename'];
$_SESSION["filename"]=$name;
$_SESSION['activestyle']="styles.css";
$_SESSION['activepage']=$name;
$_SESSION['activedragmod']="dragmodule.js";
$title=$_REQUEST['ftitle'];

$dir=$_SERVER['DOCUMENT_ROOT']."/webbuilder";
$files=scandir($dir);
$flag=1;
for($i=0;$i<count($files);$i++){
	
if(preg_match("/\w+\.\w+/",$files[$i])){
	
}
else if($files[$i]==="images"||$files[$i]==="."||$files[$i]==="..");
else{
if($files[$i]===$name) {$flag=0; break;}
	
}
}




if($flag){

mkdir($name);
mkdir($name."/final");
mkdir($name."/images");
mkdir($name."/final/images");
$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$name.html", "w") or die("Unable to open file!");
//$txt = "<html><head><style>body{background-color:white;}</style><title>$title</title><body>";
$txt = "<html>".PHP_EOL."<head>".PHP_EOL."<link rel='stylesheet' type='text/css' href='styles.css'>".PHP_EOL."<title>$title</title>".PHP_EOL."<script src='dragmodule.js'></script>".PHP_EOL."<script src='activator.js'></script>".PHP_EOL."<body id='body' onclick='setactiveId(body,event)'>";
fwrite($myfile, $txt);
$stylesheet =fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/styles.css","w") or die("Unable to open file!");
$sty="body".PHP_EOL."{".PHP_EOL."width:100%;".PHP_EOL."height:100%;".PHP_EOL."background-color:white;".PHP_EOL."}";
fwrite($stylesheet,$sty);
$idtracker=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/idtracker.txt","w") or die("Unable to open file!");
$idcontent="heading0".PHP_EOL."paragraph0".PHP_EOL."image0".PHP_EOL."styles1";
fwrite($idtracker,$idcontent);
$pagesel=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/record.txt","w") or die("Unable to open file!");
$pagecont="$name.html styles.css dragmodule.js".PHP_EOL;
fwrite($pagesel,$pagecont);
$jsfile=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/dragmodule.js","w");
copy("dragmodule.js",$_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/dragmodule.js");
$savfile=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/savingstyle.php","w+");
copy("savingstyle.php",$_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/savingstyle.php");
$savtext=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/savingTEXT.php","w");
copy("savingTEXT.php",$_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/savingTEXT.php");
$modifystyle=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/modifystyle.php","w+");
copy("modifystyle.php",$_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/modifystyle.php");
$setactiveId=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/setactiveId.php","w+");
copy("setactiveId.php",$_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/setactiveId.php");
$pagelinkcollector=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/link.txt","w") or die("Unable to open file!");
$linkcontent="$name.html".PHP_EOL;
fwrite($pagelinkcollector,$linkcontent);
echo "ok";
}
else{
echo "file exists";
}
?>