sessionStorage.clear();

	var serverString='';

    var XmlHttpRequest = new XMLHttpRequest();
    XmlHttpRequest.overrideMimeType("application/json");
    XmlHttpRequest.open('GET', '/socket_config.json', false);
    XmlHttpRequest.onreadystatechange = function ()
    {
        if (XmlHttpRequest.readyState == 4 && XmlHttpRequest.status == "200")
        {
            var serverConfig = JSON.parse(XmlHttpRequest.responseText);
            serverString=serverConfig.prefix_ws+serverConfig.host_ws+':'+serverConfig.port;
          
        }
    }
    XmlHttpRequest.send(null);



function Config() 
{
	this.value6 = serverString;
	this.value46 = 5;
	this.value47 = 10000;
	this.value71 = 1000;
	this.value10 = 3000; 	
	this.value65 = 0;
	this.value66 = 1000;
	this.value67 = 0;
	this.value64 = false;
	this.value19 = false;
	this.value39 = 0;
	this.value8 = '../../../../';	
	this.value30 = "..";
	this.value45 = 4;
	this.value73 = {w:960,h:480};
	this.value21 = {f:true,s:null,m:0.01,ts:null,cs:null};
	this.value72 = {EUR:{s:"\u20AC",m:0.01,ts:null,cs:"."},GPB:{s:"\u00A3",m:0.01,ts:null,cs:"."},USD:{s:"\u0024",m:0.01,ts:null,cs:"."},AUD:{s:"\u0024",m:0.01,ts:null,cs:"."},CAD:{s:"\u0024",m:0.01,ts:null,cs:"."},NZD:{s:"\u0024",m:0.01,ts:null,cs:"."},NOK:{s:"kr",m:0.01,ts:null,cs:"."},SEK:{s:"kr",m:0.01,ts:null,cs:"."},ZAR:{s:"R",m:0.01,ts:null,cs:"."},INR:{s:"\u20B9",m:1,ts:null,cs:null},RUB:{s:"\u20BD",m:0.01,ts:null,cs:"."},CHF:{s:"CHF",m:0.01,ts:null,cs:"."},HRK:{s:"kn",m:0.01,ts:null,cs:"."},HUF:{s:"Ft",m:1,ts:null,cs:null},GEL:{s:"\u20BE",m:0.01,ts:null,cs:"."},UAH:{s:"\u20B4",m:0.01,ts:null,cs:"."},RON:{s:"lei",m:0.01,ts:null,cs:"."},BRL:{s:"R\u0024",m:0.01,ts:null,cs:"."}};
	this.value68 = "fun";
	this.value5 = ["en","de","es","fr","pt","ru","ka","ro","tr","et","el","bg","hu","zh","cs","hr","it","sv"];
	this.value11 = false; 
	this.value49 = true;
	this.value28 = false;
	this.value12 = true; 
	this.value51 = true;
	this.value36 = false;
	this.value84 = false;
	this.value85 = {b:false,s:false};
	this.value81 = {e:true,d:false,r:false};
	this.value50 = {h:false};
	this.value74 = null;
	this.value40 = 1.0;
	this.value80 = {g:{d:{ls:true,lp:false,ps:true,pp:true}, s:{ls:true,lp:false,ps:true,pp:false}},l:{d:{ls:true,lp:false,ps:true,pp:true}, s:{ls:true,lp:false,ps:true,pp:true}}};
	this.value20 = 20;
	this.value79 = 0;
	this.value82 = false;
	this.value83 = true;
	this.value76 = '../../../../';
	this.value86 = false;

}


