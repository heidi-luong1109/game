
//Reel class

function GameReel(viewContainer,setObj,reelId,symCnt){

/*класс барабана*/

this._view=new PIXI.Container();
var reelEvent=new CustomEvent("reelStop",{detail:{reel:reelId}});
var reelTeaser=false;
var rollCount=0;
var rollStepCount=0;
var self=this;
var servSymbols=new Array();
var reelStrip=slotSettings['reelStrip'+reelId];
var curPosition=5;

var chSymbols = new Array();


var objArr=new Array();
var txArr=new Array();
var sArr=new Array();

var stackedWilds=new Array();

stackedWilds=[];
for(var objId in setObj){

if(objId=="spriteSheet"){continue;}

txArr[setObj[objId].res[0]]=PIXI.Texture.fromFrame(setObj[objId].res[0]);





symHeight=166;
symWidth=222;

}



var symOffset=symHeight/222;

var rX;
var rY;

var rollSpeed=(symHeight/1.2);








this.SetPosition=function(sObj){


this._view.x=sObj.x;
this._view.y=sObj.y;

rX=sObj.x;
rY=sObj.y;
};


this.ChangeReelCount=function(sObj){



if(rollCount>5){
rollCount=5;
}



};

this.LongRoll=function(ic){


if(slotSettings.slotScatterType==1 ){



rollCount=ic*16;


}

};

viewContainer.addChild(this._view);


this.CheckScatters=function(){

	var rtn=0;

if(servSymbols[0]=="SCAT"){
rtn=1;
}
if(servSymbols[1]=="SCAT"){
rtn=1;
}
if(servSymbols[2]=="SCAT"){
rtn=1;
}
if(servSymbols[3]=="SCAT"){
rtn=1;
}

	return rtn;
};

/*остановка вращений*/



this.StopReel=function(rs,sym){

rollCount=rs;
servSymbols=sym;

if(servSymbols[0]=="SCAT" || servSymbols[0]=="SCAT_FS"){
reelTeaser=true;
}
if(servSymbols[1]=="SCAT" || servSymbols[1]=="SCAT_FS"){
reelTeaser=true;
}
if(servSymbols[2]=="SCAT" || servSymbols[2]=="SCAT_FS"){
reelTeaser=true;
}
if(servSymbols[3]=="SCAT" || servSymbols[2]=="SCAT_FS"){
reelTeaser=true;
}







};

this.HideSymbol=function(cPos){

objArr[cPos].visible=false;

};
/*первоначальное заполнение барабана*/
this.FillReel=function(){
if(slotSettings.lastEvent=='NULL'){
curPosition=RandomInt(1,reelStrip.length-(symCnt+2));
}

var rPos=curPosition-1;



for(var i=0; i<(symCnt+2); i++){



var sAnim=setObj[reelStrip[(rPos+i)]].res;
if(slotSettings.lastEvent!='NULL' && i>0 && i<5){

var csym=slotSettings.lastEvent.serverResponse.reelsSymbols['reel'+reelId][i-1];

 sAnim=setObj[csym].res;

}
objArr[i]=new PIXI.Sprite(txArr[sAnim[0]]);


	self._view.addChild(objArr[i]);
	objArr[i].x=0;
	objArr[i].y=((i-1)*symHeight);


}
	

for(var j=0; j<(symCnt+2); j++){




stackedWilds[j]	=new PIXI.Sprite(txArr['SCAT']);
self._view.addChild(stackedWilds[j]);
stackedWilds[j].x=0;
stackedWilds[j].y=((j-1)*symHeight);
stackedWilds[j].visible=false;

}
	
	

};

/*пзначение от сервера, заполнение барабана*/
this.FillServerReelDark=function(sym,ps){

servSymbols=sym;
curPosition=ps-1;

if(curPosition<0){
curPosition=reelStrip.length-1;
}



for(var i=0; i<(symCnt+2); i++){


if(i>0 && i<(symCnt+1)){

	if(bonusMode && slotSpinResult.expSymbol==servSymbols[i-1]){
	var symC=servSymbols[i-1]+"_FS";
	}else{
	var symC=servSymbols[i-1];

	}


var sAnim=setObj[symC].res[0];



}else{

if(bonusMode  && slotSpinResult.expSymbol==reelStrip[curPosition]){
	var symC=reelStrip[curPosition];
	}else{
	var symC=reelStrip[curPosition];

	}

var sAnim=setObj[symC].res[0];


}
this._view.removeChild(objArr[i]);
objArr[i]=new PIXI.Sprite(txArr[sAnim]);




	this._view.addChild(objArr[i]);
	objArr[i].x=0;

	objArr[i].y=((i-1)*symHeight);
	objArr[i].tint=0x666666;
objArr[i].visible=true;




}

for(var i=0; i<(symCnt+2); i++){



	if(servSymbols[i-1]=="SCAT_FS" || servSymbols[i-1]=="SCAT"){
	this._view.removeChild(objArr[i]);
	this._view.addChild(objArr[i]);
	objArr[i].pivot.y=0;	
	}else{
	objArr[i].pivot.y=0;		
	}

}

	
self._view.removeChild(stackedWilds[1]);
self._view.addChild(stackedWilds[1]);

self._view.removeChild(stackedWilds[2]);
self._view.addChild(stackedWilds[2]);

self._view.removeChild(stackedWilds[3]);
self._view.addChild(stackedWilds[3]);	

self._view.removeChild(stackedWilds[4]);
self._view.addChild(stackedWilds[4]);		
	
	

};
this.FillServerReelBlack=function(sym,ps){

servSymbols=sym;
curPosition=ps-1;

if(curPosition<0){
curPosition=reelStrip.length-1;
}



for(var i=0; i<(symCnt+2); i++){


if(i>0 && i<(symCnt+1)){

	if(bonusMode && slotSpinResult.expSymbol==servSymbols[i-1]){
	var symC=servSymbols[i-1]+"_FS";
	}else{
	var symC=servSymbols[i-1];

	}


var sAnim=setObj[symC].res[0];



}else{

if(bonusMode  && slotSpinResult.expSymbol==reelStrip[curPosition]){
	var symC=reelStrip[curPosition];
	}else{
	var symC=reelStrip[curPosition];

	}

var sAnim=setObj[symC].res[0];


}
this._view.removeChild(objArr[i]);
objArr[i]=new PIXI.Sprite(txArr[sAnim]);




	this._view.addChild(objArr[i]);
	objArr[i].x=0;

	objArr[i].y=((i-1)*symHeight);
	
objArr[i].visible=true;

if(slotSpinResult.expSymbol!=servSymbols[i-1]){
var filter = new PIXI.filters.ColorMatrixFilter();
filter.greyscale(0.35,true);
objArr[i].filters = [filter];
}


}

for(var i=0; i<(symCnt+2); i++){



	if(servSymbols[i-1]=="SCAT_FS" || servSymbols[i-1]=="SCAT"){
	this._view.removeChild(objArr[i]);
	this._view.addChild(objArr[i]);
	}

	if(reelTeaser){

if(objArr[i].y>=(symHeight)*symCnt){
objArr[i].visible=false;
}
}

}


};
this.FillServerReel=function(sym,ps){

servSymbols=sym;
curPosition=ps-1;

if(curPosition<0){
curPosition=reelStrip.length-1;
}


console.log(curPosition);
for(var i=0; i<(symCnt+2); i++){


if(i>0 && i<(symCnt+1)){

	if(bonusMode && slotSpinResult.expSymbol==servSymbols[i-1]){
	var symC=servSymbols[i-1]+"_FS";
	}else{
	var symC=servSymbols[i-1];

	}


var sAnim=setObj[symC].res[0];



}else{

if(bonusMode  && slotSpinResult.expSymbol==reelStrip[curPosition]){
	var symC=reelStrip[curPosition];
	}else{
	var symC=reelStrip[curPosition];

	}

var sAnim=setObj[symC].res[0];


}
this._view.removeChild(objArr[i]);
objArr[i]=new PIXI.Sprite(txArr[sAnim]);




	this._view.addChild(objArr[i]);
	objArr[i].x=0;

	if(symC=='SCAT' || symC=='SCAT_FS'){
objArr[i].pivot.y=0;	
	   }
	   
	objArr[i].y=((i-1)*symHeight);
objArr[i].visible=true;




}

for(var i=0; i<(symCnt+2); i++){



	if(servSymbols[i-1]=="SCAT_FS" || servSymbols[i-1]=="SCAT"){
	this._view.removeChild(objArr[i]);
	this._view.addChild(objArr[i]);
	objArr[i].pivot.y=0;	
	}

	if(reelTeaser){

if(objArr[i].y>=(symHeight)*symCnt){
//objArr[i].visible=false;
}
}

}
	
	
self._view.removeChild(stackedWilds[1]);
self._view.addChild(stackedWilds[1]);

self._view.removeChild(stackedWilds[2]);
self._view.addChild(stackedWilds[2]);

self._view.removeChild(stackedWilds[3]);
self._view.addChild(stackedWilds[3]);	

self._view.removeChild(stackedWilds[4]);
self._view.addChild(stackedWilds[4]);	
	
};

	

this.ShowStackedWilds=function(stckArr){
  
  
  


  
 if(stckArr[0]==true){

  stackedWilds[1].visible=true; 
 }
 if(stckArr[1]==true){

  stackedWilds[2].visible=true; 
 }
 if(stckArr[2]==true){

  stackedWilds[3].visible=true; 
 }
 if(stckArr[3]==true){

  stackedWilds[4].visible=true; 
 }
  
  
};


this.HideStackedWilds=function(){
  
  
 for(var i=0; i<(symCnt+2); i++){


stackedWilds[i].visible=false;


} 
  
  
};	
	
/*маска*/

this.SetMask=function(){



var graphics = new PIXI.Graphics();
graphics.beginFill(0xFF700B, 1);
graphics.drawRect(rX, rY, rX+symWidth, (symHeight)*symCnt);





       this._view.mask=graphics;




}

this.ExpMask=function(){



var graphics = new PIXI.Graphics();
graphics.beginFill(0xFF700B, 1);


if(servSymbols[0]=="SCAT"){
graphics.drawRect(rX, rY-16, rX+symWidth, (symHeight)*symCnt+16);

}else if(servSymbols[2]){

graphics.drawRect(rX, rY, rX+symWidth, (symHeight)*symCnt+16);
}



       this._view.mask=graphics;




}

this.SetMask=function(){



var graphics = new PIXI.Graphics();
graphics.beginFill(0xFF700B, 1);
graphics.drawRect(rX, rY, rX+symWidth, (symHeight)*symCnt);





       this._view.mask=graphics;




}


this.ResetMask=function(){



var graphics = new PIXI.Graphics();
graphics.beginFill(0xFF700B, 1);
graphics.drawRect(rX-symWidth, rY+112, rX+symWidth, (symHeight)*symCnt);





       this._view.mask=graphics;




}

viewContainer.addChild(this._view);


this.FillReel();
this.GetRandomSym=function(sym){

var tmpSym=sym;
var reelStripTmp=RandomInt(0,reelStrip.length-1);

if( sym == servSymbols[1] || sym == servSymbols[2] ||  sym ==chSymbols[chSymbols.length-1] ||  sym ==chSymbols[chSymbols.length-2] ||  sym ==chSymbols[chSymbols.length-3]){

for(var i=0; i<reelStrip.length-1; i++){

sym=reelStrip[reelStripTmp];

reelStripTmp--;
if(reelStripTmp<0){
reelStripTmp=reelStrip.length-1;
}


if( sym != servSymbols[1] && sym != servSymbols[2] && sym !=chSymbols[chSymbols.length-1] && sym !=chSymbols[chSymbols.length-2]  && sym !=chSymbols[chSymbols.length-3]){


	break;
}else{
sym=tmpSym;
}

}

}


chSymbols.push(sym);
return sym;
};
/*вращение барабана*/
this.MoveReel=function(delta){


if(rollCount>0 ){


rollStepCount++;

for(var i=0; i<(symCnt+2); i++){

objArr[i].y+=rollSpeed;
objArr[i].visible=true;

if(objArr[i].y>=symHeight*(symCnt+1)){

rollStepCount=0;





if(rollCount>5 || rollCount<=1){

curPosition--;

if(curPosition<0){
curPosition=reelStrip.length-1;
}

if(rollCount<=8){

var chSym1=self.GetRandomSym(reelStrip[curPosition]);


}else if(rollCount<=10){

var chSym1=reelStrip[curPosition];
chSymbols.push(reelStrip[curPosition]);

}else{

var chSym1=reelStrip[curPosition];

}


	
if(bonusMode && slotSpinResult.expSymbol==chSym1){
	chSym1=chSym1+"_FS";
}	

var sAnim=setObj[chSym1].res[0];

	objArr[i].texture=txArr[sAnim];

if('SCAT'==chSym1 || 'SCAT_FS'==chSym1){
objArr[i].pivot.y=0;
self._view.removeChild(objArr[i]);	
self._view.addChild(objArr[i]);	
}else{
objArr[i].pivot.y=0;	
}

}else{


var	chSym1=servSymbols[rollCount-2];


var sAnim=setObj[chSym1].res[0];





	objArr[i].texture=txArr[sAnim];

if('SCAT'==chSym1 || 'SCAT_FS'==chSym1){
objArr[i].pivot.y=0;
self._view.removeChild(objArr[i]);	
self._view.addChild(objArr[i]);	
}else{
objArr[i].pivot.y=0;	
}

}


if(rollCount==2 ){

var reelEventSnd=new CustomEvent("reelStopSnd",{detail:{reel:reelId,teaser:reelTeaser}});



dispatchEvent(reelEventSnd);

}




objArr[i].y-=symHeight*6;

rollCount--;


}


}


}else{


if(rollCount==0){

self.FillServerReel(slotSpinResult.reelsSymbols['reel'+(reelId)],slotSpinResult.reelsSymbols['rp'][(reelId-1)]);
}

for(var i=0; i<(symCnt+2); i++){

if(rollCount>-1){

objArr[i].y+=rollSpeed/2;

}else if(rollCount>-5){

objArr[i].y-=(rollSpeed/8)	;

}


}



rollCount--;

if(rollCount<=-7){




self.StopRoll();
}


}

	
	
self._view.removeChild(stackedWilds[1]);
self._view.addChild(stackedWilds[1]);

self._view.removeChild(stackedWilds[2]);
self._view.addChild(stackedWilds[2]);

self._view.removeChild(stackedWilds[3]);
self._view.addChild(stackedWilds[3]);	

self._view.removeChild(stackedWilds[4]);
self._view.addChild(stackedWilds[4]);		
	

};


this.StartRoll=function(){

reelTeaser=false;

rollCount=9999;
rollStepCount=0;
totalRollStop=0;
rollSpeed=(symHeight/1.7);
 app.ticker.add(this.MoveReel);

for(var i=0; i<(symCnt+1); i++){






}

};

this.StopRoll=function(){

totalRollStop++;

 app.ticker.remove(this.MoveReel);

if(reelTeaser ){
scattersCount++;
}

if(isLongRoll && reelId!=5){

dispatchEvent(new Event(SLOT_EVENT_LONGREEL));

}

if(scattersCount==2 && !isLongRoll && slotSettings.slotScatterType==1 && reelId!=5){

isLongRoll=true;
dispatchEvent(new Event(SLOT_EVENT_LONGSTOP));



dispatchEvent(new Event(SLOT_EVENT_LONGREEL));



return;

}


var reelEvent_=new CustomEvent("reelStop",{detail:{reel:reelId,teaser:reelTeaser}});

dispatchEvent(reelEvent_);






};


return this;
}




function GameReels(viewContainer,setObj){

/*класс для управления всеми барабанами*/

var isFast=false;
var isResponse=false;
this._view=new PIXI.Container();
var objArr=new Array();

var self=this;



for(var i=1; i<=slotSettings.slotReelsConfig.length; i++){


objArr[i-1]=new GameReel(this._view,setObj,i,slotSettings.slotReelsConfig[i-1][2]);
objArr[i-1].SetPosition({x:slotSettings.slotReelsConfig[i-1][0],y:slotSettings.slotReelsConfig[i-1][1]});
objArr[i-1].SetMask();

}

viewContainer.addChild(this._view);


this.AdvancedRoll=function(){

dispatchEvent(new Event(SLOT_EVENT_ADVANCEDSPINBONUS));

};

this.GetPositions=function(){

var arr=new Array();

for(var i=0; i<5; i++){


arr[i]={x:objArr[i]._view.x,y:objArr[i]._view.y};

}
return arr;
};

this.StartRoll=function(){
isLongRoll=false;

scattersCount=0;
if(slotSettings.slotBonusType==1 && bonusMode){

self.AdvancedRoll();

}else{


for(var i=0; i<5; i++){
objArr[i].SetMask();
objArr[i].StartRoll();
}

}


};

this.ResetMask=function(){



for(var i=0; i<5; i++){



objArr[i].ResetMask();



}



};

this.StopReels=function(){

isResponse=true;
var longRoll=0;

for(var i=0; i<5; i++){

if(slotSettings.slotScatterType==1 ){
longRoll+=objArr[i].CheckScatters();
	}


objArr[i].StopReel(10+(i*6),slotSpinResult.reelsSymbols['reel'+(i+1)]);



}

if(isFast){


self.FastStopReels();

}


isFast=false;

};


this.FastStopReels=function(){

isFast=true;

var longRoll=0;

if(isResponse){

for(var i=0; i<5; i++){

	if(slotSettings.slotScatterType==1 ){
longRoll+=objArr[i].CheckScatters();
	}

if(longRoll<2){
objArr[i].ChangeReelCount();
}


}

}


};

this.HideSymbol=function(reel,cPos){

objArr[reel-1].HideSymbol((cPos+1));

};

/*подписываемся на нужные события*/

addEventListener(SLOT_EVENT_STARTBONUS,function(){


});
addEventListener(SLOT_EVENT_ENDBONUS,function(){
bonusMode=false;


objArr[0].FillServerReel(slotSpinResult.reelsSymbols['reel1'],slotSpinResult.reelsSymbols['rp'][0]);
objArr[1].FillServerReel(slotSpinResult.reelsSymbols['reel2'],slotSpinResult.reelsSymbols['rp'][1]);
objArr[2].FillServerReel(slotSpinResult.reelsSymbols['reel3'],slotSpinResult.reelsSymbols['rp'][2]);
objArr[3].FillServerReel(slotSpinResult.reelsSymbols['reel4'],slotSpinResult.reelsSymbols['rp'][3]);
objArr[4].FillServerReel(slotSpinResult.reelsSymbols['reel5'],slotSpinResult.reelsSymbols['rp'][4]);

	
objArr[0].HideStackedWilds();
objArr[1].HideStackedWilds();
objArr[2].HideStackedWilds();
objArr[3].HideStackedWilds();
objArr[4].HideStackedWilds();	
	


});

addEventListener(SLOT_EVENT_AFTERSPIN,function(){
	isFast=false;
	isResponse=false;

objArr[0].FillServerReel(slotSpinResult.reelsSymbols['reel1'],slotSpinResult.reelsSymbols['rp'][0]);
objArr[1].FillServerReel(slotSpinResult.reelsSymbols['reel2'],slotSpinResult.reelsSymbols['rp'][1]);
objArr[2].FillServerReel(slotSpinResult.reelsSymbols['reel3'],slotSpinResult.reelsSymbols['rp'][2]);
objArr[3].FillServerReel(slotSpinResult.reelsSymbols['reel4'],slotSpinResult.reelsSymbols['rp'][3]);
objArr[4].FillServerReel(slotSpinResult.reelsSymbols['reel5'],slotSpinResult.reelsSymbols['rp'][4]);

});
addEventListener(SLOT_EVENT_STARTSPIN,function(){
  
  if(bonusMode){
	
objArr[0].ShowStackedWilds([slotSpinResult.stackedWilds[1],slotSpinResult.stackedWilds[2],slotSpinResult.stackedWilds[3],slotSpinResult.stackedWilds[4]]);
objArr[1].ShowStackedWilds([slotSpinResult.stackedWilds[5],slotSpinResult.stackedWilds[6],slotSpinResult.stackedWilds[7],slotSpinResult.stackedWilds[8]]);
objArr[2].ShowStackedWilds([slotSpinResult.stackedWilds[9],slotSpinResult.stackedWilds[10],slotSpinResult.stackedWilds[11],slotSpinResult.stackedWilds[12]]);
objArr[3].ShowStackedWilds([slotSpinResult.stackedWilds[13],slotSpinResult.stackedWilds[14],slotSpinResult.stackedWilds[15],slotSpinResult.stackedWilds[16]]);
objArr[4].ShowStackedWilds([slotSpinResult.stackedWilds[17],slotSpinResult.stackedWilds[18],slotSpinResult.stackedWilds[19],slotSpinResult.stackedWilds[20]]);

}	
  
  if(slotSpinResult.reelsSymbols!=undefined){

objArr[0].FillServerReel(slotSpinResult.reelsSymbols['reel1'],slotSpinResult.reelsSymbols['rp'][0]);
	objArr[1].FillServerReel(slotSpinResult.reelsSymbols['reel2'],slotSpinResult.reelsSymbols['rp'][1]);
	objArr[2].FillServerReel(slotSpinResult.reelsSymbols['reel3'],slotSpinResult.reelsSymbols['rp'][2]);
	objArr[3].FillServerReel(slotSpinResult.reelsSymbols['reel4'],slotSpinResult.reelsSymbols['rp'][3]);
	objArr[4].FillServerReel(slotSpinResult.reelsSymbols['reel5'],slotSpinResult.reelsSymbols['rp'][4]);

}

	
  
  
  self.StartRoll();
  
  
  
  
});
addEventListener(SLOT_EVENT_RESULTSPIN,function(){

if(slotSettings.slotBonusType==1 && bonusMode){

objArr[0].FillServerReel(slotSpinResult.reelsSymbols['reel1'],slotSpinResult.reelsSymbols['rp'][0]);
	objArr[1].FillServerReel(slotSpinResult.reelsSymbols['reel2'],slotSpinResult.reelsSymbols['rp'][1]);
	objArr[2].FillServerReel(slotSpinResult.reelsSymbols['reel3'],slotSpinResult.reelsSymbols['rp'][2]);
	objArr[3].FillServerReel(slotSpinResult.reelsSymbols['reel4'],slotSpinResult.reelsSymbols['rp'][3]);
	objArr[4].FillServerReel(slotSpinResult.reelsSymbols['reel5'],slotSpinResult.reelsSymbols['rp'][4]);

}else{

self.StopReels();

}

});



addEventListener(SLOT_EVENT_SHOWWIN,function(){


	objArr[0].FillServerReelDark(slotSpinResult.reelsSymbols['reel1'],slotSpinResult.reelsSymbols['rp'][0]);
	objArr[1].FillServerReelDark(slotSpinResult.reelsSymbols['reel2'],slotSpinResult.reelsSymbols['rp'][1]);
	objArr[2].FillServerReelDark(slotSpinResult.reelsSymbols['reel3'],slotSpinResult.reelsSymbols['rp'][2]);
	objArr[3].FillServerReelDark(slotSpinResult.reelsSymbols['reel4'],slotSpinResult.reelsSymbols['rp'][3]);
	objArr[4].FillServerReelDark(slotSpinResult.reelsSymbols['reel5'],slotSpinResult.reelsSymbols['rp'][4]);

});
addEventListener(SLOT_EVENT_HIDEWIN,function(){

if(slotSpinResult.reelsSymbols==undefined){

return;

}

	objArr[0].FillServerReel(slotSpinResult.reelsSymbols['reel1'],slotSpinResult.reelsSymbols['rp'][0]);
	objArr[1].FillServerReel(slotSpinResult.reelsSymbols['reel2'],slotSpinResult.reelsSymbols['rp'][1]);
	objArr[2].FillServerReel(slotSpinResult.reelsSymbols['reel3'],slotSpinResult.reelsSymbols['rp'][2]);
	objArr[3].FillServerReel(slotSpinResult.reelsSymbols['reel4'],slotSpinResult.reelsSymbols['rp'][3]);
	objArr[4].FillServerReel(slotSpinResult.reelsSymbols['reel5'],slotSpinResult.reelsSymbols['rp'][4]);

});
addEventListener(SLOT_EVENT_FASTSTOP,function(){self.FastStopReels();});
addEventListener(SLOT_EVENT_LONGSTOP,function(){

var ic=1;

for(var i=totalRollStop; i<5; i++){

ic++;
objArr[i].LongRoll((ic-1)*2);



}

});

return this;
}
