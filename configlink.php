<?php
session_start();
$name=$_SESSION['filename'];
$elementselected=$_REQUEST['linked'];
$wheretolink=$_REQUEST['pagewheretolink'];
$pname=$_SESSION['activepage'];
$pname=explode('.',$pname)[0];
$linktext=$_SESSION['selectedtext'];
unset($_SESSION['selectedtext']);
echo "text selected: $linktext";
$fp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/link.txt","r+");
$tmpfp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/templink.txt","w+");
$txt="$pname.html $elementselected $wheretolink $linktext".PHP_EOL;
$check=0;
while(!feof($fp))
{
    $ch=fgets($fp);
    if(stristr($ch,$pname)!=false)
    {
        $b=explode(" ",$ch);
        if(count($b)!=1)
        {
         if(strcmp($b[1],$elementselected)==0)
         {
             echo $b[1];
             $check=1;
          fputs($tmpfp,$txt);
         }
         else{
             echo "hello";
            fputs($tmpfp,$ch); 
         }
        }
        else
        {
            echo  "er";
            $check=1;
            fputs($tmpfp,$txt);    
        }
    }
    else
    {
        echo "uyt";
        fputs($tmpfp,$ch);
    }
}
if($check!=1)
    {
        echo "uc";
        fputs($tmpfp,$txt);
    }
fclose($fp);
fclose($tmpfp);
unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/link.txt");
rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/templink.txt",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/link.txt");
?>