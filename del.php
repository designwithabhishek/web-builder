
<?php
session_start();
$actives=$_SESSION['activestyle'];
$actived=$_SESSION['activedragmod'];

$id=$_SESSION['ActiveID'];
$name=$_SESSION['filename'];
$active=explode('.',$_SESSION['activepage'])[0];
$fpr2=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$active.html","r");
$tmp2=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp2.html","w+");
$fp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$actives","r+");
$tmp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp1.css","w+");
$fpr1=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$actived","r+");
$tmp1=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp.js","w+");
$p=1;
$i=1;
$drag="textElement".$id;
$s="s".$id;
$cssid="#".$id;
$csscheck=1;

if(!empty($id)&& $id!=="body"){
while(!feof($fpr2)){
$ch=fgets($fpr2);	
if(preg_match("/id='$id.*'/",$ch)){
if(stristr($id,"p")) $p=0;
if(preg_match("/<\/div>/",$ch)) {$ch=fgets($fpr2); 
 $ch=fgets($fpr2);
 }
}
if(preg_match("/id='$id.*'/",$ch)==false){
         if($p) fputs($tmp2,$ch);
	
	


}
if(preg_match("/<\/textarea>/",$ch)) $p=1;

}

//dragmodule..........
while(!feof($fpr1)){
$ch=fgets($fpr1);
if(preg_match("/document\.getElementById\('$id.*'\)/",$ch)==false &&preg_match("/Draggable\($drag.*\)/",$ch)==false &&preg_match("/$s/",$ch)==false)	
fputs($tmp1,$ch);
}
//css 
while(!feof($fp)){
$ch=fgets($fp);
  if(stristr($ch,$cssid)) $csscheck=0;
 if(stristr($ch,$cssid)==false && $csscheck){
 fputs($tmp,$ch);
 }
if(stristr($ch,"}")) $csscheck=1;
	
	
}

fclose($fp);
fclose($tmp);
fclose($fpr1);
fclose($tmp1);
fclose($fpr2);
fclose($tmp2);
unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$actived");
rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp.js",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$actived");
unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$actives");
rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp1.css",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$actives");
unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$active.html");
rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/temp2.html",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/$active.html");

}
echo $active;
?>

