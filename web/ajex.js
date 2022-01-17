function bodyOnload()
{
    doCallAjax1();
    doCallAjax2();
    doCallAjax3();
	setTimeout("doLoop();",1000);
}

function doLoop()
{
	bodyOnload();
}
       
    var HttPRequest = false;
    var HttPRequest2 = false;
    var HttPRequest3 = false;
    var HttPRequest4 = false;

	   function doCallAjax1() {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
          }

          var pmeters;
          HttPRequest.open('POST','query/query1.php',true);
          HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          HttPRequest.setRequestHeader("Content-length", pmeters);
          HttPRequest.setRequestHeader("Connection", "close");
          HttPRequest.send(pmeters);
          
          
          HttPRequest.onreadystatechange = function()
          {

               if(HttPRequest.readyState == 3)  // Loading Request
                {
                 document.getElementById("mySpan").innerHTML = "Now is Loading...";
                }

               if(HttPRequest.readyState == 4) // Return Request
                {
                 document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
                }
           }
        }

        function doCallAjax2() {
            HttPRequest2 = false;
            if (window.XMLHttpRequest) { // Mozilla, Safari,...
               HttPRequest2 = new XMLHttpRequest();
               if (HttPRequest2.overrideMimeType) {
                  HttPRequest2.overrideMimeType('text/html');
               }
            } else if (window.ActiveXObject) { // IE
               try {
                  HttPRequest2 = new ActiveXObject("Msxml2.XMLHTTP");
               } catch (e) {
                  try {
                     HttPRequest2 = new ActiveXObject("Microsoft.XMLHTTP");
                  } catch (e) {}
               }
            } 
            
            if (!HttPRequest2) {
               alert('Cannot create XMLHTTP instance');
               return false;
            }
  
            var pmeters;
            HttPRequest2.open('POST','query/query2.php',true);
            HttPRequest2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            HttPRequest2.setRequestHeader("Content-length", pmeters);
            HttPRequest2.setRequestHeader("Connection", "close");
            HttPRequest2.send(pmeters);
            
            
            HttPRequest2.onreadystatechange = function()
            {
  
                 if(HttPRequest2.readyState == 3)  // Loading Request
                  {
                   document.getElementById("mySpan2").innerHTML = "Now is Loading...";
                  }
  
                 if(HttPRequest2.readyState == 4) // Return Request
                  {
                   document.getElementById("mySpan2").innerHTML = HttPRequest2.responseText;
                  }
             }
          }

          function doCallAjax3() {
            HttPRequest3 = false;
            if (window.XMLHttpRequest) { // Mozilla, Safari,...
               HttPRequest3 = new XMLHttpRequest();
               if (HttPRequest3.overrideMimeType) {
                  HttPRequest3.overrideMimeType('text/html');
               }
            } else if (window.ActiveXObject) { // IE
               try {
                  HttPRequest3 = new ActiveXObject("Msxml2.XMLHTTP");
               } catch (e) {
                  try {
                     HttPRequest3 = new ActiveXObject("Microsoft.XMLHTTP");
                  } catch (e) {}
               }
            } 
            
            if (!HttPRequest3) {
               alert('Cannot create XMLHTTP instance');
               return false;
            }
  
            var pmeters;
            HttPRequest3.open('POST','query/query3.php',true);
            HttPRequest3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            HttPRequest3.setRequestHeader("Content-length", pmeters);
            HttPRequest3.setRequestHeader("Connection", "close");
            HttPRequest3.send(pmeters);
            
            
            HttPRequest3.onreadystatechange = function()
            {
  
                 if(HttPRequest3.readyState == 3)  // Loading Request
                  {
                   document.getElementById("mySpan3").innerHTML = "Now is Loading...";
                  }
  
                 if(HttPRequest3.readyState == 4) // Return Request
                  {
                   document.getElementById("mySpan3").innerHTML = HttPRequest3.responseText;
                  }
             }
          }
