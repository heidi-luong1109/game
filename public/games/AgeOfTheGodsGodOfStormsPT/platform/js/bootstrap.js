(function(b){b.platformStartTime=Date.now();var e=function(){if(!b.console){b.console={log:function(){},debug:function(){},info:function(){},error:function(){},warn:function(){},fatal:function(){},assert:function(){},trace:function(){}}}if(b.console&&!b.console.debug){b.console.debug=function(){}}if(b.console&&!b.console.warn){b.console.warn=function(){}}};var a=function(){Detect.init({userAgent:window.navigator.userAgent,screenWidth:screen.width,screenHeight:screen.height,devicePixelRatio:window.devicePixelRatio})};var g=function(){var m=Detect.Type.is(Detect.T.Desktop)?"desktop":"mobile";var j=CP.Utils.getParam("runType",false);if(["mobile","desktop"].indexOf(j)!==-1){m=j}if(CP.Utils.getParam("runType")=="mini"){m="miniGame"}if(CP.Utils.getParam("runType")=="nativeapp"){m="mobile"}var k=b.document.createElement("link");var n=b.document.getElementsByTagName("head")[0];n.appendChild(k);k.setAttribute("type","text/css");k.setAttribute("rel","stylesheet");k.setAttribute("href","css/"+m+"/"+m+"Platform.css");k=b.document.createElement("link");n.appendChild(k);k.setAttribute("type","text/css");k.setAttribute("rel","stylesheet");k.setAttribute("href","css/"+m+"/"+m+"Brand.css")};var c=function(){return window.Detect.OS.is(window.Detect.O.Android)};var h=function(){return window.Detect.OS.version()};var d=function(){var j=CP.Utils.getParam("viewport");var k=(window.self!==window.top)&&(CP.Utils.getParam("hub")==="1");j=k&&(j!=="css")?"js":!k&&(j!=="js")?"css":j;if(j==="css"){if(c()&&h()<4.3){ViewportManager.init();return}var l=document.body.className;l+=" css-scaling";document.body.className=l;if(CP.Utils.getParam("runtype")=="nativeapp"){return}if(CP.Utils.isCore1Game(CP.Utils.getParam("game"))){document.body.className+=" core1";i()}else{}}else{ViewportManager.init()}};var i=function(){var k=Detect.Device.rawResult();if(k.deviceResolution){var o=Detect.Browser.commercialName();var q=k.deviceResolution.getBrowser(o);if(q){var p=q.getLandscape();var t=q.getPortrait();var j=document.createElement("style");j.setAttribute("type","text/css");var r=p[0]*window.cpi;var n=p[1]*window.cpi;var m=t[0]*window.cpi;var u=t[1]*window.cpi;var l="@media screen and (orientation: landscape){ .gameFrame{ width: "+r+"px; height:"+n+"px;} body{height:"+p[1]+"px; } } @media screen and (orientation: portrait){ .gameFrame{width:"+m+"px; height:"+u+"px;} body{height:"+t[1]+"px; } }";var v=document.createTextNode(l);if(j.styleSheet){j.styleSheet.cssText=v.nodeValue}else{j.appendChild(v)}var s=document.getElementsByTagName("head")[0];if(s){s.appendChild(j)}}}};var f=function(){var l=[Math.max(screen.width,screen.height),Math.min(screen.width,screen.height)];var j="@media screen and (orientation: landscape){ body{max-height:"+l[0]+"px; } } @media screen and (orientation: portrait){ body{max-height:"+l[1]+"px; } }";var m=document.createElement("style");var n=document.createTextNode(j);if(m.styleSheet){m.styleSheet.cssText=n.nodeValue}else{m.appendChild(n)}var k=document.getElementsByTagName("head")[0];if(k){k.appendChild(m)}};window.sendPostMessageToContainer=function(j){parent.postMessage(j,"*")};b.bootPlatform=function(){e();a();g();d();b.ImagePreloader.run()}})(window);
