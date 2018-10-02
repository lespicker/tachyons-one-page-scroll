  /////////////////////
 // PRINT FUNCTIONS //
/////////////////////

var gAutoPrint = true; // Flag for whether or not to automatically call the print function
 
function printSpecial()
{
if (document.getElementById != null)
{
var html = '<HTML>\n<HEAD>\n';
 
if (document.getElementsByTagName != null)
{
//var headTags = document.getElementsByTagName("head");
//if (headTags.length > 0)
//html += headTags[0].innerHTML;
}
 
html += '\n</HE>\n<BODY style="background-image:none; margin:10px;">\n';
var printReadyElem = document.getElementById("printReady");
if (printReadyElem != null)
{
html += printReadyElem.innerHTML;
}
else
{
alert("Could not find the printReady section in the HTML");
return;
}
 
html += '\n</BO>\n</HT>';
var printWin = window.open("","printSpecial");
printWin.document.open();
printWin.document.write(html);
printWin.document.close();
if (gAutoPrint)
printWin.print();
}
else
{
alert("Sorry, the print ready feature is only available in modern browsers.");
}
}


  //////////////////////
 // SWITCH FUNCTIONS //
//////////////////////

function hightlighted(my_id, my_id2) {
	
	document.getElementById('switch1').style.display = 'none';
	document.getElementById('switch2').style.display = 'none';
	document.getElementById('switch3').style.display = 'none';		
	document.getElementById(my_id).style.display = 'block';		

	document.getElementById('link1').className = 'hightlighted';
	document.getElementById('link2').className = 'hightlighted';
	document.getElementById('link3').className = 'hightlighted';		
	document.getElementById(my_id2).className = 'hightlighted_down';		


}












