<?php
session_start();
$name=$_SESSION["filename"];
$stl=$_SESSION['activestyle'];
$LEFT=$_REQUEST['left'];
$TOP=$_REQUEST['top'];
$ID=$_REQUEST['id'];
$TEXT=$_REQUEST['text'];
$Type=$_REQUEST['type'];
$Cont=$_REQUEST['cont'];
$Ele=$_REQUEST['ele'];
$Height=$_REQUEST['height'];
$Width=$_REQUEST['width'];
$fpr=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$stl","r+");
$tmp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp.css","w+");
$a=0;$b=0;$c=0;
if(strcmp($Type,"drag")==0){
$r=$ID;
$ID="#".$ID;
while(!feof($fpr))
{
    
    $ch=fgets($fpr);
    //$slenth=strlen($ch);
    //$slenth=-1*$slenth;
    //echo $ID;
    if(strpos($ch,$ID)!==false)
    {
        $a=1;
    }
    if(stristr($ch,"left" )!==false&&$a==1)
    {
        //fseek($fpr,$slenth,SEEK_CUR);
        $b=1;
    }
    if(stristr($ch,"top")!==false&&$a==1)
    {
        $c=1;
        //fseek($fpr,$slenth,SEEK_CUR);
    }
    
        if($b==1)
        {
        fputs($tmp,"left:$LEFT;".PHP_EOL);
		
        $b=0;
        }
        elseif($c==1)
        {
            fputs($tmp,"top:$TOP;".PHP_EOL);
             $c=0;$a=0;
        }
        else
        {
            fputs($tmp,$ch);
        }
    if(stristr($ch,'}')!=false&&$a==1)
    {
        $a=0;
    }
    
}
fclose($fpr);
fclose($tmp);
unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$stl");
rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp.css",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$stl");

	
	
}
else{
	$Cont="#".$Cont;
		$cursor="#".$Ele."handle";
	$Ele="#".$Ele;

	
	while(!feof($fpr)){
		$ch=fgets($fpr);
		if((stristr($ch,$Cont)!==false ||stristr($ch,$Ele)!==false)&&stristr($ch,$cursor)===false){
		$a=1;
		
		}
		 if(stristr($ch,"height" )!==false&&$a==1)
    {
        //fseek($fpr,$slenth,SEEK_CUR);
        $b=1;
    }
    if(stristr($ch,"width")!==false&&$a==1)
    {
        $c=1;
        //fseek($fpr,$slenth,SEEK_CUR);
    }
    
        if($b==1)
        {
        fputs($tmp,"height:$Height;".PHP_EOL);
		
        $b=0;
        }
        elseif($c==1)
        {
            fputs($tmp,"width:$Width;".PHP_EOL);
             $c=0;$a=0;
        }
        else
        {
            fputs($tmp,$ch);
        }
    if(stristr($ch,'}')!=false&&$a==1)
    {
        $a=0;
    }
		
      
	}
	fclose($fpr);
fclose($tmp);
unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$stl");
rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp.css",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$stl");
	}

?>