<?php
session_start();
$name=$_SESSION['filename'];
$actives=$_SESSION['activestyle'];
$name=$_SESSION['filename'];
$active=explode('.',$_SESSION['activepage'])[0];
$fpr=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$active.html","r+");
$tmp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/$active.html","w+");
$fpr1=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$actives","r+");
$t1=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/$actives","w+");

$a=1;
$tcheck=1;
$finalv="";
//html file heading
while(!feof($fpr))
{$ch=fgets($fpr);
 
 
 if(stristr($ch,"input")==false && stristr($ch,"textarea")==false && $tcheck && stristr($ch,"dragmodule.js")==false &&stristr($ch,"activator.js")==false &&stristr($ch,"<img")==false){
	 fputs($tmp,$ch);
	}

 if(preg_match("/<input id='h/",$ch)){
$p1=strpos($ch,'\'',0);
$p2=strpos($ch,'\'',$p1+1);
$p3=strrpos($ch,'\'',0);
$p4=strpos($ch,"value")+7;
$finalid=substr($ch,strpos($ch,'\'')+1, $p2-$p1-1);
$finalvalue=substr($ch,$p4,$p3-$p4);
$txt=PHP_EOL."<h1 id='$finalid'>$finalvalue</h1>".PHP_EOL;
  fputs($tmp,$txt);
  }
 
 if(preg_match("/<textarea/",$ch)){
$p1=strpos($ch,"id")+3;
$p2=strpos($ch,'\'',$p1+1);

$finalid=substr($ch,$p1+1, $p2-$p1-1);


   if(preg_match("/<\/textarea>/",$ch)){ 
   $p3=strrpos($ch,"</textarea>",0);
   $p4=strpos($ch,"'>",0)+2;
   $finalvalue=substr($ch,$p4,$p3-$p4);
   $txt=PHP_EOL."<p id='$finalid'>$finalvalue</p>".PHP_EOL;
  fputs($tmp,$txt);
   
   
   }
   else $tcheck=0;
   
  }
   if($tcheck==0){
	 if(preg_match("/<textarea/",$ch)){
	 $p5=strpos($ch,"value",0)+7;
	 $p6=strlen($ch);
	 $finalvalue=substr($ch,$p5,$p6-$p5);
	 
	 }
	 else if(preg_match("/'>/",$ch)){ 
	
	 $p5=strpos($ch,"'>",0);
	 $finalvalue=$finalvalue."<br/>".substr($ch,0,$p5);
	 $txt=PHP_EOL."<p id='$finalid'>$finalvalue</p>".PHP_EOL;
  fputs($tmp,$txt);
	 
	 }
	 else{
		if(preg_match("/<\/textarea>/",$ch))  $tcheck=1;
	    else $finalvalue=$finalvalue."<br/>".$ch;
	 }
  }
 
 if(preg_match("/<img src=/",$ch)){
	 $aa=strpos($ch,'\'');
	 $bb=strpos($ch,'\'',$aa+1);
	 $p1=strpos($ch,'\'',$bb+1);
	 $bb=substr($ch,$aa+1,$bb-$aa-1);
     $p2=strpos($ch,'\'',$p1+1);
	 $finalid=substr($ch,$p1,$p2-$p1+1);
	
	 $finalvalue="<img src='../$bb' id=$finalid/>";
	 fputs($tmp,$finalvalue);
	 
 }
}














//css heading
$check=1;

while(!feof($fpr1))
{$ch=fgets($fpr1);
 if(stristr($ch,"heading")){
 $check=0;
 }
 else{
     if($check==0){
	 if(stristr($ch,"}")) {$check=1;
	 $ch=fgets($fpr1);
	 }
	}
	 if($check==1)fputs($t1,$ch);
	 
	 
 }
}

//css image



fclose($fpr);

fclose($fpr1);
fclose($tmp);

fclose($t1);
?>