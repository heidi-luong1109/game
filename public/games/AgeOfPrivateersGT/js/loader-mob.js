

/*
загрузка файла с настройками, и загрузка изображений


*/
var loader;
var Preloader=new Object(null);
var loadPrc=0;
var loadPrc2=0;
var gamePreloader=new Object(null);
var currentResCnt2=0;
var isSplitStarted=true;

function UpdateLoadProgress(evType){



if(totalSource<=currentSource){


}

}



function SpriteSourceLoad(spriteName,gSource){



if(gSource.config==""){
return;
}


totalSource+=2;

var tmpImg=new Image();
tmpImg.src=gSource.file;
tmpImg.onload=function(){currentSource++;UpdateLoadProgress("done");};
tmpImg.onerror=function(){currentSource++;UpdateLoadProgress("error");};

slotSpriteSource[spriteName] =new Object();
slotSpriteSource[spriteName].sprite=tmpImg;

var mainSlotSet = new XMLHttpRequest();

mainSlotSet.onreadystatechange = function(ev) {

if (this.readyState == 4 && this.status == 200) {


currentSource++;

var setObj=JSON.parse(String(ev.currentTarget.responseText));
slotSpriteSource[spriteName].config=setObj;

}

};




mainSlotSet.open("GET", gSource.config, true);
mainSlotSet.send();



}









function LoadSlot(resObj){




loader=new PIXI.loaders.Loader();
slotResource=resObj;

for(prop in resObj){



	if(resObj[prop].spriteSheet!=undefined || prop=="linesGame"){


	

	if(prop=="linesGame"){

	for(var i=0;i<slotSettings.SymbolGame.length;i++){

	  
	  
	

	loader.add('lnWinSym_'+slotSettings.SymbolGame[i],resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]].config);
	animationsRate['lnWinSym_'+slotSettings.SymbolGame[i]]=	resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]].framerate;

	if(resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_FS']!=undefined){
	
	loader.add('lnWinSym_'+slotSettings.SymbolGame[i]+'_FS',resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_FS'].config);
	animationsRate['lnWinSym_'+slotSettings.SymbolGame[i]+'_FS']=	resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_FS'].framerate;
	
	}
	
	if(resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG']!=undefined){
	
	loader.add('lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG',resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG'].config);
	animationsRate['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG']=	resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG'].framerate;
	
	}

if(resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG_MASK']!=undefined){
  
        loader.add('lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG_MASK',resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG_MASK'].config);
	animationsRate['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG_MASK']=resObj[prop]['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG_MASK'].framerate;
}



	




	}

	}else{
	 loader.add(prop,resObj[prop].spriteSheet.config); 
	  
	}

	}


}















loader.on('progress',function (loader,res) {


loadPrc=Math.round(loader.progress);


});


loader.load(function(ev,resources){

for(var i=0;i<slotSettings.SymbolGame.length;i++){



 if(resources['lnWinSym_'+slotSettings.SymbolGame[i]]!=undefined){ 
animationsArr['lnWinSym_'+slotSettings.SymbolGame[i]]=resources['lnWinSym_'+slotSettings.SymbolGame[i]].data.frames;
 }
 
if(resources['lnWinSym_'+slotSettings.SymbolGame[i]+'_FS']!=undefined){
animationsArr['lnWinSym_'+slotSettings.SymbolGame[i]+'_FS']=resources['lnWinSym_'+slotSettings.SymbolGame[i]+'_FS'].data.frames;
}

if(resources['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG']!=undefined){
animationsArr['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG']=resources['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG'].data.frames;
}

if(resources['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG_MASK']!=undefined){
 animationsArr['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG_MASK']=resources['lnWinSym_'+slotSettings.SymbolGame[i]+'_LONG_MASK'].data.frames; 
}

}








});









}

function UpdateLoader(){

if(!isFontLoaded){
	return;
}

	if(loadPrc2<loadPrc){
	loadPrc2++;
	}

Preloader.rectBg.scale.x=loadPrc2/100;

if(loadPrc2==96 && isSplitStarted){
isSplitStarted=false;
localStorage.setItem('gameLoaded', 'true_'+RandomInt(0,999999) );
}

var blockPrc=Math.round(loadPrc2/4);

if(loadPrc2>=100){

app.ticker.remove(UpdateLoader);

clearInterval(Preloader.finter1);
clearInterval(Preloader.finter0);
app.stage.removeChild(Preloader.main);
app.ticker.stop();
clearInterval(updateScreen);
updateScreen=setInterval(function(){

document.body.style['background-color']="#000000";

app.ticker.update();

},1000/CANVAS_FPS);



setTimeout(function(){
CreateGame();
app.stage.removeChild(Preloader.main);
delete Preloader.main;


},500);

}


}





function LoadSlotSettings(){


var mainSlotSet = new XMLHttpRequest();

mainSlotSet.onreadystatechange = function(ev) {




	if (this.readyState == 4 && this.status == 200) {
	var setObj=JSON.parse(String(ev.currentTarget.responseText));



	LoadSlot(setObj);

	}

};
mainSlotSet.open("GET", "/games/AgeOfPrivateersGTM/config/desktop_view.json", true);
mainSlotSet.send();




}
