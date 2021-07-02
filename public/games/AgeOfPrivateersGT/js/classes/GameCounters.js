

/////////////UI class////////////////////

function GameCounters(viewContainer,setObj){

/*класс отображение счётчиков*/	
	
this._view=new PIXI.Container();
var self=this;	
var objArr=new Array();	


for(objId in setObj){	

var cObj=setObj[objId];	



if(cObj.type=="text_g"){


var style = new PIXI.TextStyle({
    fontFamily: cObj.fontText.split("px")[1],
    fontSize: parseInt(cObj.fontText.split("px")[0]),
    fontWeight: 'bold',
    fill: ["#FF9C07","#F1E430"], // gradient
    stroke: '#FFFFFF',
    strokeThickness: 0,
	align: cObj.alignText,
    dropShadow: true,
    dropShadowColor: '#000000',
    dropShadowBlur: 3,
    dropShadowAngle: 110,
    dropShadowDistance: 1,
    wordWrap: false,
    wordWrapWidth: 440
});



objArr[objId]=new PIXI.Text(cObj.defaultText, style);


if(cObj.alignText=="center"){
objArr[objId].anchor.set(0.5, 0);
}else if(cObj.alignText=="left"){
objArr[objId].anchor.set(0, 0);
}else if(cObj.alignText=="right"){
objArr[objId].anchor.set(1, 0);
}




this._view.addChild(objArr[objId]);

objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;

objArr[objId].scale.x=0.5;
objArr[objId].scale.y=0.5;



}else if(cObj.type=="text_c"){



if(objId=="counterLinesCnt"){


objArr[objId] = new PIXI.extras.BitmapText('1111', { font: "liq_blue", align: 'right' });
this._view.addChild(objArr[objId]);
objArr[objId].anchor.set(1, 0);
objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;
objArr[objId].skew.x=-0.2;

objArr[objId].scale.x=0.5;
objArr[objId].scale.y=0.5;

}else{


objArr[objId] = new PIXI.extras.BitmapText('1111', { font: cObj.fontText, align: 'right' });
this._view.addChild(objArr[objId]);
objArr[objId].anchor.set(1, 0);
objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;
objArr[objId].skew.x=-0.2;

}

}else if(cObj.type=="text"){


var style = new PIXI.TextStyle({
    fontFamily: cObj.fontText.split("px")[1],
    fontSize: parseInt(cObj.fontText.split("px")[0]),
                fontWeight: 'normal',
    fill: [cObj.colorText], // gradient
    stroke: '#000000',
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



if(cObj.alignText=="center"){
objArr[objId].anchor.set(0.5, 0);
}else if(cObj.alignText=="left"){
objArr[objId].anchor.set(0, 0);
}else if(cObj.alignText=="right"){
objArr[objId].anchor.set(1, 0.1);
}




this._view.addChild(objArr[objId]);

objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;

objArr[objId].scale.x=0.5;
objArr[objId].scale.y=0.5;

}else if(cObj.type=="text_0"){

var style = new PIXI.TextStyle({
    fontFamily: cObj.fontText.split("px")[1],
    fontSize: parseInt(cObj.fontText.split("px")[0]),
    fontWeight: 'normal',
    fill: [cObj.colorText], // gradient
    stroke: '#000000',
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

if(cObj.alignText=="center"){
objArr[objId].anchor.set(0.5, 0);
}else if(cObj.alignText=="left"){
objArr[objId].anchor.set(0, 0);
}else if(cObj.alignText=="right"){
objArr[objId].anchor.set(1, 0.1);
}

this._view.addChild(objArr[objId]);

objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;

objArr[objId].scale.x=0.5;
objArr[objId].scale.y=0.5;

}else if(cObj.type=="text_grad"){

var style = new PIXI.TextStyle({
    fontFamily: cObj.fontText.split("px")[1],
    fontSize: parseInt(cObj.fontText.split("px")[0]),
    fontWeight: 'bold',
    fill: cObj.colorText, // gradient
    stroke: '#000000',
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

if(cObj.alignText=="center"){
objArr[objId].anchor.set(0.5, 0);
}else if(cObj.alignText=="left"){
objArr[objId].anchor.set(0, 0);
}else if(cObj.alignText=="right"){
objArr[objId].anchor.set(1, 0.1);
}

this._view.addChild(objArr[objId]);

objArr[objId].x=cObj.x;
objArr[objId].y=cObj.y;

objArr[objId].scale.x=0.5;
objArr[objId].scale.y=0.5;

}

}

objArr['counterExit'].text=slotLanguage['uiButtonExit'];
objArr['counterInfo1'].text=slotLanguage['counterInfo1GameOver'];
objArr['counterInfo2'].text='';


objArr['counterAnimBlock']=new PIXI.Container();




self._view.removeChild(objArr['counterCreditCnt']);
self._view.removeChild(objArr['counterInfo2']);
self._view.removeChild(objArr['counterInfo3']);




objArr['counterAnimBlock'].addChild(objArr['counterCreditCnt']);
objArr['counterAnimBlock'].addChild(objArr['counterInfo2']);
objArr['counterAnimBlock'].addChild(objArr['counterInfo3']);


self._view.addChild(objArr['counterAnimBlock']);
objArr['counterAnimBlock'].x=1030;
objArr['counterAnimBlock'].y=915;

/*----time-----*/
var date=new Date();
	var dH=date.getHours();
	var dM=date.getMinutes();
	
	if(dM<=9){
	dM='0'+dM;	
	}
	if(dH<=9){
	dH='0'+dH;	
	}
	objArr['counterTime'].text=dH+':'+dM;
setInterval(function(){
		
		var dH=date.getHours();
	var dM=date.getMinutes();
	
	if(dM<=9){
	dM='0'+dM;	
	}
	if(dH<=9){
	dH='0'+dH;	
	}
	objArr['counterTime'].text=dH+':'+dM;
		
		},10000);

viewContainer.addChild(this._view);	
	
/*обновление счётчиков*/

this.AnimWin=function(){

var scl=1;

if(objArr['counterAnimBlock'].scale.x!=1){
scl=objArr['counterAnimBlock'].scale.x;	
}

var sclInc=0.01;
var trg=true;
clearInterval(slotStateData.aInter);
slotStateData.aInter=setInterval(function(){

if(trg ){
scl+=sclInc;

}else{

scl-=sclInc;
}

sclInc=sclInc*1.3;

if(trg && scl>=1.2){
trg=false;
sclInc=0.01;
}

if(!trg && scl<=1){
trg=false;
sclInc=0.01;
scl=1;
clearInterval(slotStateData.aInter);	
}

objArr['counterAnimBlock'].scale.set(scl,scl);

},26);

};

this.UpdateCounters=function(){
	
	
if(bonusMode){
return;	
}	
	

	
objArr['counterCreditCnt'].text=slotLanguage['counterCredit']+' '+NumFormat(slotStateData.credit);	
objArr['counterBetCnt'].text=NumFormat(slotStateData.bet);	

objArr['counterLinesCnt'].text=slotStateData.lines;	
objArr['counterJack0'].text=slotSettings.slotJackpot;

TextFormat(objArr['counterCreditCnt'],30);
TextFormat(objArr['counterBetCnt'],4);


/*
objArr['counterJackpot1'].text=""+slotSettings.Jackpots['jack1'];
objArr['counterJackpot2'].text=""+slotSettings.Jackpots['jack2'];
objArr['counterJackpot3'].text=""+slotSettings.Jackpots['jack3'];
*/
}


/*вызывается по событию, при отображении выигрыша по скеттерам */



this.ShowWinScatters=function(ev){
objArr['counterInfo1'].text='';
if(slotStateData.totalWin>0){
objArr['counterInfo2'].text=slotLanguage['counterInfo2Won']+" "+NumFormat(slotStateData.totalWin);

if(bonusMode){
	objArr['counterInfo1'].text="";
	objArr['counterInfo2'].text="";
	objArr['counterInfo3'].text=slotLanguage['counterInfo2FreeWin']+" "+NumFormat(slotStateData.totalWin);
	objArr['counterInfo4'].text=slotLanguage['counterInfo2Free']+(slotSpinResult.currentFreeGames)+slotLanguage['counterInfo2Free2']+ slotSpinResult.totalFreeGames;
	}
}
};

/*вызывается по событию, при отображении выигрышной линии */

this.ShowWinLineWait=function(ev){

};	

this.ShowWinLine=function(ev){

objArr['counterInfo1'].text='';
objArr['counterInfo2'].text=slotLanguage['counterInfo2Won']+" "+NumFormat(ev.detail.stepwin);

if(bonusMode){
	objArr['counterInfo1'].text="";
	objArr['counterInfo2'].text="";
	objArr['counterInfo3'].text=slotLanguage['counterInfo2FreeWin']+" "+NumFormat(ev.detail.stepwin);
    objArr['counterInfo4'].text=slotLanguage['counterInfo2Free']+(slotSpinResult.currentFreeGames)+slotLanguage['counterInfo2Free2']+ slotSpinResult.totalFreeGames;	
	}
};

/*вызывается по событию, при "сливе" выигрыша */

this.ShowAddWin=function(ev){

objArr['counterInfo1'].text=" ";	
objArr['counterInfo2'].text=slotLanguage['counterInfo2Won']+" "+NumFormat(slotStateData.totalWin);
objArr['counterCreditCnt'].text=slotLanguage['counterCredit']+' '+NumFormat(slotStateData.credit);	

}

/*вызывается по событию, после "слива" выигрыша*/

this.ShowSkipWin=function(ev){

objArr['counterCreditCnt'].text=slotLanguage['counterCredit']+' '+NumFormat(slotStateData.credit);

objArr['counterInfo1'].text=" ";
objArr['counterInfo2'].text=slotLanguage['counterInfo2Won']+" "+NumFormat(slotStateData.totalWin);

}

this.ShowAfterAddWin=function(ev){

if(bonusMode){
return;
}

objArr['counterCreditCnt'].text=slotLanguage['counterCredit']+' '+NumFormat(slotStateData.credit);	

objArr['counterInfo1'].text=" ";
objArr['counterInfo2'].text=slotLanguage['counterInfo2Paid']+" "+NumFormat(slotStateData.oldWin);			

}

/*вызывается по событию, после отображения выигрышей*/

this.dbg=function(){

return objArr;	
};

this.ShowWinPaid=function(ev){

if(bonusMode || slotStateData.bonusState=='BonusEnd'){
return;	
}

objArr['counterInfo1'].text=" ";
objArr['counterInfo2'].text=slotLanguage['counterInfo2Won']+" "+NumFormat(slotStateData.totalWin);		
	
}

/*подписываемся на необходимые события*/

addEventListener(SLOT_EVENT_START,function(){self.UpdateCounters();	});
addEventListener(SLOT_EVENT_UPDATE,function(){self.UpdateCounters();});
addEventListener(SLOT_EVENT_BET,function(){self.UpdateCounters();});
addEventListener(SLOT_EVENT_LINES,function(){self.UpdateCounters();});
addEventListener(SLOT_EVENT_RESULTSPIN,function(){self.UpdateCounters();});
addEventListener(SLOT_EVENT_STARTSPIN,function(){
objArr['counterInfo2'].text=" ";
self.UpdateCounters();

		objArr['counterInfo1'].text=slotLanguage['counterInfo1Spin'];

	if(bonusMode){

	objArr['counterInfo1'].text="";
	objArr['counterInfo2'].text="";
    objArr['counterInfo4'].text=slotLanguage['counterInfo2Free']+(slotSpinResult.currentFreeGames+1)+slotLanguage['counterInfo2Free2']+ slotSpinResult.totalFreeGames;
    objArr['counterInfo3'].text=slotLanguage['counterInfo2FreeWin']+" "+NumFormat(slotStateData.totalWin);

	}else{
	
	objArr['counterInfo3'].text="";
	objArr['counterInfo4'].text="";
	}

	});

addEventListener(SLOT_EVENT_OPENINFO,function(){

objArr['counterInfo1'].visible=false;
objArr['counterInfo2'].visible=false;

objArr['counterCreditCnt'].visible=false;

	});

addEventListener(SLOT_EVENT_CLOSEINFO,function(){

objArr['counterInfo1'].visible=true;
objArr['counterInfo2'].visible=true;

objArr['counterCreditCnt'].visible=true;

	});

addEventListener(SLOT_EVENT_WINSCATTERS,function(ev){self.ShowWinScatters(ev);});
addEventListener(SLOT_EVENT_SKIPWIN,function(ev){self.ShowSkipWin(ev);});

addEventListener(SLOT_EVENT_WINLINE,function(ev){self.ShowWinLine(ev);});
addEventListener(SLOT_EVENT_WINLINE_WAIT,function(ev){self.ShowWinLineWait(ev);});


addEventListener(SLOT_EVENT_ENDWINLINE,function(ev){

	if(bonusMode){
		self.AnimWin();
	}

	self.ShowWinPaid(ev);
	if(!autoMode && !bonusMode){
	objArr['counterBetCnt'].visible=false;
	
	}
	});

addEventListener(SLOT_EVENT_ADDWIN,function(ev){self.ShowAddWin();});
addEventListener(SLOT_EVENT_AFTERADDWIN,function(ev){

	objArr['counterBetCnt'].visible=true;
	if(slotSpinResult.totalWin>0){
	self.ShowAfterAddWin();
	self.AnimWin();
	}

	});
	
addEventListener(SLOT_EVENT_STARTADDWIN,function(ev){
	
	objArr['counterBetCnt'].visible=true;
	slotStateData.bonusState='';
	objArr['counterInfo3'].text="";
	objArr['counterInfo4'].text="";

	});

addEventListener(SLOT_EVENT_EMPTYSPIN,function(ev){
	
	objArr['counterInfo2'].text="";

	if(!autoMode){
	objArr['counterInfo1'].text=slotLanguage['counterInfo1GameOver'];

	}
	});

addEventListener(SLOT_EVENT_STARTBONUS,function(ev){

	objArr['counterInfo2'].text='';
	objArr['counterInfo1'].text=slotLanguage['counterInfo2StartBonus'];

	});

addEventListener(SLOT_EVENT_AFTERSPIN,function(ev){

	if((slotSpinResult.winLines.length>0 ||  slotSpinResult.bonusInfo.scattersType=="win") && slotSpinResult.bonusInfo.scattersType!="bonus" && !autoMode && !bonusMode){

	objArr['counterBetCnt'].visible=false;

	}

	});

addEventListener(SLOT_EVENT_WINSCATTERS	,function(ev){

	});

addEventListener(SLOT_EVENT_ENDBONUS,function(ev){

	setTimeout(function(){
	objArr['counterInfo1'].text="";
	objArr['counterInfo2'].text="";
    objArr['counterInfo4'].text=slotSpinResult.totalFreeGames+slotLanguage['counterBonusFreeEndPlayed'];

	},100);

	});

addEventListener(SLOT_EVENT_AUTOSTOP,function(ev){});
addEventListener(SLOT_EVENT_AUTOSTART,function(ev){});
addEventListener(SLOT_EVENT_JACKPOTADD,function(ev){objArr['counterCreditCnt'].text=slotLanguage['counterCredit']+' '+NumFormat(slotStateData.credit);	

	});

addEventListener(SLOT_EVENT_GAMBLERESET,function(ev){

	objArr['counterInfo1'].text=" ";
	objArr['counterInfo2'].text=slotLanguage['counterInfo2Won']+" "+NumFormat(slotStateData.totalWin);

	});

addEventListener(SLOT_EVENT_GAMBLESTART,function(ev){
	
	objArr['counterInfo3'].text="";
	objArr['counterInfo4'].text="";

	objArr['counterInfo1'].text=" ";
	objArr['counterBetCnt'].visible=true;
	objArr['counterInfo2'].text=slotLanguage['counterInfo2Won']+" "+NumFormat(slotStateData.totalWin);

	});

addEventListener(SLOT_EVENT_GAMBLELOSE,function(ev){

objArr['counterInfo2'].text=" ";
objArr['counterInfo1'].text=slotLanguage['counterInfo1GameOver'];

	});

addEventListener('button_enable',function(ev){

if(ev.detail.bname=='uiButtonBet'){
objArr['counterBetCnt'].style.fill=setObj['counterLinesCnt'].colorText;

	}
if(ev.detail.bname=='uiButtonLines'){
objArr['counterLinesCnt'].style.fill=setObj['counterLinesCnt'].colorText;

	}

	});	

addEventListener('button_disable',function(ev){

if(ev.detail.bname=='uiButtonBet'){	
objArr['counterBetCnt'].style.fill=['#999999'];

}
if(ev.detail.bname=='uiButtonLines'){	
objArr['counterLinesCnt'].style.fill=['#999999'];

	}

	});	
	
return this;	
	
}