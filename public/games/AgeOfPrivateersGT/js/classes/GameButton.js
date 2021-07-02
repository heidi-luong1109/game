
////////////////buttons class///////////////////
function ButtonText(viewContainer,bName,stateList,stateList2,minText){

var btnEvent=new CustomEvent("ui_btn",{detail:{bname:bName}});
this.isBlock=false;
this._view=new PIXI.Container();
this.isBlinked=false;
var self=this;
var objArr=new Array();
var blinkTimer;
var blinkContrast=0;
var blinkContrastTarget=false;
var style = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 25,
    fontWeight: '',
    fill: ["#000000","#000000"], // gradient
    stroke: '#FFFFFF',
    strokeThickness: 0,
	align: 'center',	
    dropShadow:true,
    dropShadowColor: '#FFFFFF',
    dropShadowBlur: 5,
    dropShadowAngle: 0,
    dropShadowDistance: 0,
    wordWrap: false,
    wordWrapWidth: 880
});	


	

if(minText!=undefined){

objArr['text']=new PIXI.Text(slotLanguage[bName], style2);
objArr['text'].anchor.set(0.5, 1);	
	
}else{
	
	
objArr['text']=new PIXI.Text(slotLanguage[bName], style);
objArr['text'].anchor.set(0.5, 0.5);

}





this.buttonState="enabled";


var texturesButton=[];


for(var i=0; i<=3; i++){

texturesButton[i]=PIXI.Texture.fromFrame(stateList[i]);
}

var buttonSprite=new PIXI.Sprite(texturesButton[0]);


objArr['text'].x=texturesButton[0].orig.width/2;
objArr['text'].y=texturesButton[0].orig.height/2;

var filter = new PIXI.filters.ColorMatrixFilter();
buttonSprite.filters = [filter];


this._view.addChild(buttonSprite);



this.dbg=function(){

return filter;
};

this.Blink=function(bMod){
  clearInterval(blinkTimer);
  filter.contrast(0,false);

   blinkContrast=0;
   blinkContrastTarget=false;

if(bMod){

blinkTimer=setInterval(function(){



if(blinkContrastTarget){
  blinkContrast--;
  filter.contrast(0,false);
  filter.contrast(blinkContrast/10,true);

}else{
blinkContrast++;
filter.contrast(0,false);
  filter.contrast(blinkContrast/10,true);


}

if(blinkContrast>8 || blinkContrast<0){
blinkContrastTarget=!blinkContrastTarget;

}

},50);

self.isBlinked=true;

}else{
  clearInterval(blinkTimer);
  filter.contrast(0,false);
self.isBlinked=false;


}


};





this._view.addChild(objArr['text']);

viewContainer.addChild(this._view);

/*-------------*/




/*------------*/
this.Enable=function(){

// 
objArr['text'].style.fill=["#000000"];

objArr['text'].style.dropShadow=true;
if(self.isBlock){

buttonSprite.texture=texturesButton[3];

self.buttonState="disabled";
clearInterval(blinkTimer);
filter.contrast(0,false);


}else{



buttonSprite.texture=texturesButton[0];

if(self.isBlinked){

}

self.buttonState="enabled";
}





};

this.ChangeLabel=function(lb){

bName=lb;
objArr['text'].text=slotLanguage[bName];

};

this.Disable=function(){
self.buttonState="disabled";
buttonSprite.texture=texturesButton[3];

objArr['text'].style.strokeThickness=0;

objArr['text'].style.fill=["#787878"];

objArr['text'].style.dropShadow=false;

if(self.isBlinked){
  clearInterval(blinkTimer);
  filter.contrast(0,false);
}

};

var Over=function(){

if(buttonSprite.texture==texturesButton[0]){

buttonSprite.texture=texturesButton[1];

if(self.isBlinked){

}

}

};

var Out=function(){

if(buttonSprite.texture==texturesButton[1]){

buttonSprite.texture=texturesButton[0];

if(self.isBlinked){

}

}

};


var Press=function(){

if(buttonSprite.texture==texturesButton[1] || buttonSprite.texture==texturesButton[0]){

buttonSprite.texture=texturesButton[2];

if(self.isBlinked){

}

}

};

var Pressup=function(){

if(buttonSprite.texture==texturesButton[2]){

buttonSprite.texture=texturesButton[0];

dispatchEvent(btnEvent);

}

};


/*-------------*/
this._view.on('pointerdown', Press)
        .on('pointerup', Pressup)
        .on('pointerupoutside', Out)
        .on('pointerover', Over)
        .on('pointerout', Out);

this._view.interactive = true;

/*------------*/




}
////////////////buttons class///////////////////
function ButtonUI(viewContainer,bName,stateList){

var btnEvent=new CustomEvent("ui_btn",{detail:{bname:bName}});
this.isBlock=false;
this._view=new PIXI.Container();
var self=this;
var objArr=new Array();

this.buttonState="enabled";


var texturesButton=[];


for(var i=0; i<=3; i++){

texturesButton[i]=PIXI.Texture.fromFrame(stateList[i]);
}

var buttonSprite=new PIXI.Sprite(texturesButton[0]);



this._view.addChild(buttonSprite);
viewContainer.addChild(this._view);

/*-------------*/




/*------------*/
this.Enable=function(){



if(self.isBlock){

buttonSprite.texture=texturesButton[3];

self.buttonState="disabled";



}else{



buttonSprite.texture=texturesButton[0];

self.buttonState="enabled";
}





};

this.Disable=function(){
self.buttonState="disabled";
buttonSprite.texture=texturesButton[3];



};

var Over=function(){

if(buttonSprite.texture==texturesButton[0]){

buttonSprite.texture=texturesButton[1];

}

};

var Out=function(){

if(buttonSprite.texture==texturesButton[1]){

buttonSprite.texture=texturesButton[0];

}

};


var Press=function(){

if(buttonSprite.texture==texturesButton[1] || buttonSprite.texture==texturesButton[0]){

buttonSprite.texture=texturesButton[2];

}

};

var Pressup=function(){

if(buttonSprite.texture==texturesButton[2]){

buttonSprite.texture=texturesButton[0];

dispatchEvent(btnEvent);

}

};


/*-------------*/
this._view.on('pointerdown', Press)
        .on('pointerup', Pressup)
        .on('pointerupoutside', Out)
        .on('pointerover', Over)
        .on('pointerout', Out);

this._view.interactive = true;

/*------------*/




}


////////////////buttons class///////////////////
function RoundRectWndButton(viewContainer,bName,stateList,colors,width,height,minText,line){

var btnEvent=new CustomEvent("ui_btn",{detail:{bname:bName}});
this.isBlock=false;
this._view=new PIXI.Container();
var self=this;
var objArr=new Array();
var filter = new PIXI.filters.ColorMatrixFilter();
var textColors={};
this.buttonState="enabled";


var rectBg=new PIXI.Graphics();
rectBg.beginFill(colors[0]); 
rectBg.drawRoundedRect(
    -(width/2),
    -(height/2),
    width,
    height,
    7,
);
rectBg.endFill();
self._view.addChild(rectBg);


var rectBorder=new PIXI.Graphics();
rectBorder.lineStyle(3, colors[1])
rectBorder.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    7,
);
rectBorder.endFill();
self._view.addChild(rectBorder);



var rectBorderOver=new PIXI.Graphics();
rectBorderOver.lineStyle(3, colors[2])
rectBorderOver.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    7,
);
rectBorderOver.endFill();
self._view.addChild(rectBorderOver);
rectBorderOver.visible=false;

var rectBorderDisable=new PIXI.Graphics();
rectBorderDisable.lineStyle(3, colors[3])
rectBorderDisable.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    7,
);
rectBorderDisable.endFill();
self._view.addChild(rectBorderDisable);
rectBorderDisable.visible=false;

var rectBgSelected=new PIXI.Graphics();
rectBgSelected.beginFill(colors[2]); 
rectBgSelected.drawRoundedRect(
    -(width/2),
    -(height/2),
    width,
    height,
    7,
);
rectBgSelected.endFill();
self._view.addChild(rectBgSelected);
rectBgSelected.visible=false;

rectBg.alpha=0.7;


var texturesButton=[];


for(var i=0; i<stateList.length; i++){

texturesButton[i]=PIXI.Texture.fromFrame(stateList[i]);

objArr['img_'+i]=new PIXI.Sprite(texturesButton[i]);

objArr['img_'+i].anchor.set(0.5,0.5);
objArr['img_'+i].tint=colors[4];

objArr['img_'+i].filters = [filter];
filter.contrast(0,false);

this._view.addChild(objArr['img_'+i]);

}

this.dbg=function(){
	
return objArr;	
};

this.dbg2=function(){
	
return filter;	
};
var style = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 18,
    fontWeight: '',
    fill: ["#FFE300","#FFE300"], // gradient
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

var style3 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 18,
    fontWeight: '',
    fill: ["#48A708","#379701"], // gradient
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

var style2 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 14,
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






//buttonText.x=width/2;
//buttonText.y=height/2;

if(minText!=undefined){
	
var buttonText=new PIXI.Text(slotLanguage[bName],style2);
buttonText.anchor.set(0.5,1.3);	
textColors.Over=["#FFFFFF","#FFFFFF"];	
textColors.Idle=["#FFFFFF","#FFFFFF"];	
textColors.Disable=["#FFFFFF","#FFFFFF"];	
}else{

var buttonText=new PIXI.Text(line,style);
buttonText.anchor.set(0.5,0.5);	
	
textColors.Over=["#FFE300","#FFE300"];	
textColors.Idle=["#FFE300","#FFE300"];	
textColors.Disable=["#999999","#999999"];	
	
}

viewContainer.addChild(this._view);

/*-------------*/

if(bName=='uiButtonSkip' || bName=='uiButtonAuto' || bName=='uiButtonAutoStop'){
		
objArr['img_0'].scale.set(0.65,0.65);	
	
}

if(bName=='uiButtonAuto' || bName=='uiButtonAutoStop'){
		
objArr['img_0'].y=16;	
	
}

if(bName=='uiButtonSpin'){

objArr['img_0'].x=-36;
var buttonText=new PIXI.Text(slotLanguage[bName],style3);

textColors.Over=["#6FFC00","#6FFC00"];	
textColors.Idle=["#48A708","#379701"];	
textColors.Disable=["#999999","#999999"];
buttonText.anchor.set(0,0.5);	
buttonText.x=-8;	
}
self._view.addChild(buttonText);

/*------------*/
this.Enable=function(){


self.buttonState="enabled";

buttonText.style.fill=textColors.Idle;



rectBorderOver.visible=false;
rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
rectBgSelected.visible=false;

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=colors[4];


}

};

this.Disable=function(){
	
buttonText.style.fill=['#000000'];	
	
rectBorderOver.visible=false;
rectBorder.visible=false;
rectBorderDisable.visible=true;

filter.contrast(0,false);	
	
self.buttonState="disabled";

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=0xFFFFFF;


}
rectBgSelected.visible=true;
};

var Over=function(){

if(self.buttonState!='disabled'){

buttonText.style.fill=textColors.Over;
rectBg.alpha=0.8;
rectBorderOver.visible=true;
rectBorder.visible=false;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(1,true);
filter.contrast(1,true);


}

};

var Out=function(){

if(self.buttonState!='disabled'){
rectBg.alpha=0.7;	
buttonText.style.fill=textColors.Idle;	
	
rectBorderOver.visible=false;
rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
}


};


var Press=function(){


if(self.buttonState!='disabled'){

}


};

var Pressup=function(){
	
if(self.buttonState!='disabled'){	

dispatchEvent(btnEvent);
}


};


/*-------------*/
this._view.on('pointerdown', Press)
        .on('pointerup', Pressup)
        .on('pointerupoutside', Out)
        .on('pointerover', Over)
        .on('pointerout', Out);

this._view.interactive = true;

/*------------*/




}


////////////////buttons class///////////////////


function RoundRectButton(viewContainer,bName,stateList,colors,width,height,minText){


var btnEvent=new CustomEvent("ui_btn",{detail:{bname:bName}});
var btnEvent2=new CustomEvent("ui_btn_over",{detail:{bname:bName}});
var btnEvent3=new CustomEvent("ui_btn_out",{detail:{bname:bName}});	
var btnEvent4=new CustomEvent("button_disable",{detail:{bname:bName}});
var btnEvent5=new CustomEvent("button_enable",{detail:{bname:bName}});
this.isBlock=false;
this._view=new PIXI.Container();
var self=this;
var objArr=new Array();
var filter = new PIXI.filters.ColorMatrixFilter();
var textColors={};
this.buttonState="enabled";


var rectBg=new PIXI.Graphics();
rectBg.beginFill(colors[0]); 
rectBg.drawRoundedRect(
    -(width/2),
    -(height/2),
    width,
    height,
    12.5,
);
rectBg.endFill();
self._view.addChild(rectBg);

this.dbg3=function(){
return rectBorder;	
};

var rectBorder=new PIXI.Graphics();
rectBorder.lineStyle(3, colors[1])
rectBorder.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    11,
);
rectBorder.endFill();
self._view.addChild(rectBorder);


var rectBorderOver=new PIXI.Graphics();
rectBorderOver.lineStyle(3, colors[2])
rectBorderOver.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    11,
);
rectBorderOver.endFill();
self._view.addChild(rectBorderOver);
rectBorderOver.visible=false;

var rectBorderDisable=new PIXI.Graphics();
rectBorderDisable.lineStyle(3, colors[3])
rectBorderDisable.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    11,
);
rectBorderDisable.endFill();
self._view.addChild(rectBorderDisable);
rectBorderDisable.visible=false;




rectBg.alpha=0.7;


var texturesButton=[];


for(var i=0; i<stateList.length; i++){

texturesButton[i]=PIXI.Texture.fromFrame(stateList[i]);

objArr['img_'+i]=new PIXI.Sprite(texturesButton[i]);

objArr['img_'+i].anchor.set(0.5,0.5);
objArr['img_'+i].tint=colors[4];

objArr['img_'+i].filters = [filter];
filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

this._view.addChild(objArr['img_'+i]);

}

this.dbg=function(){
	
return objArr;	
};

this.dbg2=function(){
	
return filter;	
};
var style = new PIXI.TextStyle({
    fontFamily: 'Roboto Bold',
    fontSize: 20.5*2,
    fontWeight: 'normal',
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

var style3 = new PIXI.TextStyle({
    fontFamily: 'Roboto Bold',
    fontSize: 20.5*2,
    fontWeight: 'normal',
    fill: ["#4dcd01","#66ea04"], // gradient
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

var style2 = new PIXI.TextStyle({
    fontFamily: 'Roboto Bold',
    fontSize: 16*2,
    fontWeight: 'normal',
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






//buttonText.x=width/2;
//buttonText.y=height/2;

if(minText!=undefined){
	
var buttonText=new PIXI.Text(slotLanguage[bName],style2);
buttonText.anchor.set(0.5,1.3);	
textColors.Over=["#FFFFFF","#FFFFFF"];	
textColors.Idle=["#FFFFFF","#FFFFFF"];	
textColors.Disable=["#FFFFFF","#FFFFFF"];	
}else{

var buttonText=new PIXI.Text(slotLanguage[bName],style);
buttonText.anchor.set(0.5,0.5);	
	
textColors.Over=["#FFE800","#FFCB00"];	
textColors.Idle=["#FFE800","#FFCB00"];	
textColors.Disable=["#999999","#999999"];	
	
}

viewContainer.addChild(this._view);

/*-------------*/






if(bName=='uiButtonSkip' || bName=='uiButtonAuto' || bName=='uiButtonAutoStop'  || bName=='uiButtonClose'){
		
objArr['img_0'].scale.set(0.65,0.65);	
	
}

if(bName=='uiButtonAuto' || bName=='uiButtonAutoStop'){
		
objArr['img_0'].y=16;	
	
}

if(bName=='uiButtonSpin'){

objArr['img_0'].x=-36;
var buttonText=new PIXI.Text(slotLanguage[bName],style3);

textColors.Over=["#6FFC00","#6FFC00"];	
textColors.Idle=["#66ea04","#4dcd01"];	
textColors.Disable=["#999999","#999999"];
buttonText.anchor.set(0,0.5);	
buttonText.x=-8;	





}
if(bName=='uiButtonCollect'){


var buttonText=new PIXI.Text(slotLanguage[bName],style3);

textColors.Over=["#6FFC00","#6FFC00"];	
textColors.Idle=["#66ea04","#4dcd01"];	
textColors.Disable=["#999999","#999999"];
buttonText.anchor.set(0.5,0.5);	






}
self._view.addChild(buttonText);


buttonText.scale.set(0.5,0.5);

/*---------*/

var blinkInter_;
var blinkMode=false;

this.ShowBlink=function(mode){

clearInterval(blinkInter_);
	
if(!mode){
	
rectBorderOver.alpha=1;
rectBorder.alpha=1;	
buttonText.alpha=1;	

if(objArr['img_0']!=undefined){
objArr['img_0'].alpha=1;		
}	
	
return;	
}	
	
	
blinkInter_=setInterval(function(){

if(blinkMode){
rectBorderOver.alpha+=0.02;
rectBorder.alpha+=0.02;	
buttonText.alpha+=0.02;		

if(objArr['img_0']!=undefined){
objArr['img_0'].alpha+=0.02;		
}

}else{
rectBorderOver.alpha-=0.02;
rectBorder.alpha-=0.02;	
buttonText.alpha-=0.02;	

if(objArr['img_0']!=undefined){
objArr['img_0'].alpha-=0.02;		
}
	
}	

if(rectBorder.alpha>=1 || rectBorder.alpha<0.5){
blinkMode=!blinkMode;	
}
	
	},25);	
	
	
};


/*------------*/
this.Enable=function(){


self.buttonState="enabled";

buttonText.style.fill=textColors.Idle;

dispatchEvent(btnEvent5);

rectBorderOver.visible=false;
rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=colors[4];


}

};

this.ChangeLabel=function(){
	
	
	
};

this.Disable=function(){
	
buttonText.style.fill=textColors.Disable;	
dispatchEvent(btnEvent4);	
rectBorderOver.visible=false;
rectBorder.visible=false;
rectBorderDisable.visible=true;

filter.contrast(0,false);	
	
self.buttonState="disabled";

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=0xFFFFFF;


}

};

var Over=function(){

if(self.buttonState!='disabled'){

buttonText.style.fill=textColors.Over;
rectBg.alpha=0.8;
rectBorderOver.visible=true;
rectBorder.visible=false;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

dispatchEvent(btnEvent2);
}

};

var Out=function(){

if(self.buttonState!='disabled'){
rectBg.alpha=0.7;	
buttonText.style.fill=textColors.Idle;	
	
rectBorderOver.visible=false;
rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

dispatchEvent(btnEvent3);

}


};


var Press=function(){


if(self.buttonState!='disabled'){

}


};

var Pressup=function(){

if(self.buttonState!='disabled'){
dispatchEvent(btnEvent);
}

};


/*-------------*/
this._view.on('pointerdown', Press)
        .on('pointerup', Pressup)
        .on('pointerupoutside', Out)
        .on('pointerover', Over)
        .on('pointerout', Out);

this._view.interactive = true;

/*------------*/




}



function RoundRectMinButton(viewContainer,bName,stateList,colors,width,height,minText){

var btnEvent=new CustomEvent("ui_btn",{detail:{bname:bName}});
var btnEvent2=new CustomEvent("ui_btn_over",{detail:{bname:bName}});
var btnEvent3=new CustomEvent("ui_btn_out",{detail:{bname:bName}});
this.isBlock=false;
this._view=new PIXI.Container();
var self=this;
var objArr=new Array();
var filter = new PIXI.filters.ColorMatrixFilter();
var textColors={};
this.buttonState="enabled";


addEventListener('ui_btn_over',function(ev){

if(ev.detail.bname=='uiButtonBet' || ev.detail.bname=='uiButtonBetPlus' || ev.detail.bname=='uiButtonBetMinus'){

if(self.buttonState=="enabled"){	
rectBorder.visible=true;
}


}
	
	
});



addEventListener('ui_btn_out',function(ev){

if(ev.detail.bname=='uiButtonBet' || ev.detail.bname=='uiButtonBetPlus' || ev.detail.bname=='uiButtonBetMinus'){


rectBorder.visible=false;



}
	
	
});



var rectBg=new PIXI.Graphics();
rectBg.beginFill(colors[0]); 
rectBg.drawRoundedRect(
    -(width/2),
    -(height/2),
    width,
    height,
    6,
);
rectBg.endFill();
self._view.addChild(rectBg);


var rectBorder=new PIXI.Graphics();
rectBorder.lineStyle(2, colors[1])
rectBorder.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    6,
);
rectBorder.endFill();
self._view.addChild(rectBorder);



var rectBorderOver=new PIXI.Graphics();
rectBorderOver.lineStyle(2, colors[2])
rectBorderOver.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    6,
);
rectBorderOver.endFill();
self._view.addChild(rectBorderOver);
rectBorderOver.visible=false;

var rectBorderDisable=new PIXI.Graphics();
rectBorderDisable.lineStyle(2, colors[3])
rectBorderDisable.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    6,
);
rectBorderDisable.endFill();
self._view.addChild(rectBorderDisable);
rectBorderDisable.visible=false;


this.BorderShow=function(){

rectBorder.visible=true;	
	
};
this.BorderHide=function(){

rectBorder.visible=false;	
	
};
rectBg.alpha=0.1;


var texturesButton=[];


for(var i=0; i<stateList.length; i++){

texturesButton[i]=PIXI.Texture.fromFrame(stateList[i]);

objArr['img_'+i]=new PIXI.Sprite(texturesButton[i]);

objArr['img_'+i].anchor.set(0.5,0.5);
objArr['img_'+i].tint=colors[4];

objArr['img_'+i].filters = [filter];
filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

this._view.addChild(objArr['img_'+i]);

}

this.dbg=function(){
	
return objArr;	
};

this.dbg2=function(){
	
return filter;	
};
var style = new PIXI.TextStyle({
    fontFamily: 'Roboto Bold',
    fontSize: 17,
    fontWeight: '',
    fill: ["#FFFF00","#FFFF00"], // gradient
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

var style3 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 18,
    fontWeight: '',
    fill: ["#48A708","#379701"], // gradient
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

var style2 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 14,
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






//buttonText.x=width/2;
//buttonText.y=height/2;

if(minText!=undefined){
	
var buttonText=new PIXI.Text(slotLanguage[bName],style2);
buttonText.anchor.set(0.5,1.3);	
textColors.Over=["#FFFFFF","#FFFFFF"];	
textColors.Idle=["#FFFFFF","#FFFFFF"];	
textColors.Disable=["#FFFFFF","#FFFFFF"];	
}else{

var buttonText=new PIXI.Text(slotLanguage[bName],style);
buttonText.anchor.set(0.5,0.5);	
	
textColors.Over=["#FFE800","#FFCB00"];	
textColors.Idle=["#FFE800","#FFCB00"];	
textColors.Disable=["#999999","#999999"];	
	
}

viewContainer.addChild(this._view);

/*-------------*/


self._view.addChild(buttonText);

rectBorder.visible=false;
/*------------*/
this.Enable=function(){


self.buttonState="enabled";

buttonText.style.fill=textColors.Idle;



rectBorderOver.visible=false;

rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=colors[4];


}

};

this.ChangeLabel=function(){
	
	
	
};

this.Disable=function(){
	
buttonText.style.fill=textColors.Disable;	
	
rectBorderOver.visible=false;
rectBorder.visible=false;


filter.contrast(0,false);	
	
self.buttonState="disabled";

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=0xFFFFFF;


}

};

var Over=function(){

if(self.buttonState!='disabled'){

buttonText.style.fill=textColors.Over;
rectBg.alpha=0.1;
rectBorderOver.visible=true;
rectBorder.visible=false;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

dispatchEvent(btnEvent2);
}

};

var Out=function(){

if(self.buttonState!='disabled'){
rectBg.alpha=0.1;	
buttonText.style.fill=textColors.Idle;	
	
rectBorderOver.visible=false;
rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

dispatchEvent(btnEvent3);

}


};


var Press=function(){


if(self.buttonState!='disabled'){

}


};

var Pressup=function(){

if(self.buttonState!='disabled'){
setTimeout(function(){

dispatchEvent(btnEvent);	
	},1)

rectBorderOver.visible=true;

}

};






/*-------------*/
this._view.on('pointerdown', Press)
        .on('pointerup', Pressup)
        .on('pointerupoutside', Out)
        .on('pointerover', Over)
        .on('pointerout', Out);

this._view.interactive = true;

/*------------*/




}


function RoundRectSimpleButton(viewContainer,bName,stateList,colors,width,height,minText){

var btnEvent=new CustomEvent("ui_btn",{detail:{bname:bName}});
this.isBlock=false;
this._view=new PIXI.Container();
var self=this;
var objArr=new Array();
var filter = new PIXI.filters.ColorMatrixFilter();
var textColors={};
this.buttonState="enabled";


var rectBg=new PIXI.Graphics();
rectBg.beginFill(colors[0]); 
rectBg.drawRoundedRect(
    -(width/2),
    -(height/2),
    width,
    height,
    10,
);
rectBg.endFill();
self._view.addChild(rectBg);




rectBg.alpha=0.7;


var texturesButton=[];


for(var i=0; i<stateList.length; i++){

texturesButton[i]=PIXI.Texture.fromFrame(stateList[i]);

objArr['img_'+i]=new PIXI.Sprite(texturesButton[i]);

objArr['img_'+i].anchor.set(0.5,0.5);
objArr['img_'+i].tint=colors[4];

objArr['img_'+i].filters = [filter];
filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

this._view.addChild(objArr['img_'+i]);

}

this.dbg=function(){
	
return objArr;	
};

this.dbg2=function(){
	
return filter;	
};
var style = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 21,
    fontWeight: '',
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

var style3 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 18,
    fontWeight: '',
    fill: ["#48A708","#379701"], // gradient
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

var style2 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 14,
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






//buttonText.x=width/2;
//buttonText.y=height/2;

if(minText!=undefined){
	
var buttonText=new PIXI.Text(slotLanguage[bName],style2);
buttonText.anchor.set(0.5,1.3);	
textColors.Over=["#FFFFFF","#FFFFFF"];	
textColors.Idle=["#FFFFFF","#FFFFFF"];	
textColors.Disable=["#FFFFFF","#FFFFFF"];	
}else{

var buttonText=new PIXI.Text(slotLanguage[bName],style);
buttonText.anchor.set(0.5,0.5);	
	
textColors.Over=["#FFE800","#FFCB00"];	
textColors.Idle=["#FFE800","#FFCB00"];	
textColors.Disable=["#999999","#999999"];	
	
}

viewContainer.addChild(this._view);

/*-------------*/

if(bName=='linesTabClose' || bName=='betsTabClose' || bName=='uiButtonAutoStop'){
		
objArr['img_0'].scale.set(0.5,0.5);	
	
}

if(bName=='uiButtonAuto' || bName=='uiButtonAutoStop'){
		
objArr['img_0'].y=16;	
	
}


self._view.addChild(buttonText);




/*------------*/
this.Enable=function(){


self.buttonState="enabled";

buttonText.style.fill=textColors.Idle;




filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=colors[4];


}

};

this.Disable=function(){
	
buttonText.style.fill=textColors.Disable;	
	


filter.contrast(0,false);	
	
self.buttonState="disabled";

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=0xFFFFFF;


}

};

var Over=function(){

if(self.buttonState!='disabled'){

buttonText.style.fill=textColors.Over;
rectBg.alpha=0.8;


filter.contrast(0,false);
filter.contrast(1,true);
filter.contrast(1,true);


}

};

var Out=function(){

if(self.buttonState!='disabled'){
rectBg.alpha=0.7;	


filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
}


};


var Press=function(){


if(self.buttonState!='disabled'){

}


};

var Pressup=function(){
	
if(self.buttonState!='disabled'){	

dispatchEvent(btnEvent);
}

};


/*-------------*/
this._view.on('pointerdown', Press)
        .on('pointerup', Pressup)
        .on('pointerupoutside', Out)
        .on('pointerover', Over)
        .on('pointerout', Out);

this._view.interactive = true;

/*------------*/




}


////////////////buttons class///////////////////
function RoundRectMenuButton(viewContainer,bName,stateList,colors,width,height,minText){

var btnEvent=new CustomEvent("ui_btn",{detail:{bname:bName}});
this.isBlock=false;
this._view=new PIXI.Container();
var self=this;
var objArr=new Array();
var filter = new PIXI.filters.ColorMatrixFilter();
var textColors={};
this.buttonState="enabled";


var rectBg=new PIXI.Graphics();
rectBg.beginFill(colors[0]); 
rectBg.drawRoundedRect(
    -(width/2),
    -(height/2),
    width,
    height,
    10,
);
rectBg.endFill();
self._view.addChild(rectBg);


var rectBorder=new PIXI.Graphics();
rectBorder.lineStyle(3, colors[1])
rectBorder.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    10,
);
rectBorder.endFill();
self._view.addChild(rectBorder);


var rectBorderOver=new PIXI.Graphics();
rectBorderOver.lineStyle(3, colors[2])
rectBorderOver.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    10,
);
rectBorderOver.endFill();
self._view.addChild(rectBorderOver);
rectBorderOver.visible=false;

var rectBorderDisable=new PIXI.Graphics();
rectBorderDisable.lineStyle(3, colors[3])
rectBorderDisable.drawRoundedRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    10,
);
rectBorderDisable.endFill();
self._view.addChild(rectBorderDisable);
rectBorderDisable.visible=false;




rectBg.alpha=0.7;


var texturesButton=[];


for(var i=0; i<stateList.length; i++){

texturesButton[i]=PIXI.Texture.fromFrame(stateList[i]);

objArr['img_'+i]=new PIXI.Sprite(texturesButton[i]);

objArr['img_'+i].anchor.set(0.5,0.5);
objArr['img_'+i].tint=colors[4];

objArr['img_'+i].filters = [filter];
filter.contrast(0,false);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.5,true);

this._view.addChild(objArr['img_'+i]);

}

this.dbg=function(){
	
return objArr;	
};

this.dbg2=function(){
	
return filter;	
};
var style = new PIXI.TextStyle({
    fontFamily: 'Verdana Regular',
    fontSize: 17,
    fontWeight: '400',
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

var style3 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 18,
    fontWeight: '',
    fill: ["#48A708","#379701"], // gradient
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

var style2 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 14,
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






//buttonText.x=width/2;
//buttonText.y=height/2;

if(minText!=undefined){
	
var buttonText=new PIXI.Text(slotLanguage[bName],style2);
buttonText.anchor.set(0.5,1.3);	
textColors.Over=["#FFFFFF","#FFFFFF"];	
textColors.Idle=["#FFFFFF","#FFFFFF"];	
textColors.Disable=["#FFFFFF","#FFFFFF"];	
}else{

var buttonText=new PIXI.Text(slotLanguage[bName],style);
buttonText.anchor.set(0.0,0.5);		
	
textColors.Over=["#FFE800","#FFCB00"];	
textColors.Idle=["#FFE800","#FFCB00"];	
textColors.Disable=["#999999","#999999"];	
	
}

viewContainer.addChild(this._view);

/*-------------*/


		
buttonText.x=-60;
objArr['img_0'].x=-87;
objArr['img_0'].scale.set(0.7,0.7);
	



self._view.addChild(buttonText);

/*------------*/
this.Enable=function(){


self.buttonState="enabled";

buttonText.style.fill=textColors.Idle;



rectBorderOver.visible=false;
rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.5,true);

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=colors[4];


}

};

this.Disable=function(){
	
buttonText.style.fill=textColors.Disable;	
	
rectBorderOver.visible=false;
rectBorder.visible=false;
rectBorderDisable.visible=true;

filter.contrast(0,false);	
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.5,true);	
self.buttonState="disabled";

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=0xFFFFFF;


}

};

var Over=function(){

if(self.buttonState!='disabled'){

buttonText.style.fill=textColors.Over;
rectBg.alpha=0.8;
rectBorderOver.visible=true;
rectBorder.visible=false;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.1,true);


}

};

var Out=function(){

if(self.buttonState!='disabled'){
rectBg.alpha=0.7;	
buttonText.style.fill=textColors.Idle;	
	
rectBorderOver.visible=false;
rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
}


};


var Press=function(){


if(self.buttonState!='disabled'){

}


};

var Pressup=function(){
	
if(self.buttonState!='disabled'){	

dispatchEvent(btnEvent);

}

};


/*-------------*/
this._view.on('pointerdown', Press)
        .on('pointerup', Pressup)
        .on('pointerupoutside', Out)
        .on('pointerover', Over)
        .on('pointerout', Out);

this._view.interactive = true;

/*------------*/




}


function RoundRectFooterButton(viewContainer,bName,stateList,colors,width,height,minText){

var btnEvent=new CustomEvent("ui_btn",{detail:{bname:bName}});
var btnEvent2=new CustomEvent("ui_btn_over",{detail:{bname:bName}});
var btnEvent3=new CustomEvent("ui_btn_out",{detail:{bname:bName}});
this.isBlock=false;
this._view=new PIXI.Container();
var self=this;
var objArr=new Array();
var filter = new PIXI.filters.ColorMatrixFilter();
var textColors={};
this.buttonState="enabled";
var isSelected=false;

var rectBg=new PIXI.Graphics();
rectBg.beginFill(colors[0]); 
rectBg.drawRect(
    -(width/2),
    -(height/2),
    width,
    height,
    10,
);
rectBg.endFill();
self._view.addChild(rectBg);

rectBg.alpha=0.01;

var rectBorder=new PIXI.Graphics();

rectBorder.endFill();
self._view.addChild(rectBorder);


var rectBorderOver=new PIXI.Graphics();
rectBorderOver.lineStyle(3, colors[2])
rectBorderOver.drawRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    10,
);
rectBorderOver.endFill();
self._view.addChild(rectBorderOver);
rectBorderOver.visible=false;

var rectBorderDisable=new PIXI.Graphics();
rectBorderDisable.lineStyle(3, colors[3])
rectBorderDisable.drawRect(
     -((width-6)/2),
    -((height-6)/2),
    width-6,
    height-6,
    10,
);
rectBorderDisable.endFill();
self._view.addChild(rectBorderDisable);
rectBorderDisable.visible=false;







var texturesButton=[];


for(var i=0; i<stateList.length; i++){

texturesButton[i]=PIXI.Texture.fromFrame(stateList[i]);

objArr['img_'+i]=new PIXI.Sprite(texturesButton[i]);

objArr['img_'+i].anchor.set(0,0.5);
objArr['img_'+i].tint=colors[4];

objArr['img_'+i].filters = [filter];
filter.contrast(0,false);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
objArr['img_'+i].scale.set(0.5,0.5);
objArr['img_'+i].x=-width/2+10;

if(bName=='uiButtonFooterSound0' || bName=='uiButtonFooterSound1' || bName=='uiButtonFooterSound2'){
objArr['img_'+i].anchor.set(0.5,0.5);	
objArr['img_'+i].x=0;	
objArr['img_'+i].scale.set(0.42,0.42);
}
if(bName=='uiButtonFooterFullOn' || bName=='uiButtonFooterFullOff'){


objArr['img_'+i].scale.set(1,1);
}



this._view.addChild(objArr['img_'+i]);

}

this.dbg=function(){
	
return objArr;	
};

this.dbg2=function(){
	
return filter;	
};
var style = new PIXI.TextStyle({
    fontFamily: 'Roboto Bold',
    fontSize: 16,
    fontWeight: 'normal',
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

var style3 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 18,
    fontWeight: '',
    fill: ["#48A708","#379701"], // gradient
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

var style2 = new PIXI.TextStyle({
    fontFamily: 'Verdana Bold',
    fontSize: 14,
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





this.Select=function(s){
	
rectBorderOver.visible=s;	
isSelected=s;
};

//buttonText.y=height/2;

if(minText!=undefined){
	
var buttonText=new PIXI.Text(slotLanguage[bName],style2);
buttonText.anchor.set(0.5,1.3);	
textColors.Over=["#FFFFFF","#FFFFFF"];	
textColors.Idle=["#FFFFFF","#FFFFFF"];	
textColors.Disable=["#FFFFFF","#FFFFFF"];	
}else{

var buttonText=new PIXI.Text(slotLanguage[bName],style);
buttonText.anchor.set(0.0,0.5);		
	
textColors.Over=["#FFE800","#FFCB00"];	
textColors.Idle=["#FFE800","#FFCB00"];	
textColors.Disable=["#999999","#999999"];	
	
}

viewContainer.addChild(this._view);

/*-------------*/


		
buttonText.x=-6;


if(bName=='uiButtonFooterFullOn' || bName=='uiButtonFooterFullOff'){

buttonText.x=-36;

}
	

	
if(bName!='uiButtonFooterSound0' && bName!='uiButtonFooterSound1' && bName!='uiButtonFooterSound2'){

rectBorderDisable.alpha=0;
rectBorderOver.alpha=0;

}


self._view.addChild(buttonText);

/*------------*/
this.Enable=function(){


self.buttonState="enabled";

buttonText.style.fill=textColors.Idle;


if(!isSelected){
rectBorderOver.visible=false;
}

rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

for(var i=0; i<stateList.length; i++){

objArr['img_'+i].tint=colors[4];


}

};

this.Disable=function(){


};

var Over=function(){

if(self.buttonState!='disabled'){

buttonText.style.fill=textColors.Over;

rectBorderOver.visible=true;
rectBorder.visible=false;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.5,true);
filter.contrast(0.1,true);

dispatchEvent(btnEvent2);
}

};

var Out=function(){

if(self.buttonState!='disabled'){
	
buttonText.style.fill=textColors.Idle;	
if(!isSelected){	
rectBorderOver.visible=false;
}
rectBorder.visible=true;
rectBorderDisable.visible=false;

filter.contrast(0,false);
filter.contrast(0.2,true);
filter.contrast(0.2,true);
filter.contrast(0.2,true);

dispatchEvent(btnEvent3);

}


};


var Press=function(){


if(self.buttonState!='disabled'){

}


};

var Pressup=function(){
	
if(self.buttonState!='disabled'){
	
dispatchEvent(btnEvent);
}

};


/*-------------*/
this._view.on('pointerdown', Press)
        .on('pointerup', Pressup)
        .on('pointerupoutside', Out)
        .on('pointerover', Over)
        .on('pointerout', Out);

this._view.interactive = true;

/*------------*/




}
