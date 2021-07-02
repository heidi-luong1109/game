

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
var borderWidth=8;

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







this.aMask= new PIXI.Graphics();
this.aMask.beginFill(0xFF700B, 1);
this.aMask.drawRect(0, 0, symWidth, symHeight);
this._view.addChild(this.aMask);
this._view.mask=this.aMask;



this.StartAnim=function(aSet){




if(animPar.anim_mode=="prog"){

this.newSprite = new PIXI.extras.AnimatedSprite(animData);

this.newSprite0 = new PIXI.extras.AnimatedSprite(animData);

this.newSprite.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;
this.newSprite0.animationSpeed=(animationsRate['lnWinSym_'+sName]/(CANVAS_FPS/100))/100;

this.newSprite.gotoAndStop(0);
this.newSprite0.gotoAndStop(1);
this.newSprite0.alpha=1;

this.rtSym=0.0;
this.rtSymCnt=0.0075;


this.newSprite0.anchor.set(0.5,0.5);
this.newSprite.anchor.set(0.5,0.5);

this.newSprite0.x=symHeight/2;
this.newSprite0.y=symHeight/2;



this.newSprite.x=symHeight/2;
this.newSprite.y=symHeight/2;


self.aBack= new PIXI.Graphics();
self.aBack.beginFill(0xE60002, 1);
self.aBack.drawRect(0, 0, symWidth, symHeight);


self.aBack.alpha=1;

self._view.addChild(this.newSprite);
self._view.addChild(this.aBack);
self._view.addChild(this.newSprite0);
viewContainer.addChild(self._view);
self._view.x=aSet.x;
self._view.y=aSet.y;

progAnimData.glowTarget=false;

progAnimInter=setInterval(function(){

if(progAnimData.glowTarget){

self.newSprite0.alpha+=0.08;
self.aBack.alpha+=0.08;

}else{


self.aBack.alpha-=0.08;
self.newSprite0.alpha-=0.08;

}

self.newSprite0.rotation+=Math.sin(self.rtSym*1);
self.newSprite.rotation+=Math.sin(self.rtSym*1);

self.rtSym-=self.rtSymCnt;

if(self.rtSym>0.045 || self.rtSym<-0.045){

self.rtSymCnt=-self.rtSymCnt;

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

  

   
 
if(objId=="lnBorderMin20" || objId=="lnBorderMin19" || objId=="lnBorderMin18" || objId=="lnBorderMin17" || objId=="lnBorderMin16" || objId=="lnBorderMin15" || objId=="lnBorderMin14" || objId=="lnBorderMin13" || objId=="lnBorderMin12" || objId=="lnBorderMin11" || objId=="lnBorderMin10" || objId=="lnBorderMin0" || objId=="lnBorderMin1" || objId=="lnBorderMin2" || objId=="lnBorderMin3" || objId=="lnBorderMin4" || objId=="lnBorderMin5" || objId=="lnBorderMin6" || objId=="lnBorderMin7" || objId=="lnBorderMin8" || objId=="lnBorderMin9"){

  for(var j=0; j<=5; j++){  
  
objArr[objId+"_"+j] = new PIXI.Container();
objArr[objId+"_front"] = new PIXI.Graphics();
objArr[objId+"_back"] = new PIXI.Graphics();


objArr[objId+"_"+j].addChild(objArr[objId+"_back"]);
objArr[objId+"_"+j].addChild(objArr[objId+"_front"]);


// Move it to the beginning of the line
 
var i=0;



objArr[objId+"_back"].lineStyle(8, cObj.back,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y);
       
objArr[objId+"_front"].lineStyle(4, cObj.front_c,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y);


for(var i=1; i<cObj.segments.length;i++){

  
objArr[objId+"_back"].lineTo(cObj.segments[i].x,cObj.segments[i].y);
       
objArr[objId+"_front"].lineTo(cObj.segments[i].x,cObj.segments[i].y);

// Draw the line (endPoint should be relative to myGraph's position)

} 

}
 /*----------------*/ 
 
 }else if(objId=="lnBorder20" || objId=="lnBorder19" || objId=="lnBorder18" || objId=="lnBorder17" || objId=="lnBorder16" || objId=="lnBorder15" || objId=="lnBorder14" || objId=="lnBorder13" || objId=="lnBorder12" || objId=="lnBorder11" || objId=="lnBorder10" || objId=="lnBorder0" || objId=="lnBorder1" || objId=="lnBorder2" || objId=="lnBorder3" || objId=="lnBorder4" || objId=="lnBorder5" || objId=="lnBorder6" || objId=="lnBorder7" || objId=="lnBorder8" || objId=="lnBorder9"){

 
   
 for(var j=0; j<=15; j++){  
   
objArr[objId+"_"+j] = new PIXI.Container();
objArr[objId+"_front"] = new PIXI.Graphics();
objArr[objId+"_back"] = new PIXI.Graphics();



objArr[objId+"_"+j].addChild(objArr[objId+"_back"]);
objArr[objId+"_"+j].addChild(objArr[objId+"_front"]);


// Move it to the beginning of the line
 


objArr[objId+"_back"].lineStyle(8, cObj.back,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y);
       
objArr[objId+"_front"].lineStyle(4, cObj.front_c,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y);


for(var i=1; i<cObj.segments.length;i++){
  

  
objArr[objId+"_back"].lineTo(cObj.segments[i].x,cObj.segments[i].y);
       
objArr[objId+"_front"].lineTo(cObj.segments[i].x,cObj.segments[i].y);

// Draw the line (endPoint should be relative to myGraph's position)

} 
 /*----------------*/ 
 
 }
 
 }else if(objId.split("Line")[0]=="ln"){

 objArr[objId] = new PIXI.Graphics();
objArr[objId+"_back"] = new PIXI.Graphics();
this._view.addChild(objArr[objId+"_back"]);
this._view.addChild(objArr[objId]);

// Move it to the beginning of the line
 
var i=0;

objArr[objId+"_back"].lineStyle(8, cObj.back,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y);
       
objArr[objId].lineStyle(4, cObj.front_c,1,1)
       .moveTo(cObj.segments[0].x, cObj.segments[0].y);


for(var i=1; i<cObj.segments.length;i++){
  

  
objArr[objId+"_back"].lineTo(cObj.segments[i].x,cObj.segments[i].y);
       
objArr[objId].lineTo(cObj.segments[i].x,cObj.segments[i].y);

// Draw the line (endPoint should be relative to myGraph's position)

} 
 /*----------------*/ 
  
 objArr[objId+"_MASK"]= new PIXI.Graphics();
objArr[objId+"_MASK"].beginFill(0xFF700B, 1);
objArr[objId+"_MASK"].drawRect(396, 0, 1256, 1024);
objArr[objId].mask=objArr[objId+"_MASK"];

if(objArr[objId+"_back"]!=undefined){
 objArr[objId+"_MASK"]= new PIXI.Graphics();
objArr[objId+"_MASK"].beginFill(0xFF700B, 1);
objArr[objId+"_MASK"].drawRect(396, 0, 1256, 1024);
objArr[objId+"_back"].mask=objArr[objId+"_MASK"];  
}

}else{

  
 objArr[objId]=new PIXI.Sprite(PIXI.Texture.fromFrame(cObj.res[0]));

this._view.addChild(objArr[objId]);

objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;  
  
  
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



this.ShowJack=function(){
 
  
 objArr['lnWndJack0'].visible=true; 
 objArr['lnWndJack1'].visible=true;
 objArr['lnWndJack1'].alpha=0;
 
 slotStateData.glowTarget=0.1;
 slotStateData.jackInter=setInterval(function(){
   
   
  objArr['lnWndJack1'].alpha+=slotStateData.glowTarget;
  
  if(objArr['lnWndJack1'].alpha<=0 || objArr['lnWndJack1'].alpha>=1){
   slotStateData.glowTarget=-slotStateData.glowTarget; 
  }
   
   
},30);
  
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

	if(sCount>3 && cSym2==slotSettings.SymbolGame[ij]  && cSym==slotSettings.SymbolGame[ij] && objectsSettings['lnWinSym_'+cSym+"_LONG"]){

	
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

isMainShow=true;  
  
var rPos=gameReels.GetPositions();		
	
for(var j=1;j<=5;j++){

for(var i=0;i<=3;i++){  
  
if(slotSpinResult.bonusInfo['winReel'+j+'_'+i]==undefined){
continue;	
}
	
var cSym=slotSpinResult.bonusInfo['winReel'+j+'_'+i][1];
var cPos=parseInt(slotSpinResult.bonusInfo['winReel'+j+'_'+i][0]);	

var cprop=libArr['lnWinSym_'+cSym];	
	
	
	winArr[j][cPos]=new WinSymbol(this._view,cprop.GetAnimData(),cSym,objectsSettings['lnWinSym_'+cSym]);
		
	winArr[j][cPos].StartAnim({x:rPos[j-1].x,y:rPos[j-1].y+(symHeight*cPos)});	
        winArr[j][cPos]._view.name='SCAT';	
}

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

console.log('ShowScattersWin');

var rPos=gameReels.GetPositions();

if(slotSpinResult.bonusInfo.scattersType=="bonus" ){
slotStateData.scatShow=true;

}
var firstBorder=true;
self.HideLines();

for(var i=0;i<=15;i++){

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


for(var j=1;j<=15;j++){

if(slotSpinResult.bonusInfo['winReel'+j]==undefined){
continue;
}

scCount++;

}


var borderCnt=0;

for(var j=1;j<=5;j++){










	


	var cSym="SCAT";


var cprop=libArr['lnWinSym_'+cSym];

for(var cPos=0;cPos<=3;cPos++){

  console.log(winArr[j]);

	if(winArr[j]!=undefined){

	if(winArr[j][cPos]!=undefined && winArr[j][cPos]._view.name=='SCAT'){

	winArr[j][cPos].ResetAnim();

	
	borderArr[borderCnt]=new PIXI.Container();
	borderArr[borderCnt].addChild(objArr['lnBorder0_'+borderCnt]);
	
	self._view.addChild(borderArr[borderCnt]);

	borderArr[borderCnt].x=winArr[j][cPos]._view.x+objectsSettings['lnBorder'+0].offset;
	borderArr[borderCnt].y=winArr[j][cPos]._view.y+objectsSettings['lnBorder'+0].offset;
	
	borderCnt++;
	
	if(firstBorder && slotSpinResult.bonusInfo.scattersWin>0){
	firstBorder=false; 
        borderMiniArr[j]=new MiniBorder(self._view,[objArr['lnBorderMin0_0'],objArr['lnBorderMin0_1'],objArr['lnBorderMin0_2']],slotSpinResult.bonusInfo.scattersWin,0,{x:winArr[j][cPos]._view.x+objectsSettings['lnBorderMin'+0].offsetX,y:winArr[j][cPos]._view.y+objectsSettings['lnBorderMin'+0].offsetY},objectsSettings['lnBorderMin'+0]);
	}
	
	}
	
	}
	
}

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

this.StopWinLine=function(){
objArr['lnWinBack'].visible=false; 
dispatchEvent(new Event(SLOT_EVENT_HIDEWIN));
if(currentSound['FS']!=undefined && bonusMode && soundMode){
currentSound['FS'].volume=1;
	}

self.HideLines();
clearTimeout(timeoutShow);

for(var i=0;i<=15;i++){

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


for(var i=0;i<=2;i++){

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
for(var i=1; i<=20; i++){

self._view.removeChild(objArr['lnLine'+i]);
if(objArr['lnLine'+i+"_back"]!=undefined){
self._view.removeChild(objArr['lnLine'+i+"_back"]);
}


}

};


/*установка линий*/

this.SetLines=function(){

for(var i=1; i<=20; i++){
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

for(var i=1; i<=20; i++){


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
