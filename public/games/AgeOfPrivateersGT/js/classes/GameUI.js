

/////////////UI class////////////////////

function GameUI(viewContainer,setObj){

/*

игровой интерфейс.

*/

var keyPressed=false;
var keyPressedTimeout;

this._view=new PIXI.Container();


var self=this;

var objArr=new Array();

objArr['closeAllTabs']=new PIXI.Graphics();
objArr['closeAllTabs'].beginFill(0x000000); 
objArr['closeAllTabs'].lineStyle(1, 0x666666);
objArr['closeAllTabs'].drawRect(
    0,
    0,
    2048,
    1024
);
objArr['closeAllTabs'].endFill();
self._view.addChild(objArr['closeAllTabs']);

objArr['closeAllTabs'].alpha=0.001;
objArr['closeAllTabs'].visible=false;
objArr['closeAllTabs'].interactive=true;

objArr['closeAllTabs'].on('pointerdown', function(){
	

var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);	
	
});

/*---------menu tab------------*/
objArr['menuTab']=new PIXI.Container();


objArr['menuTab0']=new PIXI.Graphics();
objArr['menuTab0'].beginFill(0x000000); 
objArr['menuTab0'].lineStyle(1, 0x666666);
objArr['menuTab0'].drawRoundedRect(
    0,
    0,
    260,
    350,
    10,
);
objArr['menuTab0'].endFill();
objArr['menuTab'].addChild(objArr['menuTab0']);
self._view.addChild(objArr['menuTab']);


objArr['menuTab'].x=426;
objArr['menuTab'].y=490;
objArr['menuTab'].visible=false;

/*---------------------*/



/*---------lines window------------*/
objArr['linesTab']=new PIXI.Container();

var linesTabHeight=Math.ceil(slotSettings.gameLine.length/5)*60+180;

var linesTabLines=Math.ceil(slotSettings.gameLine.length/5);
var linesTabPages=Math.ceil(slotSettings.gameLine.length/25);

if(linesTabLines>5){
linesTabHeight=5.5*60+180;	
}

objArr['linesTab0']=new PIXI.Graphics();
objArr['linesTab0'].beginFill(0x000000); 
objArr['linesTab0'].lineStyle(1, 0x666666);
objArr['linesTab0'].drawRoundedRect(
    0,
    0,
    640,
    linesTabHeight,
    10,
);
objArr['linesTab0'].endFill();
objArr['linesTab'].addChild(objArr['linesTab0']);



objArr['linesTab'].x=706;
objArr['linesTab'].y=390;


/*-----bet content--------*/

var styleWndTitle = new PIXI.TextStyle({
    fontFamily: 'Arial Bold',
    fontSize: 26,
    fontWeight: '',
    fill: ["#FFFFFF","#FFFFFF"], // gradient
    stroke: '#FFFFFF',
    strokeThickness: 0,
	align: 'center',	
    dropShadow:false,
    dropShadowColor: '#FFFFFF',
    dropShadowBlur: 5,
    dropShadowAngle: 0,
    dropShadowDistance: 0,
    wordWrap: false,
    wordWrapWidth: 880
});	
var styleTipTitle = new PIXI.TextStyle({
    fontFamily: 'Arial Regular',
    fontSize: 16,
    fontWeight: '300',
    fill: ["#FFE800","#FFCB00"], // gradient
    stroke: '#FFFFFF',
    strokeThickness: 0,
	align: 'center',	
    dropShadow:false,
    dropShadowColor: '#FFFFFF',
    dropShadowBlur: 5,
    dropShadowAngle: 0,
    dropShadowDistance: 0,
    wordWrap: false,
    wordWrapWidth: 880
});

objArr['linesTabLabel']=new PIXI.Text('LINES',styleWndTitle);

objArr['linesTabLabel'].x=40;
objArr['linesTabLabel'].y=20;

var xx=0;
var yy=0;

var lineCount=0;
var rowCount=0;

for(var i=0; i<slotSettings.gameLine.length; i++){

objArr['linesTabLn_'+i]=new RoundRectWndButton(objArr['linesTab'],'linesTabLn_'+i,[],["0x000000","0xE0A802","0xFFE300","0x999999"],100,50,undefined,NumFormat(slotSettings.gameLine[i]));

objArr['linesTabLn_'+i]._view.x=88+xx;
objArr['linesTabLn_'+i]._view.y=100+yy;

lineCount++;

if(lineCount>=5){
lineCount=0;
yy+=60;
xx=0;

rowCount++;

if(rowCount>=5){
rowCount=0;	
yy=0;	
}
	
}else{
xx+=116;	
}

}

/*-----------------*/
objArr['linesTabClose']=new RoundRectSimpleButton(objArr['linesTab'],'linesTabClose',["close-icon"],["0x000000","0xE0A802","0xFFE300","0x999999","0xFFCC00"],100,50,undefined,slotSettings.gameLine[i]);

objArr['linesTabClose']._view.x=588;
objArr['linesTabClose']._view.y=30;
/*----------------*/

objArr['linesTabPg0']=new PIXI.Text('1-25',styleWndTitle);

objArr['linesTabPg0'].x=80;
objArr['linesTabPg0'].y=linesTabHeight-105;
objArr['linesTabPg0'].scale.set(0.7,0.7);


objArr['linesTabPg1']=new PIXI.Text('26-50',styleWndTitle);

objArr['linesTabPg1'].x=515;
objArr['linesTabPg1'].y=linesTabHeight-105;
objArr['linesTabPg1'].scale.set(0.7,0.7);

/*----------------*/



objArr['linesTabLabel0']=new PIXI.Text('TOTAL BET 1000',styleWndTitle);

objArr['linesTabLabel0'].x=40;
objArr['linesTabLabel0'].y=linesTabHeight-60;

objArr['linesTabLabel1']=new PIXI.Text('BET/LINE (50/10)',styleWndTitle);

objArr['linesTabLabel1'].x=607;
objArr['linesTabLabel1'].anchor.x=1;
objArr['linesTabLabel1'].y=linesTabHeight-60;


objArr['linesTabLine']=new PIXI.Graphics();
objArr['linesTabLine'].beginFill(0x696969); 

objArr['linesTabLine'].drawRect(
    0,
    0,
    560,
    1,
    
);
objArr['linesTabLine'].endFill();
objArr['linesTab'].addChild(objArr['linesTabLine']);
objArr['linesTabLine'].y=linesTabHeight-70;
objArr['linesTabLine'].x=40;

/*-------------------------*/



objArr['linesTabLine0']=new PIXI.Graphics();
objArr['linesTabLine0'].beginFill(0x696969); 

objArr['linesTabLine0'].drawRect(
    0,
    0,
    560,
    1,
    
);
objArr['linesTabLine0'].endFill();
objArr['linesTab'].addChild(objArr['linesTabLine0']);
objArr['linesTabLine0'].y=linesTabHeight-123;
objArr['linesTabLine0'].x=40;


/*--------------------------*/

objArr['linesTab'].addChild(objArr['linesTabLabel']);
objArr['linesTab'].addChild(objArr['linesTabLabel0']);
objArr['linesTab'].addChild(objArr['linesTabLabel1']);
self._view.addChild(objArr['linesTab']);


objArr['linesTab'].pivot.y=objArr['linesTab'].height/2;
objArr['linesTab'].y=472;
objArr['linesTab'].visible=false;



/*-----------------*/
objArr['linesTabNext']=new RoundRectSimpleButton(objArr['linesTab'],'linesTabNext',["line-paging-next"],["0x000000","0xE0A802","0xFFE300","0x999999","0xFFCC00"],100,30,undefined,slotSettings.gameLine[i]);

objArr['linesTabNext']._view.x=588;
objArr['linesTabNext']._view.y=objArr['linesTabLine'].y-25;


objArr['linesTabPrev']=new RoundRectSimpleButton(objArr['linesTab'],'linesTabPrev',["line-paging-back"],["0x000000","0xE0A802","0xFFE300","0x999999","0xFFCC00"],100,30,undefined,slotSettings.gameLine[i]);

objArr['linesTabPrev']._view.x=55;
objArr['linesTabPrev']._view.y=objArr['linesTabLine'].y-25;

/*----------------*/

if(linesTabPages>1){

objArr['linesTabNext']._view.visible=true;	
objArr['linesTabPrev']._view.visible=true;	
objArr['linesTabLine0'].visible=true;	
objArr['linesTabPg1'].visible=true;	
objArr['linesTabPg0'].visible=true;
	
}else{
	
objArr['linesTabNext']._view.visible=false;	
objArr['linesTabPrev']._view.visible=false;	
objArr['linesTabLine0'].visible=false;		
objArr['linesTabPg1'].visible=false;	
objArr['linesTabPg0'].visible=false;	
	
}

objArr['linesTab'].addChild(objArr['linesTabPg1']);
objArr['linesTab'].addChild(objArr['linesTabPg0']);


/*---------------------*/


/*---------bet window------------*/
objArr['betsTab']=new PIXI.Container();

var linesTabHeight=Math.ceil(slotSettings.Bet.length/5)*60+180;

var betsTabLines=Math.ceil(slotSettings.Bet.length/5);
var betsTabPages=Math.ceil(slotSettings.Bet.length/25);

if(betsTabLines>5){
linesTabHeight=5.5*60+180;	
}

objArr['betsTab0']=new PIXI.Graphics();
objArr['betsTab0'].beginFill(0x000000); 
objArr['betsTab0'].lineStyle(1, 0x666666);
objArr['betsTab0'].drawRoundedRect(
    0,
    0,
    640,
    linesTabHeight,
    10,
);
objArr['betsTab0'].endFill();
objArr['betsTab'].addChild(objArr['betsTab0']);



objArr['betsTab'].x=706;
objArr['betsTab'].y=390;


/*-----bet content--------*/

var styleWndTitle = new PIXI.TextStyle({
    fontFamily: 'Arial Bold',
    fontSize: 26,
    fontWeight: '',
    fill: ["#FFFFFF","#FFFFFF"], // gradient
    stroke: '#FFFFFF',
    strokeThickness: 0,
	align: 'center',	
    dropShadow:false,
    dropShadowColor: '#FFFFFF',
    dropShadowBlur: 5,
    dropShadowAngle: 0,
    dropShadowDistance: 0,
    wordWrap: false,
    wordWrapWidth: 880
});	
var styleTipTitle = new PIXI.TextStyle({
    fontFamily: 'Arial Regular',
    fontSize: 16,
    fontWeight: '300',
    fill: ["#FFE800","#FFCB00"], // gradient
    stroke: '#FFFFFF',
    strokeThickness: 0,
	align: 'center',	
    dropShadow:false,
    dropShadowColor: '#FFFFFF',
    dropShadowBlur: 5,
    dropShadowAngle: 0,
    dropShadowDistance: 0,
    wordWrap: false,
    wordWrapWidth: 880
});

objArr['betsTabLabel']=new PIXI.Text('TOTAL BET',styleWndTitle);

objArr['betsTabLabel'].x=40;
objArr['betsTabLabel'].y=20;

var xx=0;
var yy=0;

var lineCount=0;
var rowCount=0;

for(var i=0; i<slotSettings.Bet.length; i++){

objArr['betsTabLn_'+i]=new RoundRectWndButton(objArr['betsTab'],'betsTabLn_'+i,[],["0x000000","0xE0A802","0xFFE300","0x999999"],100,50,undefined,NumFormat(slotSettings.Bet[i]));

objArr['betsTabLn_'+i]._view.x=88+xx;
objArr['betsTabLn_'+i]._view.y=100+yy;

lineCount++;

if(lineCount>=5){
lineCount=0;
yy+=60;
xx=0;

rowCount++;

if(rowCount>=5){
rowCount=0;	
yy=0;	
}
	
}else{
xx+=116;	
}

}

/*-----------------*/
objArr['betsTabClose']=new RoundRectSimpleButton(objArr['betsTab'],'betsTabClose',["close-icon"],["0x000000","0xE0A802","0xFFE300","0x999999","0xFFCC00"],100,50,undefined,slotSettings.gameLine[i]);

objArr['betsTabClose']._view.x=588;
objArr['betsTabClose']._view.y=30;
/*----------------*/

objArr['betsTabPg0']=new PIXI.Text('1-25',styleWndTitle);

objArr['betsTabPg0'].x=80;
objArr['betsTabPg0'].y=linesTabHeight-105;
objArr['betsTabPg0'].scale.set(0.7,0.7);


objArr['betsTabPg1']=new PIXI.Text('26-50',styleWndTitle);

objArr['betsTabPg1'].x=515;
objArr['betsTabPg1'].y=linesTabHeight-105;
objArr['betsTabPg1'].scale.set(0.7,0.7);

/*----------------*/



objArr['betsTabLabel0']=new PIXI.Text('TOTAL BET 1000',styleWndTitle);

objArr['betsTabLabel0'].x=40;
objArr['betsTabLabel0'].y=linesTabHeight-60;

objArr['betsTabLabel1']=new PIXI.Text('BET/LINE (50/10)',styleWndTitle);

objArr['betsTabLabel1'].x=607;
objArr['betsTabLabel1'].anchor.x=1;
objArr['betsTabLabel1'].y=linesTabHeight-60;



objArr['betsTabLine']=new PIXI.Graphics();
objArr['betsTabLine'].beginFill(0x696969); 

objArr['betsTabLine'].drawRect(
    0,
    0,
    560,
    1,
    
);
objArr['betsTabLine'].endFill();
objArr['betsTab'].addChild(objArr['betsTabLine']);
objArr['betsTabLine'].y=linesTabHeight-70;
objArr['betsTabLine'].x=40;

/*-------------------------*/



objArr['betsTabLine0']=new PIXI.Graphics();
objArr['betsTabLine0'].beginFill(0x696969); 

objArr['betsTabLine0'].drawRect(
    0,
    0,
    560,
    1,
    
);
objArr['betsTabLine0'].endFill();
objArr['betsTab'].addChild(objArr['betsTabLine0']);
objArr['betsTabLine0'].y=linesTabHeight-123;
objArr['betsTabLine0'].x=40;


/*--------------------------*/

objArr['betsTab'].addChild(objArr['betsTabLabel']);
objArr['betsTab'].addChild(objArr['betsTabLabel0']);
objArr['betsTab'].addChild(objArr['betsTabLabel1']);
self._view.addChild(objArr['betsTab']);


objArr['betsTab'].pivot.y=objArr['betsTab'].height/2;
objArr['betsTab'].y=472;
objArr['betsTab'].visible=false;



/*-----------------*/
objArr['betsTabNext']=new RoundRectSimpleButton(objArr['betsTab'],'betsTabNext',["line-paging-next"],["0x000000","0xE0A802","0xFFE300","0x999999","0xFFCC00"],100,30,undefined,slotSettings.gameLine[i]);

objArr['betsTabNext']._view.x=588;
objArr['betsTabNext']._view.y=objArr['betsTabLine'].y-25;


objArr['betsTabPrev']=new RoundRectSimpleButton(objArr['betsTab'],'betsTabPrev',["line-paging-back"],["0x000000","0xE0A802","0xFFE300","0x999999","0xFFCC00"],100,30,undefined,slotSettings.gameLine[i]);

objArr['betsTabPrev']._view.x=55;
objArr['betsTabPrev']._view.y=objArr['betsTabLine'].y-25;

/*----------------*/

if(betsTabPages>1){

objArr['betsTabNext']._view.visible=true;	
objArr['betsTabPrev']._view.visible=true;	
objArr['betsTabLine0'].visible=true;	
objArr['betsTabPg1'].visible=true;	
objArr['betsTabPg0'].visible=true;
	
}else{
	
objArr['betsTabNext']._view.visible=false;	
objArr['betsTabPrev']._view.visible=false;	
objArr['betsTabLine0'].visible=false;		
objArr['betsTabPg1'].visible=false;	
objArr['betsTabPg0'].visible=false;	
	
}

objArr['betsTab'].addChild(objArr['betsTabPg1']);
objArr['betsTab'].addChild(objArr['betsTabPg0']);


/*---------------------*/

objArr['footerTab']=new PIXI.Graphics();
objArr['footerTab'].beginFill(0x000000); 
objArr['footerTab'].lineStyle(1, 0x999999);
objArr['footerTab'].drawRoundedRect(
    0,
    0,
    2052,
    50,
    10,
);
objArr['footerTab'].endFill();
self._view.addChild(objArr['footerTab']);



objArr['footerTab'].x=-2;
objArr['footerTab'].y=983;
objArr['footerTab'].alpha=0.8;



/*------------*/

for(var i=0; i<7; i++){

objArr['footerTabDec'+i]=new PIXI.Graphics();
objArr['footerTabDec'+i].beginFill(0xcccccc); 
objArr['footerTabDec'+i].drawRect(
    0,
    0,
    1,
    50
    
);
objArr['footerTabDec'+i].endFill();
self._view.addChild(objArr['footerTabDec'+i]);

objArr['footerTabDec'+i].y=987;
objArr['footerTabDec'+i].alpha=0.3;

}
objArr['footerTabDec0'].x=430;
objArr['footerTabDec1'].x=661;
objArr['footerTabDec2'].x=855;
objArr['footerTabDec3'].x=1210;
objArr['footerTabDec4'].x=1370;
objArr['footerTabDec5'].x=1490;
objArr['footerTabDec6'].x=1625;





for(objId in setObj){

var cObj=setObj[objId];



if(cObj.type=="bitmap"){



objArr[objId]=new PIXI.Sprite(PIXI.Texture.fromFrame(cObj.res[0]));

this._view.addChild(objArr[objId]);

objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;

}else if(cObj.type=="button_text"){

if(cObj.res2!=undefined){
objArr[objId]=new ButtonText(this._view,objId,cObj.res,cObj.res2);
}else{
objArr[objId]=new ButtonText(this._view,objId,cObj.res);
}





objArr[objId]._view.x=cObj.x;
objArr[objId]._view.y=cObj.y;
objArr[objId].Enable();
}else if(cObj.type=="button"){

objArr[objId]=new ButtonUI(this._view,objId,cObj.res);

objArr[objId]._view.x=cObj.x;
objArr[objId]._view.y=cObj.y;
objArr[objId].Enable();
}else if(cObj.type=="button_round_rect_min"){

objArr[objId]=new RoundRectMinButton(objArr['uiButtonBet']._view,objId,cObj.res,cObj.colors,cObj.width,cObj.height,cObj.minText);

objArr[objId]._view.x=cObj.x;
objArr[objId]._view.y=cObj.y;
objArr[objId].Enable();
}else if(cObj.type=="button_round_rect"){

objArr[objId]=new RoundRectButton(this._view,objId,cObj.res,cObj.colors,cObj.width,cObj.height,cObj.minText);

objArr[objId]._view.x=cObj.x;
objArr[objId]._view.y=cObj.y;
objArr[objId].Enable();
}else if(cObj.type=="button_round_rect_menu"){

objArr[objId]=new RoundRectMenuButton(objArr['menuTab'],objId,cObj.res,cObj.colors,cObj.width,cObj.height,cObj.minText);

objArr[objId]._view.x=cObj.x;
objArr[objId]._view.y=cObj.y;
objArr[objId].Enable();
}else if(cObj.type=="button_round_rect_footer"){

objArr[objId]=new RoundRectFooterButton(self._view,objId,cObj.res,cObj.colors,cObj.width,cObj.height,cObj.minText);

objArr[objId]._view.x=cObj.x;
objArr[objId]._view.y=cObj.y;
objArr[objId].Enable();
}







}


viewContainer.addChild(this._view);

objArr['infoTab']=new PIXI.Container();
/*---------*/

objArr['infoTab0']=new PIXI.Graphics();
objArr['infoTab0'].lineStyle(2, 0x000000);
objArr['infoTab0'].drawRoundedRect(
    -(420/2),
    -(100/2),
    420,
    100,
    12,
);
objArr['infoTab0'].endFill();
objArr['infoTab'].addChild(objArr['infoTab0']);


objArr['infoTab1']=new PIXI.Graphics();

objArr['infoTab1'].beginFill(0x000000); 
objArr['infoTab1'].drawRoundedRect(
     -((420-4)/2),
    -((100-4)/2),
    420-4,
    100-4,
    12,
);
objArr['infoTab1'].endFill();
objArr['infoTab'].addChild(objArr['infoTab1']);




objArr['infoTab2']=new PIXI.Graphics();

objArr['infoTab2'].beginFill(0x000000); 
objArr['infoTab2'].drawRoundedRect(
     -((420-4)/2),
    -((100-4)/2),
    420-4,
    100-4,
    12,
);
objArr['infoTab2'].endFill();
objArr['infoTab'].addChild(objArr['infoTab2']);





objArr['infoTab3']=new PIXI.Graphics();

objArr['infoTab3'].beginFill(0x000000); 
objArr['infoTab3'].drawRoundedRect(
     -((420-4)/2),
    -((100-4)/2),
    420-4,
    100-4,
    12,
);
objArr['infoTab3'].endFill();
objArr['infoTab'].addChild(objArr['infoTab3']);



/*-----------*/


objArr['infoTab2Mask']=new PIXI.Graphics();

objArr['infoTab2Mask'].beginFill(0x000000); 
objArr['infoTab2Mask'].drawRect(
     -((420-4)/2),
    -((100-6)/2),
    420-4,
    61
    
);
objArr['infoTab2Mask'].endFill();
objArr['infoTab'].addChild(objArr['infoTab2Mask']);

objArr['infoTab2'].mask=objArr['infoTab2Mask'];



objArr['infoTab3Mask']=new PIXI.Graphics();

objArr['infoTab3Mask'].beginFill(0x000000); 
objArr['infoTab3Mask'].drawRect(
     -((420-4)/2),
    60,
    420-4,
    60
    
);

objArr['infoTab3Mask'].endFill();
objArr['infoTab'].addChild(objArr['infoTab3Mask']);
objArr['infoTab3'].mask=objArr['infoTab3Mask'];
objArr['infoTab3Mask'].y=-45;

/*---------*/

objArr['infoTab0'].alpha=0.7;
objArr['infoTab1'].alpha=0.30;
objArr['infoTab2'].alpha=0.4;
objArr['infoTab3'].alpha=0.4;



self._view.addChild(objArr['infoTab']);

objArr['infoTab'].x=1024;
objArr['infoTab'].y=896;





/*-------Init----------*/


objArr['uiButtonFooterFullOff']._view.visible=false;
objArr['uiButtonSkip']._view.visible=false;
objArr['uiButtonNext']._view.visible=false;
objArr['uiButtonPrev']._view.visible=false;
objArr['uiButtonClose']._view.visible=false;
objArr['uiButtonAutoStop']._view.visible=false;





/*----------------*/


/*-------------------*/

objArr['tipTab']=new PIXI.Container();
objArr['tipTab0']=new PIXI.Graphics();
objArr['tipTab0'].beginFill(0x000000); 
objArr['tipTab0'].lineStyle(1, 0x666666);
objArr['tipTab0'].drawRect(
    0,
    0,
    90,
    25
);
objArr['tipTab0'].endFill();
objArr['tipTab'].addChild(objArr['tipTab0']);

objArr['tipTab1']=new PIXI.Text('TIP TEXT',styleTipTitle);



objArr['tipTab'].addChild(objArr['tipTab1']);
self._view.addChild(objArr['tipTab']);

this.SetTipTab=function(txt,b){

objArr['tipTab1'].text=txt;

objArr['tipTab0'].width=objArr['tipTab1'].width+10;

objArr['tipTab1'].x=5;
objArr['tipTab1'].y=2;
objArr['tipTab'].y=955;
objArr['tipTab'].visible=true;

objArr['tipTab'].x=objArr[b]._view.x;



};

objArr['tipTab'].visible=false;

slotStateData.tipInter;

addEventListener('ui_btn_over',function(ev){

if(ev.detail.bname=='uiButtonFooterSound0' || ev.detail.bname=='uiButtonFooterSound2' || ev.detail.bname=='uiButtonFooterSound1' || ev.detail.bname=='uiButtonFooterFullOn' || ev.detail.bname=='uiButtonFooterFullOff'){
clearInterval(slotStateData.tipInter);
self.SetTipTab(slotLanguage['uiTip_'+ev.detail.bname],ev.detail.bname);
	
}
	
	
});

addEventListener('ui_btn_out',function(ev){

if(ev.detail.bname=='uiButtonFooterSound0' || ev.detail.bname=='uiButtonFooterSound2' || ev.detail.bname=='uiButtonFooterSound1' || ev.detail.bname=='uiButtonFooterFullOn' || ev.detail.bname=='uiButtonFooterFullOff'){

clearInterval(slotStateData.tipInter);
slotStateData.tipInter=setTimeout(function(){objArr['tipTab'].visible=false;},300);



}
	
	
});

/*-------------------*/

this.ResetKey=function(ev){

clearTimeout(keyPressedTimeout);

keyPressed=false;

};

this.KeyDown=function(ev){



if(keyPressed){

return;
}

keyPressed=true;

clearTimeout(keyPressedTimeout);
keyPressedTimeout=setTimeout(self.ResetKey,500);



if(slotSettings.keyController[ev.keyCode]==undefined){
	return;
}

	var keyBtnId=slotSettings.keyController[ev.keyCode].split(",");
for(var i=0; i<keyBtnId.length; i++){
	if(objArr[keyBtnId[i]]!=undefined){

	if(objArr[keyBtnId[i]].buttonState=="enabled"){

	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:keyBtnId[i]}});

	dispatchEvent(btnEvent);
	break;
	}

	}


}


};


this.ButtonsController=function(ev){
	

var tmpName=ev.detail.bname.split("_");	

var bName=ev.detail.bname;
	
if(tmpName[0]=='linesTabLn'){
bName='linesTabLn';
}	
if(tmpName[0]=='betsTabLn'){
bName='betsTabLn';
}


switch(bName){

case 'linesTabNext':

self.LinesTabSlidePage('next');

break;

case 'linesTabPrev':

self.LinesTabSlidePage('prev');

break;

case 'betsTabNext':

self.BetTabSlidePage('next');

break;

case 'betsTabPrev':

self.BetTabSlidePage('prev');

break;

case 'uiButtonAuto':
	
	if(autoMode){
	
	autoMode=false;	
	dispatchEvent(new Event(SLOT_EVENT_AUTOSTOP));	
		
	}else{
	
	if(slotStateData.credit<=0 || slotStateData.credit<slotStateData.bet){
	return;	
	}
		
	autoMode=true;	
	
	if(slotState==SLOT_STATE_AFTERWIN){
	
	
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'uiButtonCollect'}});	
	dispatchEvent(btnEvent);	
	objArr['uiButtonGamble']._view.visible=false;	
	objArr['uiButtonBet']._view.visible=true;	
	setTimeout(function(){
	
	dispatchEvent(new Event(SLOT_EVENT_AUTOSTART));		
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'uiButtonSpin'}});	
	dispatchEvent(btnEvent);	
		
		
		},700);	
		
		
		
	}else{
	
	dispatchEvent(new Event(SLOT_EVENT_AUTOSTART));		
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'uiButtonSpin'}});	
	dispatchEvent(btnEvent);		
		
	}
		
	
	}
	
	
		
	break;	


  case 'uiButtonGamble':
	
	
	
	
		
		
	if(slotState==SLOT_STATE_WINNING){
	
	gameUI.DisableButtons();
	slotStateData.totalWin=slotSpinResult.totalWin;	
	dispatchEvent(new Event(SLOT_EVENT_SKIPWIN));
	
	slotState=SLOT_STATE_GAMBLE;
	
		
	dispatchEvent(new Event(SLOT_EVENT_GAMBLESTART));	
	
	
		
			
			
	}else if(slotState==SLOT_STATE_AFTERWIN ){
	gameUI.DisableButtons();
	slotState=SLOT_STATE_GAMBLE;
   dispatchEvent(new Event(SLOT_EVENT_GAMBLESTART));	
	
			
			
	}	
		
	break;
	
  case 'uiButtonCollect':
	
	
		

	
	if(slotState==SLOT_STATE_WINNING){
	gameUI.DisableButtons();
	slotStateData.totalWin=slotSpinResult.totalWin;	
	dispatchEvent(new Event(SLOT_EVENT_SKIPWIN));
	
	if(slotSpinResult.bonusInfo.scattersType!="bonus"){	
	setTimeout(function(){
		
	dispatchEvent(new Event(SLOT_EVENT_STARTADDWIN));
AddWin();	
		
		},10);	
	}
	
		
	}else if(slotState==SLOT_STATE_AFTERWIN || slotState==SLOT_STATE_GAMBLE){
	
	if(slotSpinResult.bonusInfo.scattersType!="bonus"){	
    dispatchEvent(new Event(SLOT_EVENT_STARTADDWIN));
	AddWin();	
		}else{
		gameUI.DisableButtons();
	slotStateData.totalWin=slotSpinResult.totalWin;	
	dispatchEvent(new Event(SLOT_EVENT_SKIPWIN));	
		}
		
			
	}	
		
	
	
		
	break;	
  
  
  
  case 'uiButtonBetPlus':
	
	slotSettings.BetCnt++;
	if(slotSettings.BetCnt>slotSettings.Bet.length-1){	
	slotSettings.BetCnt=slotSettings.Bet.length-1;	
	}
	slotStateData.betline=slotSettings.Bet[slotSettings.BetCnt];	
	slotStateData.bet=slotStateData.betline*slotStateData.lines;
	
	dispatchEvent(new Event(SLOT_EVENT_BET));	
		
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);
		
		
	objArr['uiButtonBetPlus'].BorderShow();	
	objArr['uiButtonBetMinus'].BorderShow();	
		
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);	
		
	break;		
		
	case 'uiButtonBetMinus':
	
	
	if(slotSettings.BetCnt>0){	
	slotSettings.BetCnt--;
	}
	slotStateData.betline=slotSettings.Bet[slotSettings.BetCnt];	
	slotStateData.bet=slotStateData.betline*slotStateData.lines;
	
	dispatchEvent(new Event(SLOT_EVENT_BET));	
		
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);

	objArr['uiButtonBetPlus'].BorderShow();	
	objArr['uiButtonBetMinus'].BorderShow();
	
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);
		
	break;	
  

 case 'uiButtonMenuExit':
   
 ExitGame();	
   
   
   break;
 
 case 'uiButtonFooterExit':
   
 ExitGame();	
   
   
   break;
   
  
   
     
   case 'uiButtonNext':
   
   
   gameRules.ViewPage('right');
   dispatchEvent(new Event(SLOT_EVENT_PAGEINFO));	
   
   
   break;
   case 'uiButtonPrev':
   
   
   gameRules.ViewPage('left');
   dispatchEvent(new Event(SLOT_EVENT_PAGEINFO));	
   
   
   break;

   case 'uiButtonClose':
   
   
   if(slotSettings.splitScreen){
	
		
	
		
	localStorage.setItem('gameCommand', 'PageInfo_'+slotStateData.betline+'_'+slotStateData.lines+'_'+slotStateData.bet+'_'+RandomInt(0,999999));
	
	dispatchEvent(new Event(SLOT_EVENT_PAGEINFO));
		
	   
	return;	
	   }
		
	if(slotState!=SLOT_STATE_INFO){
	slotState=SLOT_STATE_INFO;	
	dispatchEvent(new Event(SLOT_EVENT_OPENINFO));		
	}else{
			
	slotState=SLOT_STATE_IDLE;	
	dispatchEvent(new Event(SLOT_EVENT_CLOSEINFO));	
	}
   
   
   
   break;

	case 'uiButtonMenuPaytable':
	
	GameResize();
		
	if(slotSettings.splitScreen){
	
		
	
		
	localStorage.setItem('gameCommand', 'PageInfo_'+slotStateData.betline+'_'+slotStateData.lines+'_'+slotStateData.bet+'_'+RandomInt(0,999999));
	
	dispatchEvent(new Event(SLOT_EVENT_PAGEINFO));
		
	   
	return;	
	   }
		
	if(slotState!=SLOT_STATE_INFO){
	slotState=SLOT_STATE_INFO;	
	dispatchEvent(new Event(SLOT_EVENT_OPENINFO));		
	}else{
			
	slotState=SLOT_STATE_IDLE;	
	dispatchEvent(new Event(SLOT_EVENT_CLOSEINFO));	
	}
	
		
	self.CloseMenu();
		
	break;
		
	case 'uiButtonMenu':
	objArr['closeAllTabs'].visible=true;	
	if(objArr['menuTab'].visible){
	self.CloseMenu();	
	}else{
	self.OpenMenu();	
	}	
	
		
	break;
	
	
	case 'closeAllTabs':
	
	if(objArr['menuTab'].visible){
	self.CloseMenu();	
	}	
	if(objArr['linesTab'].visible){
	self.CloseLinesTab();	
	}
	if(objArr['betsTab'].visible){
	self.CloseBetTab();	
	}
	
	objArr['closeAllTabs'].visible=false;	
	
	break;
	
	
	
	case 'uiButtonMax':
	
	slotSettings.BetCnt++;
	
	slotSettings.BetCnt=slotSettings.Bet.length-1;	
	
	slotStateData.betline=slotSettings.Bet[slotSettings.BetCnt];	
	slotStateData.bet=slotStateData.betline*slotStateData.lines;
	
	dispatchEvent(new Event(SLOT_EVENT_BET));
	objArr['uiButtonMax'].Disable();
		
	break;
	
	case 'uiButtonAutoStop':
	
	if(autoMode){
	
	autoMode=false;	
	dispatchEvent(new Event(SLOT_EVENT_AUTOSTOP));	
		
	}else{
	
	if(slotStateData.credit<=0 || slotStateData.credit<slotStateData.bet){
	return;	
	}
		
	autoMode=true;	
	dispatchEvent(new Event(SLOT_EVENT_AUTOSTART));		
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'uiButtonSpin'}});	
	dispatchEvent(btnEvent);	
		
		
		
	
	}
	
	
		
	break;		
	
	case 'uiButtonLines':
	
	if(objArr['linesTab'].visible){
	self.CloseLinesTab();	
	}else{
	self.OpenLinesTab();	
	}	
	
		
	break;
	
	case 'uiButtonBet':
	
	if(objArr['betsTab'].visible){
	self.CloseBetTab();	
	}else{
	self.OpenBetTab();	
	}	
	
		
	break;
	
	case 'linesTabClose':
	
	
	self.CloseLinesTab();	

		
	break;
	case 'betsTabClose':
	
	
    self.CloseBetTab();		

		
	break;
	case 'linesTabLn':
	
	slotSettings.LineCnt=parseInt(tmpName[1]);
	slotStateData.lines=slotSettings.gameLine[parseInt(tmpName[1])];
	slotStateData.bet=slotStateData.betline*slotStateData.lines;
	
	dispatchEvent(new Event(SLOT_EVENT_LINES));	
			
    self.CloseLinesTab();	
		
	break;
	case 'betsTabLn':
	

	slotSettings.BetCnt=parseInt(tmpName[1]);
	slotStateData.betline=slotSettings.Bet[parseInt(tmpName[1])];
	slotStateData.bet=slotStateData.betline*slotStateData.lines;
	
	dispatchEvent(new Event(SLOT_EVENT_LINES));	
			
    self.CloseBetTab();	
		
	break;
	
	
	case 'uiButtonFooterFullOn':
	
	fullscreenMode=true;
		
	dispatchEvent(new Event(SLOT_EVENT_UPDATEADVBUTTON));
	
	SetFullscreen();	
		
	break;	
		
	case 'uiButtonFooterFullOff':
	
	fullscreenMode=false;	
	dispatchEvent(new Event(SLOT_EVENT_UPDATEADVBUTTON));	
	
	ExitFullscreen();	
		
	break;
	
	case 'uiButtonFooterSound0':
	
	soundMode=true;	
	dispatchEvent(new Event(SLOT_EVENT_UPDATEADVBUTTON));	
	  self.SelectSoundMode(0);		
	break;	
	case 'uiButtonFooterSound1':
	
	soundMode=true;	
	dispatchEvent(new Event(SLOT_EVENT_UPDATEADVBUTTON));	
	  self.SelectSoundMode(1);		
	break;	
	case 'uiButtonFooterSound2':
	
	createjs.Sound.stop();	
		
	soundMode=false;
	dispatchEvent(new Event(SLOT_EVENT_UPDATEADVBUTTON));	
	  self.SelectSoundMode(2);		
	break;
	
	
}	
	
};

objArr['uiButtonFooterSound0'].Select(true);

this.SelectSoundMode=function(mode){
	
if(mode==0){
soundAdvancedMode=0;	
soundMode=true;	

}else if(mode==1){
soundAdvancedMode=1;	
soundMode=true;
	
}else if(mode==1){
soundAdvancedMode=0;	
soundMode=false;
	
}

objArr['uiButtonFooterSound0'].Select(false);
objArr['uiButtonFooterSound1'].Select(false);
objArr['uiButtonFooterSound2'].Select(false);
objArr['uiButtonFooterSound'+mode].Select(true);
	
	
};


this.SetGrayScale=function(){
	
var filter = new PIXI.filters.ColorMatrixFilter();
filter.greyscale(0.35,true);	
	
gameLines._view.filters=[filter];	
gameReels._view.filters=[filter];	
gameView._view.filters=[filter];	
gameRules._view.filters=[filter];	
	
	
};

this.ClearGrayScale=function(){
	
gameLines._view.filters=null;	
gameReels._view.filters=null;		
gameView._view.filters=null;	
gameRules._view.filters=null;	
	
};

this.OpenLinesTab=function(){
	
var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);		

linesTabPages=1;
	
self.SetGrayScale();	
	
objArr['closeAllTabs'].visible=true;

for(var i=0; i<slotSettings.gameLine.length; i++){

objArr['linesTabLn_'+i].Enable();
objArr['linesTabLn_'+i]._view.visible=false;
if(slotStateData.lines==slotSettings.gameLine[i]){
	
objArr['linesTabLn_'+i].Disable();
	
}

if(i>=(linesTabPages-1)*25 && i<=((linesTabPages)*25)-1){
objArr['linesTabLn_'+i]._view.visible=true;	
}

}
	
objArr['linesTab'].visible=true;	
objArr['linesTabClose'].Enable();


objArr['linesTabNext'].Enable();
objArr['linesTabPrev'].Disable();
	
objArr['linesTabLabel0'].text='TOTAL BET '+slotStateData.bet;

objArr['linesTabLabel1'].text='(BET/LINE '+slotStateData.betline+')';		


	var pgp=((linesTabPages-2)*25+1);
	var pgp2=((linesTabPages-1)*25);
	
	if(pgp<0){
		pgp=1;
	}
	if(pgp2<=0){
		pgp2=25;
	}

objArr['linesTabPg0'].text=pgp+'-'+pgp2;
objArr['linesTabPg1'].text=(linesTabPages*25+1)+'-'+((linesTabPages+1)*25);
	
	
};

this.CloseBetTab=function(){

self.ClearGrayScale();	

objArr['closeAllTabs'].visible=false;
	
objArr['betsTab'].visible=false;	
	
};


this.LinesTabSlidePage=function(dir){
	
if(dir=='next'){
	
linesTabPages++;	
	
}else{
	
linesTabPages--;
	
	
}	

if(linesTabPages<=1){

linesTabPages=1;	


objArr['linesTabNext'].Enable();
objArr['linesTabPrev'].Disable();

}

if(linesTabPages>=Math.ceil(slotSettings.gameLine.length/25)){
linesTabPages=Math.ceil(slotSettings.gameLine.length/25);	

objArr['linesTabNext'].Disable();
objArr['linesTabPrev'].Enable();

}	
	
for(var i=0; i<slotSettings.gameLine.length; i++){

objArr['linesTabLn_'+i].Enable();

objArr['linesTabLn_'+i]._view.visible=false;

if(slotStateData.lines==slotSettings.gameLine[i]){
	
objArr['linesTabLn_'+i].Disable();
	
}

if(i>=(linesTabPages-1)*25 && i<=((linesTabPages)*25)-1){
objArr['linesTabLn_'+i]._view.visible=true;	
}


}
	
	var pgp=((linesTabPages-2)*25+1);
	var pgp2=((linesTabPages-1)*25);
	
	if(pgp<0){
		pgp=1;
	}
	if(pgp2<=0){
		pgp2=25;
	}

objArr['linesTabPg0'].text=pgp+'-'+pgp2;
objArr['linesTabPg1'].text=(linesTabPages*25+1)+'-'+((linesTabPages+1)*25);
		
	
};




this.BetTabSlidePage=function(dir){
	
if(dir=='next'){
	
betsTabPages++;	
	
}else{
	
betsTabPages--;
	
	
}	

if(betsTabPages<=1){

betsTabPages=1;	


objArr['betsTabNext'].Enable();
objArr['betsTabPrev'].Disable();

}

if(betsTabPages>=Math.ceil(slotSettings.Bet.length/25)){
betsTabPages=Math.ceil(slotSettings.Bet.length/25);	

objArr['betsTabNext'].Disable();
objArr['betsTabPrev'].Enable();

}	
	
for(var i=0; i<slotSettings.Bet.length; i++){

objArr['betsTabLn_'+i].Enable();

objArr['betsTabLn_'+i]._view.visible=false;

if(slotStateData.betline==slotSettings.Bet[i]){
	
objArr['betsTabLn_'+i].Disable();
	
}

if(i>=(betsTabPages-1)*25 && i<=((betsTabPages)*25)-1){
objArr['betsTabLn_'+i]._view.visible=true;	
}


}
	
	var pgp=((betsTabPages-2)*25+1);
	var pgp2=((betsTabPages-1)*25);
	
	if(pgp<0){
		pgp=1;
	}
	if(pgp2<=0){
		pgp2=25;
	}

objArr['betsTabPg0'].text=pgp+'-'+pgp2;
objArr['betsTabPg1'].text=(betsTabPages*25+1)+'-'+((betsTabPages+1)*25);
		
	
};

this.OpenBetTab=function(){
	
var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);		

betsTabPages=1;

	
self.SetGrayScale();	
	
objArr['closeAllTabs'].visible=true;

for(var i=0; i<slotSettings.Bet.length; i++){

objArr['betsTabLn_'+i].Enable();

objArr['betsTabLn_'+i]._view.visible=false;

if(slotStateData.betline==slotSettings.Bet[i]){
	
objArr['betsTabLn_'+i].Disable();
	
}

if(i>=(betsTabPages-1)*25 && i<=((betsTabPages)*25)-1){
objArr['betsTabLn_'+i]._view.visible=true;	
}


}
	
	
objArr['betsTabNext'].Enable();
objArr['betsTabPrev'].Disable();	
	
objArr['betsTab'].visible=true;	
objArr['betsTabClose'].Enable();
	
objArr['betsTabLabel0'].text='TOTAL BET '+slotStateData.bet;

objArr['betsTabLabel1'].text='(BET/LINE '+slotStateData.betline+')';	


	var pgp=((betsTabPages-2)*25+1);
	var pgp2=((betsTabPages-1)*25);
	
	if(pgp<0){
		pgp=1;
	}
	if(pgp2<=0){
		pgp2=25;
	}

objArr['betsTabPg0'].text=pgp+'-'+pgp2;
objArr['betsTabPg1'].text=(betsTabPages*25+1)+'-'+((betsTabPages+1)*25);

	
	
};

this.CloseLinesTab=function(){
self.ClearGrayScale();
objArr['closeAllTabs'].visible=false;

	
objArr['linesTab'].visible=false;	
	
};
this.OpenMenu=function(){
var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);
self.SetGrayScale();

objArr['uiButtonMenuPaytable'].Enable();
objArr['uiButtonMenuDeposit'].Enable();
objArr['uiButtonMenuSettings'].Enable();
objArr['uiButtonMenuHelp'].Enable();
objArr['uiButtonMenuExit'].Enable();
	
objArr['menuTab'].visible=true;	
	
	if(slotState==SLOT_STATE_WINNING || slotState==SLOT_STATE_AFTERWIN || slotState==SLOT_STATE_GAMBLE){
	
	objArr['uiButtonMenuPaytable'].Disable();	
	objArr['uiButtonMenuExit'].Disable();	
		
	}	



	
	
};

this.CloseMenu=function(){
	
self.ClearGrayScale();

objArr['closeAllTabs'].visible=false;
	
objArr['menuTab'].visible=false;	
	
};

this.DisableButtons=function(){

for(b in objArr){

	if(objArr[b].Disable!=undefined){
    objArr[b].Disable();

	if(objArr[b].Blink!=undefined){
    objArr[b].Blink(false);
	}

	}

	}

	if(autoMode){


	objArr['uiButtonAuto'].Enable();
	}

self.UpdateAdvancedButtons();

};

/*

активация кнопок в зависимости от

*/

this.UpdateButtons=function(){

for (var vl of slotSettings.hideButtons) {




	objArr[vl].isBlock=true;
	objArr[vl].Disable();





}


for (var vl of slotSettings.gameLine) {



	if(slotSettings.Line.indexOf(""+vl)==-1){



	if(objArr['uiButtonLine'+vl]!=undefined){
	objArr['uiButtonLine'+vl].isBlock=true;
	objArr['uiButtonLine'+vl].Disable();

	}

    }

}

for (var i=1; i<=10;i++) {



	if(slotSettings.gameLine.indexOf(""+i)==-1){



	if(objArr['uiButtonLine'+i]!=undefined){

	objArr['uiButtonLine'+i].isBlock=true;
	objArr['uiButtonLine'+i].Disable();

	}

    }

}



	if(bonusMode){

	self.DisableButtons();
	return;
	}


switch(slotState){

	case SLOT_STATE_IDLE :

if(!autoMode){

	for(b in objArr){

	if(objArr[b].Disable!=undefined){
    objArr[b].Disable();

	if(objArr[b].Blink!=undefined){
    objArr[b].Blink(false);
	}

	}

	}



objArr['uiButtonCollect'].ShowBlink(true);
objArr['uiButtonSpin'].ShowBlink(true);

	objArr['uiButtonAuto'].Enable();
    objArr['uiButtonSpin'].Enable();
    objArr['uiButtonSpin'].Enable();
    objArr['uiButtonMenu'].Enable();
    objArr['uiButtonLines'].Enable();
    objArr['uiButtonBet'].Enable();
    objArr['uiButtonMax'].Enable();
    
    objArr['uiButtonBetPlus'].Enable();
    objArr['uiButtonBetMinus'].Enable();


    objArr['uiButtonCollect']._view.visible=false;
    objArr['uiButtonSkip']._view.visible=false;
    objArr['uiButtonAutoStop']._view.visible=false;
    objArr['uiButtonGamble']._view.visible=false;
    objArr['uiButtonBet']._view.visible=true;


    objArr['uiButtonSpin']._view.visible=true;

	

	if(slotSettings.BetCnt==0){
	objArr['uiButtonBetMinus'].Disable();
	objArr['uiButtonBetMinus'].BorderHide();
	}
	
	if(slotSettings.BetCnt==slotSettings.Bet.length-1){
	objArr['uiButtonBetPlus'].Disable();
	objArr['uiButtonBetPlus'].BorderHide();
	objArr['uiButtonMax'].Disable();
	}

}

	break;

	case 'INFO' :

if(slotSettings.BetCnt==0){
	objArr['uiButtonBetMinus'].Disable();
	}
	if(slotSettings.BetCnt==slotSettings.Bet.length-1){
	objArr['uiButtonBetPlus'].Disable();
	}
objArr['uiButtonSpin'].ShowBlink(false);
	break;

	case SLOT_STATE_SPIN :

	for(b in objArr){

	if(objArr[b].Disable!=undefined){
    objArr[b].Disable();

	if(objArr[b].Blink!=undefined){
    objArr[b].Blink(false);
	}

	}

	}
	
	if(slotSettings.slotFastStop==1){
	objArr['uiButtonSpin']._view.visible=false;
	objArr['uiButtonSkip'].Enable();
	objArr['uiButtonSkip']._view.visible=true;
	}
	
	objArr['uiButtonCollect'].Disable();
	objArr['uiButtonCollect']._view.visible=false;

	break;




	case SLOT_STATE_WINNING :

	for(b in objArr){

	if(objArr[b].Disable!=undefined){
    objArr[b].Disable();

	if(objArr[b].Blink!=undefined){
    objArr[b].Blink(false);
	}

	}

	}




objArr['uiButtonMenuDeposit'].Enable();
objArr['uiButtonMenuSettings'].Enable();
objArr['uiButtonMenuHelp'].Enable();


	
	
		
		
		
	objArr['uiButtonSkip'].Disable();
	objArr['uiButtonSkip']._view.visible=false;

	objArr['uiButtonCollect'].Enable();
	objArr['uiButtonCollect']._view.visible=true;
	
	if(!autoMode){
	if(slotSpinResult.bonusInfo.scattersType!="bonus"){	
	
    }	
	objArr['uiButtonMenu'].Enable();
	if(slotSpinResult.bonusInfo.scattersType!="bonus"){
	objArr['uiButtonGamble']._view.visible=true;
	objArr['uiButtonBet']._view.visible=false;
    }
	
	objArr['uiButtonGamble'].Enable();
	objArr['uiButtonGamble'].ShowBlink(true);


	
	
}



	break;

	case SLOT_STATE_AFTERWIN :

	for(b in objArr){

	if(objArr[b].Disable!=undefined){
    objArr[b].Disable();

	if(objArr[b].Blink!=undefined){
    objArr[b].Blink(false);
	}

	}

	}

objArr['uiButtonMenuDeposit'].Enable();
objArr['uiButtonMenuSettings'].Enable();
objArr['uiButtonMenuHelp'].Enable();



	objArr['uiButtonSkip']._view.visible=false;

    objArr['uiButtonMenu'].Enable();
	objArr['uiButtonSpin'].Enable();
	objArr['uiButtonSpin']._view.visible=false;
	if(slotSettings.slotGamble){
	
	if(!autoMode ){
		
	if(slotSpinResult.bonusInfo.scattersType!="bonus"){	
	objArr['uiButtonAuto'].Enable();
    }

	if(slotSpinResult.bonusInfo.scattersType!="bonus"){
	objArr['uiButtonGamble']._view.visible=true;
	objArr['uiButtonBet']._view.visible=false;
    }
	objArr['uiButtonGamble'].Enable();
	objArr['uiButtonGamble'].ShowBlink(true);
}else{
objArr['uiButtonGamble'].Disable();	
}

	}
	

	
	objArr['uiButtonCollect'].Enable();
	objArr['uiButtonCollect']._view.visible=true;



	break;

		case SLOT_STATE_GAMBLE :

	for(b in objArr){

	if(objArr[b].Disable!=undefined){
    objArr[b].Disable();

	if(objArr[b].Blink!=undefined){
    objArr[b].Blink(false);
	}

	}

	}


    objArr['uiButtonMenu'].Enable();
	objArr['uiButtonMenu']._view.visible=true;


	objArr['uiButtonCollect'].Enable();
	objArr['uiButtonCollect']._view.visible=true;



	break;

}


	if(autoMode){

	for(b in objArr){

	if(objArr[b].Disable!=undefined){
    objArr[b].Disable();

	if(objArr[b].Blink!=undefined){
    objArr[b].Blink(false);
	}

	}

	}
		
	
	 

	
	   
	 objArr['uiButtonSpin']._view.visible=false;
	 objArr['uiButtonCollect']._view.visible=false;
    objArr['uiButtonSkip']._view.visible=false;
    
    
    	
	if(slotState==SLOT_STATE_WINNING){
	 
   
	
	if(slotSpinResult.bonusInfo.scattersType=="bonus"){
		
	objArr['uiButtonSkip'].Disable();
	objArr['uiButtonSkip']._view.visible=false;	
	
	objArr['uiButtonCollect'].Disable();
	objArr['uiButtonCollect']._view.visible=false;
	
	objArr['uiButtonSpin'].Disable();
	objArr['uiButtonSpin']._view.visible=true;
	objArr['uiButtonSpin'].ShowBlink(false);
		
	}else{
	objArr['uiButtonSkip'].Disable();
	objArr['uiButtonSkip']._view.visible=false;
	objArr['uiButtonCollect'].Enable();
	objArr['uiButtonCollect']._view.visible=true;
}   
	   
	   
	   }else{
		  
	objArr['uiButtonSkip'].Enable();
	objArr['uiButtonSkip']._view.visible=true; 
		   
	   }

	objArr['uiButtonAutoStop'].Enable();
	objArr['uiButtonAutoStop']._view.visible=true; 
	objArr['uiButtonAuto']._view.visible=false; 
	
	}



self.UpdateAdvancedButtons();


if(slotSettings.gameLine.length<=1){
objArr['uiButtonLines'].Disable();	
}

};



this.UpdateAdvancedButtons=function(){

/*дополнительные кнопки*/



	
	objArr['uiButtonFooterExit'].Enable();
	objArr['uiButtonFooterSound0'].Enable();
	objArr['uiButtonFooterSound1'].Enable();
	objArr['uiButtonFooterSound2'].Enable();


	if(fullscreenMode){

	objArr['uiButtonFooterFullOff']._view.visible=true;
	objArr['uiButtonFooterFullOff'].Enable();

	objArr['uiButtonFooterFullOn']._view.visible=false;
	objArr['uiButtonFooterFullOn'].Disable();

	}else{
	objArr['uiButtonFooterFullOff']._view.visible=false;
	objArr['uiButtonFooterFullOff'].Disable();
	objArr['uiButtonFooterFullOn']._view.visible=true;
	objArr['uiButtonFooterFullOn'].Enable();

	}

};

this.GetObject=function(){

return objArr;
};

	/*подписываемся на необходимые события*/

addEventListener(SLOT_EVENT_FASTSTOP,function(){self.DisableButtons();});
addEventListener(SLOT_EVENT_LONGSTOP,function(){self.DisableButtons();});
addEventListener(SLOT_EVENT_AFTERSPIN,function(){
	
	self.DisableButtons();
	
	if(!autoMode){
	objArr['uiButtonSkip']._view.visible=false;
    }
	
	});

addEventListener(SLOT_EVENT_OPENINFO,function(){
	
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);	
	
	objArr['uiButtonNext']._view.visible=true;
	objArr['uiButtonNext'].Enable();
		
	objArr['uiButtonPrev']._view.visible=true;
	objArr['uiButtonPrev'].Enable();
		
	objArr['uiButtonClose']._view.visible=true;
	objArr['uiButtonClose'].Enable();
	
	objArr['infoTab'].visible=false;
	
	objArr['uiButtonSpin'].ShowBlink(false);
	
	});
	
addEventListener(SLOT_EVENT_CLOSEINFO,function(){
	
	
	objArr['uiButtonNext']._view.visible=false;
	objArr['uiButtonNext'].Enable();
		
	objArr['uiButtonPrev']._view.visible=false;
	objArr['uiButtonPrev'].Enable();
		
	objArr['uiButtonClose']._view.visible=false;
	objArr['uiButtonClose'].Enable();
	objArr['infoTab'].visible=true;
	
	objArr['uiButtonSpin'].ShowBlink(true);
	
	});

addEventListener(SLOT_EVENT_GAMBLERED,function(){self.DisableButtons();});

addEventListener(SLOT_EVENT_AUTOSTOP,function(){
	
	objArr['uiButtonAutoStop']._view.visible=false; 
	objArr['uiButtonAuto']._view.visible=true; 
	
	self.DisableButtons();
	
	});
	
	
addEventListener(SLOT_EVENT_AUTOSTART,function(){
	
	self.DisableButtons();
	
	});
	
	
addEventListener(SLOT_EVENT_GAMBLEBLACK,function(){self.DisableButtons();});
addEventListener(SLOT_EVENT_GAMBLECHOICE,function(){self.DisableButtons();});

addEventListener(SLOT_EVENT_GAMBLEDEALER,function(){

	self.DisableButtons();


});


addEventListener(SLOT_EVENT_UPDATEADVBUTTON,function(){self.UpdateAdvancedButtons();});

addEventListener(SLOT_EVENT_FIRSTSPINBONUS,function(){});

addEventListener(SLOT_EVENT_START,function(){self.UpdateButtons();});
addEventListener(SLOT_EVENT_GAMBLESTART,function(){

	self.UpdateButtons();
		objArr['uiButtonBet']._view.visible=true;
	objArr['uiButtonSpin'].Enable();

	objArr['uiButtonGamble'].Disable();
	objArr['uiButtonGamble']._view.visible=false;
	
	
	
	
												  });
addEventListener(SLOT_EVENT_GAMBLERESET,function(){

	self.UpdateButtons();

	objArr['uiButtonSpin'].Enable();

	objArr['uiButtonGamble'].Disable();
	objArr['uiButtonGamble']._view.visible=false;
	objArr['uiButtonBet']._view.visible=true;



												  });
addEventListener(SLOT_EVENT_BET,function(){
	
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);	
	self.UpdateButtons();
	
	
	});
addEventListener(SLOT_EVENT_LINES,function(){
	var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);	
	self.UpdateButtons();
	
	
	});
addEventListener(SLOT_EVENT_STARTSPIN,function(){
	
var btnEvent=new CustomEvent("ui_btn",{detail:{bname:'closeAllTabs'}});
dispatchEvent(btnEvent);		
	
	self.UpdateButtons();
	
	
	});



addEventListener(SLOT_EVENT_ENDWINLINE,function(ev){
skipCollect=false;	
self.UpdateButtons();

});


addEventListener(SLOT_EVENT_WINSCATTERS	,function(ev){


});


addEventListener(SLOT_EVENT_JACKPOTSHOW	,function(ev){
self.DisableButtons();	
skipCollect=true;
objArr['uiButtonSkip']._view.visible=true;
objArr['uiButtonSkip'].Enable();	
	
	
});
	
addEventListener(SLOT_EVENT_JACKPOTHIDE	,function(ev){

skipCollect=false;	
objArr['uiButtonSkip']._view.visible=false;
objArr['uiButtonSkip'].Enable();	

	
});		
	
	
addEventListener('COLLECT_SKIP',function(ev){
skipCollect=false;	



});	
	
addEventListener(SLOT_EVENT_AFTERADDWIN,function(ev){
slotState=SLOT_STATE_IDLE ;
self.UpdateButtons();
skipCollect=false;	
	
if(autoMode){
objArr['uiButtonSkip']._view.visible=true;
objArr['uiButtonSkip'].Enable();	
}	


});


addEventListener(SLOT_EVENT_STARTADDWIN,function(ev){


for(b in objArr){

	if(objArr[b].Disable!=undefined){
    objArr[b].Disable();

	if(objArr[b].Blink!=undefined){
        objArr[b].Blink(false);
	}

	}

	}
skipCollect=true;

if(autoMode){
objArr['uiButtonSkip']._view.visible=true;
objArr['uiButtonSkip'].Enable();	
}
objArr['uiButtonBet']._view.visible=true;
objArr['uiButtonBet'].Disable();
objArr['uiButtonGamble']._view.visible=false;


});





addEventListener(SLOT_EVENT_FIRSTSPINBONUS,function(ev){


objArr['uiButtonSpin'].ShowBlink(false);	



});

addEventListener(SLOT_EVENT_STARTBONUS,function(ev){
autoMode=false;




slotState=SLOT_STATE_WAITBONUS ;
self.DisableButtons();

objArr['uiButtonCollect']._view.visible=false;
objArr['uiButtonSkip']._view.visible=false;
objArr['uiButtonGamble']._view.visible=false;

objArr['uiButtonBet']._view.visible=true;
objArr['uiButtonAuto']._view.visible=true;
objArr['uiButtonAutoStop']._view.visible=false;
objArr['uiButtonSpin']._view.visible=true;

objArr['uiButtonSpin'].Enable();
objArr['uiButtonAuto'].Disable();

objArr['uiButtonSpin'].ShowBlink(true);

});
addEventListener(SLOT_EVENT_ENDBONUS,function(ev){


objArr['uiButtonSkip']._view.visible=false;
slotStateData.bonusState='BonusEnd';

objArr['uiButtonAutoStop']._view.visible=false;




});

addEventListener("ui_btn",self.ButtonsController);	


	/*события нажатия клавиш*/
window.addEventListener("keydown",self.KeyDown);
 window.addEventListener("keyup",self.ResetKey);


return this;

}
