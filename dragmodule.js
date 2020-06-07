function setactiveId(ids,event)
{
    var e;
    //alert("hello");
    alert(ids);
        e=ids.id;
        alert(event.bubbles);
        
    var  xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                     }
                     
                    };
                    xhttp.open("POST","setactiveId.php",true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send("id="+e);
                        event.stopPropagation();                
}
function preview(){
var  xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //alert(this.responseText);
                     }
                     
                    };
                    xhttp.open("POST","../genpreview.php",true);
                    xhttp.send();    
}
function getselectedcontent(ids)
{
    var cid=ids.id
    
    var a=document.getElementById(cid);
    var b=a.value.substring(a.selectionStart,a.selectionEnd);
    var  xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                     }
                     
                    };
                    xhttp.open("POST","../setselectedtext.php",true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send("seltext="+b);
					
                        
    
}
function savetext(ids)
{
    //var ids=this.id;
    var e=ids.id;
    var value=ids.value;
    //var left=ids.left;
    //var top=ids.top;
    //alert(e);
    var  xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //alert(this.responseText);
                     }
                     
                    };
                    xhttp.open("POST","savingTEXT.php",true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send("id="+e+"&text="+value);  
preview();						
}
var f = function(){
function res(e,cont,ele)
{
 j=1;
 this.element=e;
 function abc(ev){
 j=0;
 function startres(ev)
 {
	var w=(ev.clientX)+"px";
	var h=(ev.clientY)+"px";
	var contid=cont.id;
	var eleid=ele.id;
    var  xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //alert(this.responseText);
                     }
                     
                    };
                    xhttp.open("POST","savingstyle.php",true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send("width="+w+"&height="+h+"&type=resize"+"&cont="+contid+"&ele="+eleid);
    cont.style.width=w;
    cont.style.height=h;
    ele.style.width=cont.style.width;
    ele.style.height=cont.style.height;
 }
 function stop(ev)
 {
  j=1;
  window.removeEventListener('mousemove',startres,false);
  window.removeEventListener('mouseup',stop,false);
 }
 window.addEventListener('mousemove',startres,false);
 window.addEventListener('mouseup',stop,false);
 }
 this.element.addEventListener('mousedown',abc,false);
}


    function Draggable(element){
        this.element = element;
        //this.dragStart = dragStart;
        //this.dragDrop = dragDrop;

        //this.element.classList.add('draggable');
        var self = this;

        var move = function(event){
            //if(self.dragStart !== undefined){ self.dragStart();}
           //don't bubble this event - mousedown
            //event.stopPropagation();
            //prevent any default action
            //event.preventDefault();
            var originalLeft = parseInt(window.getComputedStyle(this).left);
            var originalTop = parseInt(window.getComputedStyle(this).top);
            var ids=this.id;
            var value=this.value;
            var mouseDownX = event.clientX;
            var mouseDownY = event.clientY;

            function dragMe(event){
                var left=originalLeft + event.clientX - mouseDownX + "px";
                var top=originalTop + event.clientY - mouseDownY + "px";
                //var ids=self.element;
                //alert(ids);
                var  xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //alert(this.responseText);
                     }
                     
                    };
                    xhttp.open("POST","savingstyle.php",true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send("left="+left+"&top="+top+"&id="+ids+"&text="+value+"&type=drag");
                //xhttp.open("GET","savingstyle.php?left="+left+"&top="+top,true);
                //xhttp.send();
				 
                self.element.style.left = originalLeft + event.clientX - mouseDownX + "px";
                self.element.style.top = originalTop + event.clientY - mouseDownY + "px";
				
               // event.stopPropagation();
            }

            function dropMe(event){
				preview();
                document.removeEventListener('mousemove',dragMe,true);
                document.removeEventListener('mouseup',dropMe,true);
               // if(self.dragDrop !== undefined){ self.dragDrop();}
               // event.stopPropagation();
            }
          if(j){
            document.addEventListener('mouseup',dropMe,true);
            document.addEventListener('mousemove',dragMe,true);
		  }

        };

        this.element.addEventListener('mousedown',move,false);
    }

   /* var dragStart = function(){
        this.element.style.width = parseInt(window.getComputedStyle(this.element).width)  + "px";
    }
    var dragDrop = function(){
        this.element.style.width = parseInt(window.getComputedStyle(this.element).width)  + "px";
    }*/
   var j=1; 
};
window.addEventListener('load',f,false);