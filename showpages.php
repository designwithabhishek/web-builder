<?php
session_start();
$name=$_SESSION['filename'];
//echo "<p>hello</p>";
$dir=$_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name";
$files1=scandir($dir);
$pagesel=fopen($_SERVER['DOCUMENT_ROOT'] . "/webbuilder/$name/record.txt","r+") or die("Unable to open file!");
for($i=0;$i<count($files1);$i++)
{
 rewind($pagesel);
 if(stristr($files1[$i],".html"))
 {
   while(!feof($pagesel))
   {
       $ch=fgets($pagesel);
       if(stristr($ch,$files1[$i]))
       {
        $st=explode(" ",$ch);
        $str=rtrim($st[1]);
        $dragmod=rtrim($st[2]);
        echo "<iframe  src=\"$name/$files1[$i]\" width=200px height=200px ></iframe><button onclick=\"activepage('$files1[$i]','$str','$dragmod')\">$files1[$i]</button>"; 
       }
    }
 }
}
//print_r($files1);
?>