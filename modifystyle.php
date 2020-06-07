<?php
session_start();
$id=$_SESSION['ActiveID'];
$name=$_SESSION['filename'];
$stl=$_SESSION['activestyle'];
$pname=$_SESSION['activepage'];
$pname=explode('.',$pname)[0];
$styletype=$_REQUEST['styletype'];
$value=$_REQUEST['value'];
$a=0;
$b=0;
$d=0;
//echo $id;
//echo $value;
echo $pname;
$fpr=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$stl","r+");
$tmp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp.css","w+");
while(!feof($fpr))
{
    $c=1;
    $ch=fgets($fpr);
    if(strpos($ch,$id)!==false&&$a==0)
    {
        $a=1;
        $d=1;
    }
    
    if(stristr($ch,'}')&&$a==1&&$d==1)
    {
        $b=1;
    }
    if((strcmp($styletype,"color")==0)&&$a==1)
    {
        if(stristr($ch,"color")&&(stristr($ch,"background-color")))
        {
            $c=0;
        }
    }
     if(stristr($ch,"$styletype")&&$a==1&&$c==1&&$d==1)
     {
     //  if(!(stristr($ch,"background-color")!=false&&strcmp($styletype,"color")==0))
       
        if(stristr($styletype,"color")!=false||stristr($styletype,"border-style")!=false||stristr($styletype,"font-weight")!=false||stristr($styletype,"font-style")!=false||stristr($styletype,"text")!=false||stristr($styletype,"box-shadow")!=false)
        $str="$styletype:$value;".PHP_EOL;
        else
        $str="$styletype:$value"."px;".PHP_EOL;
        fputs($tmp,$str);
        //$a=0;
       
     }
    
    else
    {
     if($b!=1)
     {
        fputs($tmp,$ch);
     }
     else
     {
         if($d==1)
         {
        if(stristr($styletype,"color")!=false||stristr($styletype,"border-style")!=false||stristr($styletype,"font-weight")!=false||stristr($styletype,"font-style")!=false||stristr($styletype,"text")!=false||stristr($styletype,"box-shadow")!=false)
        $str="$styletype:$value;".PHP_EOL."}".PHP_EOL;
        else
        $str="$styletype:$value"."px;".PHP_EOL."}".PHP_EOL;
        fputs($tmp,$str);
        $b=0;
        //$a=0;
        $d=0;
         }
     }
    }
}
fclose($fpr);
fclose($tmp);
unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$stl");
rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp.css",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$stl");
?>