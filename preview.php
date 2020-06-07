<?php
session_start();
$name=$_SESSION['filename'];
//link
$pagecollection=array();
$fp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/link.txt","r+");
//$tmp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/$name.html","r+");
while(!feof($fp))
{
 $ch2=fgets($fp);
 echo ":".$ch2.":"; 
 $ch2 = trim(preg_replace('/\s+/', ' ', $ch2));
 echo $ch2."yes";
 $b=explode(" ",$ch2);
 print_r($b);
 echo count($b);
 $p=$b[0];
 echo "valueofp$p";
 echo $b[0];
 //array_push($pagecollection,$b[0]);
//print_r($pagecollection);
 //if(stristr($ch2,"$name.html")!=false)
 //{
	$tmp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/$p","r+");
	$ttemp=fopen($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/fg.html","w+"); 
	if(count($b)!=1)
	 {
		 echo "yoyo";
		while(!feof($tmp))
		{
			echo "red";
			$ch3=fgets($tmp);
			if(stristr($ch3,$b[1])!=false)
			{
			 if(count($b)==4)
			 {
				 echo "yellow";
				 $e=count($b);
				 echo $e;
				 echo ":::".$b[3].":::$ch3";
			   if(stristr($ch3,$b[3])!=false)
			   {
				   echo "golgappa";
				   $e=$b[3];
				$start=strpos("$ch3","$e",0);
				echo ":".$start.":";
				$v=substr($ch3,0,$start);
				echo $v."987";
				$l=strlen($b[3]);
				echo "666".$l;
				$end=substr($ch3,$start+$l);
				echo $end;
				$finalstr=$v." <a href='".$b[2]."'>".$b[3]."</a>".$end;
				fputs($ttemp,$finalstr);
				//break 1;
			   }
			   else
			   {
				   echo "grey";
                fputs($ttemp,$ch3);
			   }
			 }
			 else
			 {
				 echo "green";
			   $finalstr="<a href='".$b[2]."'>".$ch3."<a/>";
			   fputs($ttemp,$finalstr);
			   //break 1;
			 }
			}
			else
			{
				echo "black";
				fputs($ttemp,$ch3);
			}
		}
		fclose($tmp);
		fclose($ttemp);
		unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/$p");
		rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/fg.html",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/".$b[0]);
	 }
	 else
	 {
		 fclose($tmp);
		 fclose($ttemp);
		unlink($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/fg.html");
		//rename($_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/fg.html",$_SERVER['DOCUMENT_ROOT']."/webbuilder/$name/final/".$b[0]);
	 }
 //}
}

?>