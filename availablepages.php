<?php
session_start();
$name=$_SESSION['filename'];
$a=array();
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
        array_push($a,"$files1[$i]");
        //echo "<iframe  src=\"$name/$files1[$i]\" width=200px height=200px ></iframe><button onclick=\"activepage('$files1[$i]','$str','$dragmod')\">$files1[$i]</button>"; 
       }
    }
 }
}
echo "<p>Select element where to Link: <select id='pagescollection'>";
for($i=0;$i<count($a);$i++)
{
    $sr="<option value='".$a[$i]."'>".$a[$i]."</option>";
    echo $sr;
}
echo "</select></p>";
?>