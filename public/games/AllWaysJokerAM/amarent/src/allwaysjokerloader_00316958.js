var scripts = [["game","../allwaysjoker/src/allwaysjoker_00316957.js","UTF-8"]];

function getParam(name)
{
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( window.location.href );
    if( results == null )
      return "";
    else
      return results[1];
}
	
function loadScript(id, source, cs)
{	
	if(cs == "UTF-8")
	{
		document.write("<script id=\"js_"+id+"\" type=\"text/javascript\" src=\""+ source+"\" charset=\"utf-8\"></script>");
	}
	else	
	{
		document.write("<script id=\"js_"+id+"\" type=\"text/javascript\" src=\""+ source+"\"></script>");
	}
}
	
function loadScripts()
{
	sessionStorage.sessionValue12 = getParam("config");
	
	scripts.unshift(["config","./src/config_"+sessionStorage.sessionValue12+"_00366957.js","ISO-8859-1"]);
	
	for(var i=0,len=scripts.length;i<len;i++)
	{
		loadScript(scripts[i][0],scripts[i][1],scripts[i][2]);
	}
}
	
loadScripts();