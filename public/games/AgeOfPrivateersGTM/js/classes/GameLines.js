function MiniBorder(viewContainer,borderTex,borderWin,borderLine,setObj,borderParam){
  
var objArr= new Array();

this._view=new PIXI.Container();
/*---------------*/
var style = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 25,
    fontWeight: 'bold',
    fill: [borderParam.front_c], // gradient
    stroke: '#FFFFFF',
    strokeThickness: 0,
    align: 'center',
    dropShadow:false,
    dropShadowColor: '#FFFFFF',
    dropShadowBlur: 5,
    dropShadowAngle: 0,
    dropShadowDistance: 0,
    wordWrap: false,
    wordWrapWidth: 440
});



objArr['text']=new PIXI.Text(NumFormat(borderWin), style);

objArr['text'].anchor.set(0.5, 0.5);
/*-------------------*/

var xOffset=30;
var borderWidth=6;

var graphics_back = new PIXI.Graphics();
graphics_back.beginFill(0x000000, 1);
graphics_back.drawRect(0, 0, objArr['text'].width+xOffset, borderParam.segments[2].y);	

/*------------*/		
	
var graphics_back1 = new PIXI.Graphics();
graphics_back1.lineStyle(borderWidth, borderParam.back,1,1).moveTo(0, 0);	
graphics_back1.lineTo(objArr['text'].width+xOffset,0);	
graphics_back1.lineTo(objArr['text'].width+xOffset,borderParam.segments[2].y);	
graphics_back1.lineTo(0,borderParam.segments[2].y);	
graphics_back1.lineTo(0,0);	
	
var graphics_back2 = new PIXI.Graphics();
graphics_back2.lineStyle(borderWidth/2, borderParam.front_c,1,1).moveTo(0, 0);	
graphics_back2.lineTo(objArr['text'].width+xOffset,0);	
graphics_back2.lineTo(objArr['text'].width+xOffset,borderParam.segments[2].y);	
graphics_back2.lineTo(0,borderParam.segments[2].y);	
graphics_back2.lineTo(0,0);		
	
/*-----------*/	

this._view.addChild(graphics_back);
this._view.addChild(graphics_back1);
this._view.addChild(graphics_back2);
this._view.addChild(objArr['text']);

this._view.x=setObj.x;
this._view.y=setObj.y; 

viewContainer.addChild(this._view);




objArr['text'].x=objArr['text'].width/2+xOffset/2;
objArr['text'].y=(borderParam.segments[2].y-2)/2;

 
this.Remove=function(){
  
 viewContainer.removeChild(this._view); 
};


 return this; 
  
}
function WinSpriteSymbol(jsonData,resName,cObj){


var self=this;
var newSprite;
this.animData=[];
this.setData=cObj;
this._view;


this.GetAnimData=function(){

return this.animData;
};

this.GetSetData=function(){

return this.setData;
};


for(var fName in animationsArr[resName]){

this.animData.push(PIXI.Texture.fromFrame(fName));

}



return this;


}





function WinSymbol(viewContainer,animData,sName,animPar){

this._view=new PIXI.Container();

var self=this;
var progAnimInter;
var progAnimData=new Object(null);
this.newSprite;
this.animName=sName;
this.StartAnim=function(aSet){




if(animPar.anim_mode=="prog"){

this.newSprite = new PIXI.extras.AnimatedSprite(animData);
this.newSprite0 = new PIXI.extras.AnimatedSprite(animData);
this.newSprite.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;
this.newSprite0.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;
this.newSprite.gotoAndStop(0);
this.newSprite0.gotoAndStop(1);
this.newSprite0.alpha=1;
self._view.addChild(this.newSprite);
self._view.addChild(this.newSprite0);
viewContainer.addChild(self._view);
self._view.x=aSet.x;
self._view.y=aSet.y;

progAnimData.glowTarget=false;

progAnimInter=setInterval(function(){

if(progAnimData.glowTarget){
self.newSprite0.alpha+=0.10;
}else{
self.newSprite0.alpha-=0.10;

}

if(self.newSprite0.alpha>1 || self.newSprite0.alpha<0){

progAnimData.glowTarget=!progAnimData.glowTarget;

}



},50);

}else{


this.newSprite = new PIXI.extras.AnimatedSprite(animData);

this.newSprite.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;

this.newSprite.gotoAndPlay(0);

self._view.addChild(this.newSprite);
viewContainer.addChild(self._view);
self._view.x=aSet.x;
self._view.y=aSet.y;

}


};

this.ShowAnimStart=function(){




if(animPar.anim_mode=="prog"){


this.newSprite.gotoAndStop(0);
this.newSprite0.gotoAndStop(1);
this.newSprite0.alpha=1;


progAnimData.glowTarget=false;

progAnimInter=setInterval(function(){

if(progAnimData.glowTarget){
self.newSprite0.alpha+=0.10;
}else{
self.newSprite0.alpha-=0.10;

}

if(self.newSprite0.alpha>1 || self.newSprite0.alpha<0){

progAnimData.glowTarget=!progAnimData.glowTarget;

}



},50);

}else{




this.newSprite.gotoAndPlay(0);


}


};

this.ShowAnim=function(aSet){




if(animPar.anim_mode=="prog"){

this.newSprite = new PIXI.extras.AnimatedSprite(animData);
this.newSprite0 = new PIXI.extras.AnimatedSprite(animData);
this.newSprite.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;
this.newSprite0.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;
this.newSprite.gotoAndStop(0);
this.newSprite0.gotoAndStop(1);
this.newSprite0.alpha=0;
self._view.addChild(this.newSprite);
self._view.addChild(this.newSprite0);
viewContainer.addChild(self._view);
self._view.x=aSet.x;
self._view.y=aSet.y;

progAnimData.glowTarget=false;



}else{


this.newSprite = new PIXI.extras.AnimatedSprite(animData);

this.newSprite.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;

this.newSprite.gotoAndStop(0);

self._view.addChild(this.newSprite);
viewContainer.addChild(self._view);
self._view.x=aSet.x;
self._view.y=aSet.y;

}


};

/*

	отключить анимацию, и убрать из отображения

	*/

this.StopAnim=function(){


this.newSprite.stop();
viewContainer.removeChild(self._view);


};


/*

	поднимаем символ наверх, что бы был поверх рамки линии, при отображении выигрышной линии

	*/

this.ResetAnim=function(){



viewContainer.removeChild(self._view);
viewContainer.addChild(self._view);


};

	return this;


}

function WinSymbol2(viewContainer,animData,sName,advAnim){

this._view=new PIXI.Container();	

var self=this;	

this.newSprite;	
	
	

	
	
this.StartAnimDelay=function(aSet,tFrames,sFrame,ic){


	
this.newSprite.animationSpeed=(animationsRate['lnWinSym_FS']/(CANVAS_FPS/100))/100;
	
this.newSprite.loop=false;	
this.newSprite.gotoAndPlay(tFrames);	
	

	
self._view.addChild(this.newSprite);
viewContainer.addChild(self._view);
self._view.x=aSet.x;	
self._view.y=aSet.y;	

self.newSprite.onFrameChange=function(){};	
	
this.newSprite.onComplete=function(ev){

 self.StopAnim(); 
  
if(ic>=15){
dispatchEvent(new Event("stopBonusSym"));	
}
	
};
	
	
	

	
	

	
};	
	

this.StartAnim=function(aSet,adv){





self.newSprite = new PIXI.extras.AnimatedSprite(animData);	

self.newSprite.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;
	
self.newSprite.gotoAndPlay(0);	
	
self._view.addChild(this.newSprite);
viewContainer.addChild(self._view);
self._view.x=aSet.x;	
self._view.y=aSet.y;	

self.newSprite.onFrameChange=function(ev){

if(ev>=adv[0][1]){
self.newSprite.gotoAndPlay(0);	
}
	
};
	
	
};
	
/*
	
	отключить анимацию, и убрать из отображения
	
	*/		
	
this.StopAnim=function(){
	
	
this.newSprite.stop();	
viewContainer.removeChild(self._view);

	
};	
	
	
/*
	
	поднимаем символ наверх, что бы был поверх рамки линии, при отображении выигрышной линии
	
	*/		
	
this.ResetAnim=function(){
	
	
	
viewContainer.removeChild(self._view);
viewContainer.addChild(self._view);
	
	
};	
	
	return this;
	
	
}


/////////////Lines class////////////////////

function GameLines(viewContainer,setObj){

/*

	класс отвечает за линии и анимацию выигрышей.

	*/


this._view=new PIXI.Container();

var currentWinLine=0;
var isMainShow=true;
var isMainScatters=true;
var self=this;

var timeoutShow;

var objArr=new Array();
var libArr=new Array();
var winArr=new Array();
var winArr2=new Array();
var winArrMask=new Array();
var borderArr=new Array();
var borderMiniArr=new Array();
var objectsSettings=new Array();
var winBackMask= new PIXI.Container();


winArr=new Array([],[],[],[],[],[]);

for(objId in setObj){

var cObj=setObj[objId];

objectsSettings[objId]=setObj[objId];

if(cObj.type=="bitmap"){

  

   
 
if(objId.split("Border")[1]!=undefined ){

var lnNum=parseInt(objId.split("Border")[1]);	

	

if(objId.split("BorderMin")[1]!=undefined){lnNum=parseInt(objId.split("BorderMin")[1]);}	
if(lnNum<=0){lnNum=1;}		
	
  for(var j=0; j<=19; j++){  
  
objArr[objId+"_"+j] = new PIXI.Container();
objArr[objId+"_front"] = new PIXI.Graphics();
objArr[objId+"_back"] = new PIXI.Graphics();


objArr[objId+"_"+j].addChild(objArr[objId+"_back"]);
objArr[objId+"_"+j].addChild(objArr[objId+"_front"]);


// Move it to the beginning of the line
 
var i=0;

objArr[objId+"_back"].lineStyle(5, setObj['lnLine'+lnNum].back,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y+0.2);
       
objArr[objId+"_front"].lineStyle(2.5, setObj['lnLine'+lnNum].front_c,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y);

	  
	 objectsSettings[objId].back =setObj['lnLine'+lnNum].back;
	 objectsSettings[objId].front_c =setObj['lnLine'+lnNum].front_c;

for(var i=1; i<cObj.segments.length;i++){

  
objArr[objId+"_back"].lineTo(cObj.segments[i].x,cObj.segments[i].y+0.2);
       
objArr[objId+"_front"].lineTo(cObj.segments[i].x,cObj.segments[i].y);

// Draw the line (endPoint should be relative to myGraph's position)

} 

}
 /*----------------*/ 
 
 }else if(objId.split("Line")[0]=="ln"){

 objArr[objId] = new PIXI.Graphics();
objArr[objId+"_back"] = new PIXI.Graphics();
this._view.addChild(objArr[objId+"_back"]);
this._view.addChild(objArr[objId]);

// Move it to the beginning of the line
 
var i=0;

objArr[objId+"_back"].lineStyle(5, cObj.back,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y+0.2);
       
objArr[objId].lineStyle(2.5, cObj.front_c,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y);


for(var i=1; i<cObj.segments.length;i++){
  

  
objArr[objId+"_back"].lineTo(cObj.segments[i].x,cObj.segments[i].y+0.2);
       
objArr[objId].lineTo(cObj.segments[i].x,cObj.segments[i].y);

// Draw the line (endPoint should be relative to myGraph's position)

} 
 /*----------------*/ 
  
/* objArr[objId+"_MASK"]= new PIXI.Graphics();
objArr[objId+"_MASK"].beginFill(0xFF700B, 1);
objArr[objId+"_MASK"].drawRect(396, 0, 1251, 1024);
objArr[objId].mask=objArr[objId+"_MASK"];

if(objArr[objId+"_back"]!=undefined){
 objArr[objId+"_MASK"]= new PIXI.Graphics();
objArr[objId+"_MASK"].beginFill(0xFF700B, 1);
objArr[objId+"_MASK"].drawRect(396, 0, 1251, 1024);
objArr[objId+"_back"].mask=objArr[objId+"_MASK"];  
}*/

}else{

  
 objArr[objId]=new PIXI.Sprite(PIXI.Texture.fromFrame(cObj.res[0]));

this._view.addChild(objArr[objId]);

objArr[objId].x=cObj.x-5;
objArr[objId].y=cObj.y;  
  
if(objId.split('lnBox')[1]!=undefined){
 
	
var tagTmp=objId.split('lnBox')[1].split('_');	

if(tagTmp[1]==0){
	objArr[objId].x=cObj.x-6;
	objArr[objId].y=setObj['lnLine'+tagTmp[0]].segments[0].y;	
   }else {
	objArr[objId].y=setObj['lnLine'+tagTmp[0]].segments[setObj['lnLine'+tagTmp[0]].segments.length-1].y;	
   }
	
	objArr[objId].anchor.set(0,0.5);
   
}
	
  
}


}else if(cObj.type=="symbol_sprite_lib"){



  
libArr[objId]=new WinSpriteSymbol(cObj.config,objId,cObj);


 


}else if(cObj.type=="bitmap_lib"){





libArr[objId]=PIXI.Texture.fromFrame(cObj.res[0]);



}else if(cObj.type=="text"){


var style = new PIXI.TextStyle({
    fontFamily: cObj.fontText.split("px")[1],
    fontSize: parseInt(cObj.fontText.split("px")[0]),
    fontWeight: 'bold',
    fill: [cObj.colorText], // gradient
    stroke: '#FFFFFF',
    strokeThickness: 0,
	align: cObj.alignText,
    dropShadow: false,
    dropShadowColor: '#000000',
    dropShadowBlur: 2,
    dropShadowAngle: 0,
    dropShadowDistance: 1,
    wordWrap: false,
    wordWrapWidth: 440
});



objArr[objId]=new PIXI.Text(cObj.defaultText, style);




objArr[objId].anchor.set(0.5, 0);





this._view.addChild(objArr[objId]);

objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;



}






}


viewContainer.addChild(this._view);


this.dbg2=function(){

return winArr;
};
this.dbg=function(){

return objArr;
};




/*--------------------------------*/

/*показать анимацию всех выигрышных символов*/

this.ShowAllWinSym=function(){

if(slotSettings.Jackpots['jackType']!=undefined && slotSettings.Jackpots['jackType']!='standartType'){	
gameLines.HideJackSym();
slotSettings.Jackpots['jackType']=undefined;
}



isMainScatters=true;
isMainShow=true;

dispatchEvent(new Event(SLOT_EVENT_SHOWWIN));

var rPos=gameReels.GetPositions();

winArr=new Array([],[],[],[],[],[]);
winArrMask=new Array([],[],[],[],[],[]);


currentWinLine=0;

for(var i=0; i<slotSpinResult.winLines.length;i++){

var wildCnt=0;
	var otherSymCnt=0;
	var cSym2="";

	var wildCnt=0;
	var otherSymCnt=0;


	for(var ii=1;ii<=5; ii++){

	if(slotSpinResult.winLines[i]['winReel'+ii][1]!='none'){

	if(slotSpinResult.winLines[i]['winReel'+ii][1]=="SCAT"){
	wildCnt++;
	}
	otherSymCnt++;

	if(slotSpinResult.winLines[i]['winReel'+ii][1]!="SCAT" && slotSpinResult.winLines[i]['winReel'+ii][1]!="SCAT_WILD"){
	cSym2=slotSpinResult.winLines[i]['winReel'+ii][1];
	}

	}


	}





for(var j=1;j<=5;j++){

var sCount=slotSpinResult.winLines[i].Count;

var cSym=slotSpinResult.winLines[i]['winReel'+j][1];
var cSym3=slotSpinResult.winLines[i]['winReel'+j][1];
var cPos=parseInt(slotSpinResult.winLines[i]['winReel'+j][0]);


	if(cSym=="none"){
	continue;
	}


	if(sCount<3){

	

	}

	if(winArr[j][cPos]==undefined ){

	for(var ij=0;ij<slotSettings.SymbolGame.length;ij++){

	if(sCount>4 && cSym2==slotSettings.SymbolGame[ij]  && cSym==slotSettings.SymbolGame[ij] && objectsSettings['lnWinSym_'+cSym+"_LONG"]){

	
	 cSym=slotSettings.SymbolGame[ij]+"_LONG";
	  


	break;
	}

	}

	

	var cprop=libArr['lnWinSym_'+cSym];

	winArr[j][cPos]=new WinSymbol(this._view,cprop.GetAnimData(),cSym,objectsSettings['lnWinSym_'+cSym]);

	winArr[j][cPos].StartAnim({x:rPos[j-1].x,y:rPos[j-1].y+(symHeight*cPos)});
	winArr[j][cPos].newSprite.name=j+"|"+cPos+"|"+cSym;
	/*--alpha mask--*/
	if(objectsSettings['lnWinSym_'+cSym+"_MASK"]!=undefined){
	  
	
	  
	
	  
	 winArr[j][cPos].newSprite.onFrameChange=function(ev){
	   var tmpSet=this.name.split("|");
	 var cprop2=libArr['lnWinSym_'+tmpSet[2]+"_MASK"].GetAnimData(); 
	self._view.removeChild(winArrMask[tmpSet[0]][tmpSet[1]]);
	winArr[tmpSet[0]][tmpSet[1]]._view.mask=null;

	delete winArrMask[tmpSet[0]][tmpSet[1]];
	winArrMask[tmpSet[0]][tmpSet[1]]=new PIXI.Sprite(PIXI.Texture.fromFrame(cprop2[ev].textureCacheIds[0]));
	//winArrMask[tmpSet[0]][tmpSet[1]]=new PIXI.Sprite(PIXI.Texture.fromFrame('P_2_LONG_MASK_Z_O'));
	
	
	self._view.addChild(winArrMask[tmpSet[0]][tmpSet[1]]);
	
	winArrMask[tmpSet[0]][tmpSet[1]].x=winArr[tmpSet[0]][tmpSet[1]]._view.x;
	winArrMask[tmpSet[0]][tmpSet[1]].y=winArr[tmpSet[0]][tmpSet[1]]._view.y;
	
	
	
	
	 winArr[tmpSet[0]][tmpSet[1]]._view.mask=winArrMask[tmpSet[0]][tmpSet[1]]; 
	  
	
	
	 }
	 
	 


	
       
	
	
	}
	
	/*--alpha mask--*/


	

	gameReels.HideSymbol(j,cPos);
	/*long loop*/

	for(var ij=0;ij<slotSettings.SymbolGame.length;ij++){

	if(sCount>3 && cSym2==slotSettings.SymbolGame[ij] && cSym3==slotSettings.SymbolGame[ij]  && libArr[cSym2+'_LONG_LOOP']!=undefined){


   winArr[j][cPos].newSprite.loop=false;

   winArr[j][cPos].newSprite.onComplete=function(ev){


	var cprop2=libArr['lnWinSym_'+slotSettings.SymbolGame[ij]+'_LONG_LOOP'];
	self.SeqWinSym(self._view,cprop2.GetAnimData(),'lnWinSym_'+slotSettings.SymbolGame[ij]+'_LONG_LOOP',parseInt(this.name.split("|")[0]),parseInt(this.name.split("|")[1]),this.parent);

   }


	}


	}

	/*long loop*/


	}


}

}

clearTimeout(timeoutShow);

if(slotSpinResult.bonusInfo.scattersType=="bonus" || slotSpinResult.bonusInfo.scattersType=="win"){

	self.ShowScattersAnim();

}else{

timeoutShow=setTimeout(self.ShowCurrentWinLine,200);

}



};

/*показать анимацию всех выигрышных символов*/
this.SeqWinSym=function(p1,p2,p3,jj,jcPos,st){

var jrPos=gameReels.GetPositions();

winArr[jj][jcPos].StopAnim();
winArr[jj][jcPos]=new WinSymbol(p1,p2,p3,objectsSettings['lnWinSym_'+p3]);
winArr[jj][jcPos].StartAnim({x:jrPos[jj-1].x,y:jrPos[jj-1].y+(symHeight*jcPos)});

};
/*-----------------------------------*/



	
this.ShowAdvancedRoll=function(){
winArr2=new Array([],[],[],[],[],[]);
	
var rCount=0;	
var rPos=gameReels.GetPositions();	
	

	
for(var i=0; i<3;i++){

for(var j=1;j<=5;j++){

var cSym="FS";	
var cPos=i;	

	
	
	
	
		
	var cprop=libArr['lnWinSym_'+cSym];	
	
	winArr2[j][cPos]=new WinSymbol2(this._view,cprop.GetAnimData(),cSym);
	
	winArr2[j][cPos].StartAnim({x:rPos[j-1].x,y:rPos[j-1].y+(symHeight*cPos)},cprop.GetSetData().advanced_set);	

	
		
	
}
	
}


	
};
	
this.ShowAdvancedRollOpen=function(){

var rollIntr;	
	
var jc=1;
var ic=-1;	
	

var totalSym=0;	
var rCount=0;	
var rPos=gameReels.GetPositions();		
	
rollIntr=setInterval(function(){	


	
ic++;

var cSym="FS";	
var cPos=ic;		
var cprop=libArr['lnWinSym_'+cSym];		
	
	

	
var sFrame=cprop.GetSetData().advanced_set[1][0];	
var tFrame=cprop.GetSetData().advanced_set[1][1];	
totalSym++;	
winArr2[jc][ic].StartAnimDelay({x:rPos[jc-1].x,y:rPos[jc-1].y+(symHeight*cPos)},tFrame,sFrame,totalSym);		
	
if(ic>=2){
		
	
ic=-1;
jc++;	
	

	
}
	
if(jc>=6){
clearInterval(rollIntr);	
	
}
	
},200);		
	
};
	
this.StopBonusSymAnim=function(){
	
self.StopWinLine();	
dispatchEvent(new Event(SLOT_EVENT_AFTERSPIN));		
	
};

/*----------отображение бонусных символов-------------*/
	
this.ShowScattersAnim=function(){

var rPos=gameReels.GetPositions();		
	
for(var j=1;j<=5;j++){

if(slotSpinResult.bonusInfo['winReel'+j]==undefined){
continue;	
}
	
var cSym=slotSpinResult.bonusInfo['winReel'+j][1];
var cPos=parseInt(slotSpinResult.bonusInfo['winReel'+j][0]);	

var cprop=libArr['lnWinSym_'+cSym];	
	
	
	winArr[j][cPos]=new WinSymbol(this._view,cprop.GetAnimData(),cSym,objectsSettings['lnWinSym_'+cSym]);
		
	winArr[j][cPos].StartAnim({x:rPos[j-1].x,y:rPos[j-1].y+(symHeight*cPos)});		
	winArr[j][cPos]._view.y-=96;
	winArr[j][cPos]._view.x-=9;
}
	
if(slotSpinResult.winLines.length<=0){

isMainShow=false;
this.ShowScattersWin();	


	
}else{
	
	
timeoutShow=setTimeout(self.ShowCurrentWinLine,200);	

}

}
/*----------отображение выигрыша по бонусным символам-------------*/


/*----------отображение выигрыша по бонусным символам-------------*/

this.ShowScattersWin=function(){



var rPos=gameReels.GetPositions();

if(slotSpinResult.bonusInfo.scattersType=="bonus" ){
slotStateData.scatShow=true;

}
var firstBorder=true;
self.HideLines();

for(var i=0;i<=5;i++){

if(borderArr[i]!=undefined){
self._view.removeChild(borderArr[i]);

}
if(borderMiniArr[i]!=undefined){
borderMiniArr[i].Remove();

}

}

borderArr=new Array();

borderMiniArr=new Array();

var scCount=0;


for(var j=1;j<=5;j++){

if(slotSpinResult.bonusInfo['winReel'+j]==undefined){
continue;
}

scCount++;

}

for(var j=1;j<=5;j++){



if(slotSpinResult.bonusInfo['winReel'+j]==undefined){
continue;
}


var cSym=slotSpinResult.bonusInfo['winReel'+j][1];
var cPos=parseInt(slotSpinResult.bonusInfo['winReel'+j][0]);



borderArr[j]=new PIXI.Container();
	borderArr[j].addChild(objArr['lnBorder'+0+'_'+j]);
	


	var cSym="SCAT";


var cprop=libArr['lnWinSym_'+cSym];

	if(winArr[j]!=undefined){

			if(winArr[j][cPos]!=undefined){
	winArr[j][cPos].StopAnim();
			}



    }

		winArr[j][cPos]=new WinSymbol(this._view,cprop.GetAnimData(),cSym,objectsSettings['lnWinSym_'+cSym]);

	winArr[j][cPos].StartAnim({x:rPos[j-1].x,y:rPos[j-1].y+(symHeight*cPos)});

	self._view.addChild(borderArr[j]);

	borderArr[j].x=winArr[j][cPos]._view.x+objectsSettings['lnBorder'+0].offset;
	borderArr[j].y=winArr[j][cPos]._view.y+objectsSettings['lnBorder'+0].offset;
	
	if(firstBorder){
	firstBorder=false; 
        borderMiniArr[j]=new MiniBorder(self._view,[objArr['lnBorderMin0_0'],objArr['lnBorderMin0_1'],objArr['lnBorderMin0_2']],slotSpinResult.bonusInfo.scattersWin,0,{x:winArr[j][cPos]._view.x+objectsSettings['lnBorderMin'+0].offsetX,y:winArr[j][cPos]._view.y+objectsSettings['lnBorderMin'+0].offsetY},objectsSettings['lnBorderMin'+0]);
	}
	

	winArr[j][cPos]._view.y-=96;
	winArr[j][cPos]._view.x-=9;
	
}

if(currentSound['FS']!=undefined && bonusMode){
currentSound['FS'].volume=0;	
	}

currentSound['SCAT']=PlaySound("SCAT");
var delay=currentSound['SCAT'].duration;


if(isMainScatters){



var winEvent=new CustomEvent(SLOT_EVENT_WINSCATTERS,{detail:{cnt:scCount}});
dispatchEvent(winEvent);

}


isMainScatters=false;

clearTimeout(timeoutShow);

timeoutShow=setTimeout(function(){

if(slotSpinResult.bonusInfo.scattersType=="bonus" ){



self.StopWinLine();

dispatchEvent(new Event(SLOT_EVENT_STARTBONUS));

return;

}else{

if(slotSpinResult.winLines.length>0){
slotState=SLOT_STATE_AFTERWIN;
dispatchEvent(new Event(SLOT_EVENT_ENDWINLINE));
timeoutShow=setTimeout(self.ShowCurrentWinLine,1000);
}else{

slotState=SLOT_STATE_AFTERWIN;
dispatchEvent(new Event(SLOT_EVENT_ENDWINLINE));

}


}
slotStateData.scatShow=false;
},delay);

};

/*win back mask*/
this.ShowWinMask=function(){

 
objArr['lnWinBack'].mask=winBackMask;
objArr['lnWinBack'].visible=true; 
};

/*----------отображение выигрышных линий-------------*/
this.ShowCurrentWinLine=function(){

self.HideLines();

if(currentWinLine>slotSpinResult.winLines.length-1){

if(isMainShow){
isMainShow=false;

if(slotSpinResult.bonusInfo.scattersType!="bonus" || slotSpinResult.bonusInfo.scattersType!="win"){

if(slotSpinResult.bonusInfo.scattersType=="bonus"){
autoMode=false;

gameUI.GetObject()['uiButtonAuto'].ChangeLabel('uiButtonAuto');
}else{

if(slotSpinResult.expPay>0){
	dispatchEvent(new Event(SLOT_EVENT_EXPREELS));
	return;
}else if(slotSpinResult.bonusInfo.scattersType!="bonus" && slotSpinResult.bonusInfo.scattersType!="win"){

slotState=SLOT_STATE_AFTERWIN;
dispatchEvent(new Event(SLOT_EVENT_ENDWINLINE));

}

}


}



}
currentWinLine=0;

}

var cLine=parseInt(slotSpinResult.winLines[currentWinLine].Line)+1;






self._view.removeChild(objArr['lnBox'+cLine+'_0']);
self._view.removeChild(objArr['lnBox'+cLine+'_1']);

self._view.addChild(objArr['lnBox'+cLine+'_0']);
self._view.addChild(objArr['lnBox'+cLine+'_1']);
self._view.addChild(objArr['lnLine'+cLine+"_back"]);
self._view.addChild(objArr['lnLine'+cLine]);

self._view.removeChild(objArr['lnWinBack']);  
self._view.addChild(objArr['lnWinBack']);   

for(var i=0;i<=5;i++){

if(borderArr[i]!=undefined){
self._view.removeChild(borderArr[i]);

}


if(borderMiniArr[i]!=undefined){
borderMiniArr[i].Remove();

}






}
borderArr=new Array();

borderMiniArr=new Array();

var firstBorder=true;
winBackMask = new PIXI.Graphics();
for(var j=1;j<=5;j++){




	var cPos=slotSpinResult.winLines[currentWinLine]['winReel'+j][0];

	if(cPos!="none"){



winBackMask.beginFill(0xFF700B, 1);
winBackMask.drawRect(winArr[j][cPos]._view.x, winArr[j][cPos]._view.y, symWidth, symHeight);


self.ShowWinMask();

	borderArr[j]=new PIXI.Container();
	borderArr[j].addChild(objArr['lnBorder'+cLine+'_'+j]);
	
	winArr[j][cPos].ResetAnim();
	self._view.addChild(borderArr[j]);

	borderArr[j].x=winArr[j][cPos]._view.x+objectsSettings['lnBorder'+cLine].offset;
	borderArr[j].y=winArr[j][cPos]._view.y+objectsSettings['lnBorder'+cLine].offset;

	
	

	if(firstBorder){
	firstBorder=false; 
        borderMiniArr[j]=new MiniBorder(self._view,[objArr['lnBorderMin'+cLine+'_0'],objArr['lnBorderMin'+cLine+'_1'],objArr['lnBorderMin'+cLine+'_2']],slotSpinResult.winLines[currentWinLine].Win,cLine,{x:winArr[j][cPos]._view.x+objectsSettings['lnBorderMin'+cLine].offsetX,y:winArr[j][cPos]._view.y+objectsSettings['lnBorderMin'+cLine].offsetY},objectsSettings['lnBorderMin'+cLine]);
	}
	

	}


}


if(isMainShow){

var winEvent=new CustomEvent(SLOT_EVENT_WINLINE,{detail:{winSym:slotSpinResult.winLines[currentWinLine],stepwin:slotSpinResult.winLines[currentWinLine].stepWin,win:slotSpinResult.winLines[currentWinLine].Win,line:slotSpinResult.winLines[currentWinLine].Line,count:slotSpinResult.winLines[currentWinLine].Count}});
dispatchEvent(winEvent);


}else{

var winEvent=new CustomEvent(SLOT_EVENT_WINLINE_WAIT,{detail:{stepwin:slotSpinResult.winLines[currentWinLine].stepWin,win:slotSpinResult.winLines[currentWinLine].Win,line:slotSpinResult.winLines[currentWinLine].Line}});
dispatchEvent(winEvent);

}

currentWinLine++;






clearTimeout(timeoutShow);

if(isMainShow){




}else{

/////////

if(slotSpinResult.expPay>0){
	dispatchEvent(new Event(SLOT_EVENT_EXPREELS));
	return;
}else if((slotSpinResult.bonusInfo.scattersType=="bonus" || slotSpinResult.bonusInfo.scattersType=="win") && isMainScatters){

self.ShowScattersWin();

}else{

	timeoutShow=setTimeout(self.ShowCurrentWinLine,1000);
}




}




};


/*

убираем выигрышную анимация и линии

*/
var borderArr2;

this.ShowJackSym=function(){


	
var jType=slotSettings.Jackpots['jackType'];	
var jSym='SCAT';	
	
if(jType=='slotType1'){
 
jSym='P_1';	
   
 }
	
	
if(jType=='slotType1'){
   
   
var rPos=gameReels.GetPositions();

borderArr2=new Array([],[],[],[],[],[]);
winArr=new Array([],[],[],[],[],[]);
winArrMask=new Array([],[],[],[],[],[]);

var firstBorder	=true;
var bCnt=0;
	
for(var i=0; i<4;i++){




for(var j=1;j<=5;j++){


var cSym=jSym;

var cPos=i;

	if(slotSpinResult.reelsSymbols['reel'+j][i]==jSym){
	
	var cprop=libArr['lnWinSym_'+cSym];

	winArr[j][cPos]=new WinSymbol(this._view,cprop.GetAnimData(),cSym,objectsSettings['lnWinSym_'+cSym]);

	winArr[j][cPos].StartAnim({x:rPos[j-1].x,y:rPos[j-1].y+(symHeight*cPos)});
	 
	var cLine=1;	
		
	borderArr2[i][j]=new PIXI.Container();
	borderArr2[i][j].addChild(objArr['lnBorder'+cLine+'_'+bCnt]);
	bCnt++;
	
	self._view.addChild(borderArr2[i][j]);

	borderArr2[i][j].x=winArr[j][cPos]._view.x+objectsSettings['lnBorder'+cLine].offset;
	borderArr2[i][j].y=winArr[j][cPos]._view.y+objectsSettings['lnBorder'+cLine].offset;

	
	

	if(firstBorder){
	firstBorder=false; 
        borderMiniArr[j]=new MiniBorder(self._view,[objArr['lnBorderMin'+cLine+'_0'],objArr['lnBorderMin'+cLine+'_1'],objArr['lnBorderMin'+cLine+'_2']],slotSettings.Jackpots['jackPay'],cLine,{x:winArr[j][cPos]._view.x+objectsSettings['lnBorderMin'+cLine].offsetX,y:winArr[j][cPos]._view.y+objectsSettings['lnBorderMin'+cLine].offsetY},objectsSettings['lnBorderMin'+cLine]);
	}	
		
   
}
   
   }
	
}
	
}
	
	
};
	
this.HideJackSym=function(){


   
var rPos=gameReels.GetPositions();



var firstBorder	=true;
var bCnt=0;
	
for(var i=0; i<4;i++){




for(var j=1;j<=5;j++){






	
	


	
if(winArr[j][i]!=undefined){
	winArr[j][i].StopAnim();
	
	
	self._view.removeChild(borderArr2[i][j]);


}	
	

	if(firstBorder){
	firstBorder=false; 
        
		borderMiniArr[j].Remove();
	}	
		
   

   
   
	
}
	
}
	
	
};	
this.StopWinLine=function(){
	
if(slotSettings.Jackpots['jackType']!=undefined && slotSettings.Jackpots['jackType']!='standartType'){	
gameLines.HideJackSym();
	slotSettings.Jackpots['jackType']=undefined;
}			
	
objArr['lnWinBack'].visible=false; 
dispatchEvent(new Event(SLOT_EVENT_HIDEWIN));
if(currentSound['FS']!=undefined && bonusMode && soundMode){
currentSound['FS'].volume=1;
	}

self.HideLines();
clearTimeout(timeoutShow);

for(var i=0;i<=5;i++){

if(borderArr[i]!=undefined){
self._view.removeChild(borderArr[i]);

}

if(borderMiniArr[i]!=undefined){
borderMiniArr[i].Remove();

}

}
borderArr=new Array();
borderMiniArr=new Array();

for(var j=1;j<=5;j++){


for(var i=0;i<=3;i++){

	var cPos=i;

	if(winArr[j]!=undefined){

	if(winArr[j][i]!=undefined){


	winArr[j][i].StopAnim();


	}

	}
}

}


winArr=new Array();

clearTimeout(timeoutShow);


};

/*убрать все линии*/


this.HideLines=function(){
clearTimeout(timeoutShow);
for(var i=1; i<=50; i++){

self._view.removeChild(objArr['lnLine'+i]);
if(objArr['lnLine'+i+"_back"]!=undefined){
self._view.removeChild(objArr['lnLine'+i+"_back"]);
}


}

};


/*установка линий*/

this.SetLines=function(){

for(var i=1; i<=50; i++){
self._view.removeChild(objArr['lnLine'+i]);
if(objArr['lnLine'+i+"_back"]!=undefined){
self._view.removeChild(objArr['lnLine'+i+"_back"]);
}

this._view.removeChild(objArr['lnBox'+i+'_0']);
this._view.removeChild(objArr['lnBox'+i+'_1']);



}

for(var i=1; i<=slotStateData.lines; i++){








this._view.addChild(objArr['lnBox'+i+'_0']);
this._view.addChild(objArr['lnBox'+i+'_1']);




if(objArr['lnLine'+i+"_back"]!=undefined){
self._view.addChild(objArr['lnLine'+i+"_back"]);
}
self._view.addChild(objArr['lnLine'+i]);
}
clearTimeout(timeoutShow);
//timeoutShow=setTimeout(this.HideLines,1000);
};

this.HideLines();


/*подписываемся на события*/

addEventListener("stopBonusSym",function(){self.StopBonusSymAnim();});

addEventListener(SLOT_EVENT_START,function(){

objArr['lnWinBack'].visible=false; 

for(var i=1; i<=50; i++){


self._view.removeChild(objArr['lnBox'+i+'_0']);
self._view.removeChild(objArr['lnBox'+i+'_1']);



}

for(var i=1; i<=slotStateData.lines; i++){




self._view.addChild(objArr['lnBox'+i+'_0']);
self._view.addChild(objArr['lnBox'+i+'_1']);

}




});
addEventListener(SLOT_EVENT_BET,function(){self.StopWinLine();self.SetLines();});

addEventListener('RESTORE_WIN',function(){

createjs.Sound.stop();
isMainShow=false;
isMainScatters=false;

if(slotSpinResult.bonusInfo.scattersType=="bonus"){

clearTimeout(timeoutShow);
clearInterval(slotStateData.winlineInter);
self.StopWinLine();
dispatchEvent(new Event(SLOT_EVENT_STARTBONUS));
}else{
clearTimeout(timeoutShow);
clearInterval(slotStateData.winlineInter);
slotState=SLOT_STATE_IDLE;

currentWinLine=slotSpinResult.winLines.length+1;
if(slotSpinResult.winLines.length>0){
self.ShowCurrentWinLine();
}

}

});


addEventListener(SLOT_EVENT_SKIPWIN,function(){

createjs.Sound.stop();
isMainShow=false;
isMainScatters=false;


if(slotSpinResult.bonusInfo.scattersType=="bonus"){
  
clearTimeout(timeoutShow);
clearInterval(slotStateData.winlineInter);
self.StopWinLine();
dispatchEvent(new Event(SLOT_EVENT_STARTBONUS));
}else{
clearTimeout(timeoutShow);
clearInterval(slotStateData.winlineInter);
slotState=SLOT_STATE_AFTERWIN;
dispatchEvent(new Event(SLOT_EVENT_ENDWINLINE));
currentWinLine=slotSpinResult.winLines.length+1;
if(slotSpinResult.winLines.length>0){
self.ShowCurrentWinLine();
}




}




});
	
addEventListener(SLOT_EVENT_JACKPOTSHOW,function(){self.ShowJackSym();});	
addEventListener(SLOT_EVENT_LINES,function(){self.StopWinLine();self.SetLines();});
addEventListener(SLOT_EVENT_STARTSPIN,function(){self.StopWinLine();self.HideLines();});
addEventListener(SLOT_EVENT_RESULTSPIN,function(){

	if(slotSettings.slotBonusType==1 && bonusMode){

	self.ShowAdvancedRollOpen();
	}

});

addEventListener(SLOT_EVENT_WINLINENEXT,function(ev){timeoutShow=setTimeout(self.ShowCurrentWinLine,ev.detail.delay);});
addEventListener(SLOT_EVENT_GAMBLESTART,function(){});
addEventListener(SLOT_EVENT_SPINBONUS,function(){self.StopWinLine();self.HideLines();});
addEventListener(SLOT_EVENT_ADVANCEDSPINBONUS,function(){



	self.ShowAdvancedRoll();});
addEventListener(SLOT_EVENT_ENDBONUS,function(){self.HideLines();});



return this;

}
