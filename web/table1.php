<?php
	/*** By Weerachai Nukitram ***/
	/***  http://www.ThaiCreate.Com ***/	
?>
<html>
<head>
<title>ThaiCreate.Com Ajax Tutorial</title>
</head>
<script language="JavaScript">
	   var HttPRequest4 = false;

	   function doCallAjax4(Sort) {
		  HttPRequest4 = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest4 = new XMLHttpRequest();
			 if (HttPRequest4.overrideMimeType) {
				HttPRequest4.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest4 = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest4 = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest4) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
			var url = 'querytable.php';
			var pmeters = 'mySort='+Sort;
			HttPRequest4.open('POST',url,true);

			HttPRequest4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest4.setRequestHeader("Content-length", pmeters.length);
			HttPRequest4.setRequestHeader("Connection", "close");
			HttPRequest4.send(pmeters);
			
			
			HttPRequest4.onreadystatechange = function()
			{

				 if(HttPRequest4.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan4").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest4.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan4").innerHTML = HttPRequest4.responseText;
				  }
				
			}

	   }
	</script>
<body Onload="bodyOnload();">


	<script language="JavaScript">

	function bodyOnload()
	{
		doCallAjax4();
		setTimeout("doLoop();",2000);
	}

	function doLoop()
	{
		bodyOnload();
	}
	</script>

<span id="mySpan4"></span>
</body>
</html>