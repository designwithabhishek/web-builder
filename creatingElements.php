<?php
session_start();
$name=$_REQUEST['filename'];
$pname=$_SESSION['activepage'];
$pname=explode('.',$pname)[0];
$scss=$_SESSION['activestyle'];
$dragmodule=$_SESSION['activedragmod'];
$inputtype=$_REQUEST['inputname'];
$idopener=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/idtracker.txt","r+");
rewind($idopener);
while($ch=fgets($idopener))
{  
   $sleng=-1*strlen($ch);
    if(stristr($ch,$inputtype)!==false)
    { $len=strlen($inputtype);
       
       $c=substr($ch,$len);
      
 $id=(int)$c+1;
 fseek($idopener,$sleng,SEEK_CUR);
      $ch2=$inputtype.$id;
	  fputs($idopener,$ch2);	
    }
}
fclose($idopener);
$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$pname.html", "a") or die("Unable to open file!");
if($inputtype=="heading")
{  
    $finalid="h".$id;
    $txt=PHP_EOL."<input id='$finalid' onselect='getselectedcontent($finalid)' onclick='setactiveId($finalid,event)' onfocusout='savetext($finalid)' class='heading' type='text' value='Enter the heading'/>".PHP_EOL;
    fwrite($myfile,$txt);
    $stylesheet =fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$scss","a") or die("Unable to open file!");
    $sty=PHP_EOL.".heading".PHP_EOL."{".PHP_EOL."position:absolute;".PHP_EOL."background-color:transparent;".PHP_EOL."width:40%;".PHP_EOL."height:100px;".PHP_EOL."font-size:50px;".PHP_EOL."border:2px dashed black;".PHP_EOL."}".PHP_EOL."#$finalid".PHP_EOL."{".PHP_EOL."position:absolute;".PHP_EOL."left:20px;".PHP_EOL."top:20px;".PHP_EOL."}";
    fwrite($stylesheet,$sty);
    $scriptfile=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$dragmodule","r+") or die("Unable to open file!");
    $code=PHP_EOL."var textElement$finalid=document.getElementById('$finalid');".PHP_EOL."var dragObject$finalid = new Draggable(textElement$finalid);a";
    fseek($scriptfile,-46,SEEK_END);
    $rt=fread($scriptfile,filesize($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/dragmodule.js"));
    fseek($scriptfile,-46,SEEK_END);
    fwrite($scriptfile,$code);
    fseek($scriptfile,-1,SEEK_END);
    fwrite($scriptfile,$rt);
    echo $pname;
}
else if($inputtype=="paragraph")
{
    $finalid="p".$id;
    $txt=PHP_EOL."<textarea rows='8' cols='4' id='$finalid' onselect='getselectedcontent($finalid)' onclick='setactiveId($finalid,event)' onfocusout='savetext($finalid)' class='heading' value='Enter the content'></textarea>".PHP_EOL;
    fwrite($myfile,$txt);
    $stylesheet =fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$scss","a") or die("Unable to open file!");
    $sty=PHP_EOL.".heading".PHP_EOL."{".PHP_EOL."position:absolute;".PHP_EOL."background-color:transparent;".PHP_EOL."width:40%;".PHP_EOL."height:100px;".PHP_EOL."font-size:50px;".PHP_EOL."}".PHP_EOL."#$finalid".PHP_EOL."{".PHP_EOL."position:absolute;".PHP_EOL."left:20px;".PHP_EOL."top:20px;".PHP_EOL."}";
    fwrite($stylesheet,$sty);
    $scriptfile=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$dragmodule","r+") or die("Unable to open file!");
    $code=PHP_EOL."var textElement$finalid=document.getElementById('$finalid');".PHP_EOL."var dragObject$finalid = new Draggable(textElement$finalid);a";
    fseek($scriptfile,-46,SEEK_END);
    $rt=fread($scriptfile,filesize($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/dragmodule.js"));
    fseek($scriptfile,-46,SEEK_END);
    fwrite($scriptfile,$code);
    fseek($scriptfile,-1,SEEK_END);
    fwrite($scriptfile,$rt);
    echo $pname;
}
else {if($inputtype=="image")
{  
 $finalid="i".$id;
 if(isset($_FILES['f']))
 { 
  $file=$_FILES["f"]['tmp_name'];
  $filename=$_FILES["f"]['name'];
  $fileerror=$_FILES["f"]['error'];
  $fileext=explode('.',$filename);
  $fileActualExt=strtolower(end($fileext));
  $allowed=array('jpg','jpeg','png');
  if(in_array($fileActualExt,$allowed))
  {
    if($fileerror===0)
    {
		$fname=$finalid.".".$fileActualExt;
		$d=$name.'/images/'.$fname;
		move_uploaded_file($file,$d);
	}
  }
  else
  {
	  echo "error";
	
  }
 }
 $container=$finalid."box";
 $handle=$finalid."handle";
 $txt=PHP_EOL."<div id='$container'>".PHP_EOL."<img src='images/$fname' id='$finalid' onclick='setactiveId($finalid,event)'>".PHP_EOL."<div id='$handle'></div>".PHP_EOL."</div>".PHP_EOL;
 fwrite($myfile,$txt);
 $stylesheet =fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$scss","a") or die("Unable to open file!");
 $sty=PHP_EOL.".image".PHP_EOL."{".PHP_EOL."position:absolute;".PHP_EOL."}".PHP_EOL."#$container".PHP_EOL."{".PHP_EOL."position: absolute;".PHP_EOL."left:20px;".PHP_EOL."top:20px;".PHP_EOL."height:200px;".PHP_EOL."width:200px;".PHP_EOL."}".PHP_EOL."#$finalid".PHP_EOL."{".PHP_EOL."left:20px;".PHP_EOL."top:20px;".PHP_EOL."height:200px;".PHP_EOL."width:200px;".PHP_EOL."}".PHP_EOL."#$handle".PHP_EOL."{".PHP_EOL."background-color:red;".PHP_EOL."position:absolute;".PHP_EOL."cursor:se-resize;".PHP_EOL."right:0;".PHP_EOL."bottom:0;".PHP_EOL."width:10px;".PHP_EOL."height:10px;".PHP_EOL."}".PHP_EOL;
 fwrite($stylesheet,$sty);
 $scriptfile=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/$dragmodule","r+") or die("Unable to open file!");
 $code=PHP_EOL."var textElement$container=document.getElementById('$container');".PHP_EOL."var dragObject$container = new Draggable(textElement$container);".PHP_EOL."var textElement$finalid=document.getElementById('$finalid');".PHP_EOL."var resize$finalid=document.getElementById('$handle');".PHP_EOL."var s$finalid=new res(resize$finalid,textElement$container,textElement$finalid);a";
 fseek($scriptfile,-46,SEEK_END);
 $rt=fread($scriptfile,filesize($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/dragmodule.js"));
 fseek($scriptfile,-46,SEEK_END);
 fwrite($scriptfile,$code);
 fseek($scriptfile,-1,SEEK_END);
 fwrite($scriptfile,$rt);
 echo $pname;
}
}
?>