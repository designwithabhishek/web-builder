<?php
session_start();
$name=$_SESSION['filename'];
$pname=$_REQUEST['pagename'];
$title=$_REQUEST['ftitle'];
$dir=$_SERVER['DOCUMENT_ROOT']."/webbuilder/".$name."/";
$files=scandir($dir);
$flag=1;

for($i=0;$i<count($files);$i++){
	
if(preg_match("/\w+\.html/",$files[$i])){
	if($files[$i]===$pname.".html") {
	$flag=0; 
	break;}
	
}
}

if($flag){
$idtracker=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/idtracker.txt","r+") or die("Unable to open file!");
rewind($idtracker);
$id=0;
echo "Page has been created";
while($ch=fgets($idtracker))
{  
   $sleng=-1*strlen($ch);
    if(stristr($ch,"styles")!==false)
    { $len=strlen("styles");
       
       $c=substr($ch,$len);
      
 $id=(int)$c+1;
 fseek($idtracker,$sleng,SEEK_CUR);
      $ch2="styles".$id;
	  fputs($idtracker,$ch2);	
    }
}
fclose($idtracker);
$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$pname.html", "w") or die("Unable to open file!");
//$txt = "<html><head><style>body{background-color:white;}</style><title>$title</title><body>";
$txt = "<html>".PHP_EOL."<head>".PHP_EOL."<link rel='stylesheet' type='text/css' href='styles".$id.".css'>".PHP_EOL."<title>$title</title>".PHP_EOL."<script src='dragmodule$id.js'></script>".PHP_EOL."<script src='activator.js'></script>"."<body id='body' onclick='setactiveId(body,event)'>";
fwrite($myfile, $txt);
$stylesheet =fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/styles$id.css","w") or die("Unable to open file!");
$sty="body".PHP_EOL."{".PHP_EOL."width:100%;".PHP_EOL."height:100%;".PHP_EOL."background-color:white;".PHP_EOL."}";
fwrite($stylesheet,$sty);
$pg=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/record.txt","a") or die("Unable to open file!");
$pcontent="$pname.html styles$id.css dragmodule$id.js".PHP_EOL;
fwrite($pg,$pcontent);
$jsfile=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/dragmodule$id.js","w");
copy("dragmodule.js",$_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/dragmodule$id.js");
$pagelinkcollector=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/link.txt","a") or die("Unable to open file!");
$linkcontent="$pname.html".PHP_EOL;
fwrite($pagelinkcollector,$linkcontent);
}
else echo "page exists";
?>
