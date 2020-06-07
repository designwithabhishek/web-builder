<?php
session_start();
$b=0;
$name=$_SESSION["filename"];
$pname=$_SESSION['activepage'];
$pname=explode('.',$pname)[0];
$ID=$_REQUEST['id'];
$TEXT=$_REQUEST['text'];
$TEXT=preg_replace("[>]","",$TEXT);
trim($TEXT);
//$_SESSION['ActiveID']=$ID;
$fo=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$pname.html","r+");
$tmp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp.html","w+");
while(!feof($fo))
{
    $ch2=fgets($fo);
    echo $ch2;
    if(stristr($ch2,$ID)!==false)
    {
        $b=1;
    }
    if($b!=1)
    {
     fputs($tmp,$ch2);
    }
    //echo $ID;
    
    if($b==1)
    { 
        if(stristr($ID,"h")!==false){    
     fputs($tmp,"<input id='$ID' onselect='getselectedcontent($ID)' onclick='setactiveId($ID,event)' onfocusout='savetext($ID)' class='heading' type='text' value='$TEXT'/>".PHP_EOL);
		$b=0;}
	else{
     if(preg_match("<\/textarea>",$ch2)){
	 fputs($tmp,"<textarea rows='8' cols='4' id='$ID' onselect='getselectedcontent($ID)' onclick='setactiveId($ID,event)' onfocusout='savetext($ID)' class='heading' value='$TEXT'>$TEXT</textarea>".PHP_EOL); 
	 $b=0;}
	}
    } 
}
fclose($fo);
fclose($tmp);
unlink("$pname.html");
rename("temp.html","$pname.html");
?>