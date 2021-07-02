View("FreespinAnimation",
{
},
(function()
{
	var p = 
	{
		init: function(config)
		{
			this._super();
			
			this._config = config;
			this._startAnimation = null;
			this._introAnimation = null;
			this._retriggerAnimation = null;
			this._outroAnimation = null;

			this._valueText = "";
			this._currency = "";
			
			this.setId("FreespinAnimation");
		},
		
		setValueText: function(text)
		{
			this._valueText = text;
		},
		goToPhase: function(phase)
		{
			stopAllAnimations.call(this);


			switch(phase)
			{
				case "start":
					this._startAnimation = new StartAnimation(this._config);
					this._startAnimation.addEventListener(MouseEvent.CLICK, onStartPressed, this);
					this.addChild(this._startAnimation);
					break;
				case "intro":
					this._introAnimation = new IntroAnimation(this._config);
					this._introAnimation.addEventListener(DoorAnimation.ANIMATION_COMPLETE, onAnimationComplete, this);
					this.addChild(this._introAnimation);
					break;
				case "retrigger":
					this._retriggerAnimation = new RetriggerAnimation(this._config);
					this._retriggerAnimation.addEventListener(DoorAnimation.ANIMATION_COMPLETE, onAnimationComplete, this);
					this.addChild(this._retriggerAnimation);
					break;
				case "outro":
					this._outroAnimation = new OutroAnimation(this._config, this._valueText);
					this._outroAnimation.addEventListener(DoorAnimation.ANIMATION_COMPLETE, onAnimationComplete, this);
					this.addChild(this._outroAnimation);
					break;
				default:
					throw new Error("No freespin animation \" "+ phase + "\" supported");
			}
		},
		
		dispose: function()
		{
			stopAllAnimations.call(this);
			
			this._super();
		}
	};
	
	function stopAllAnimations()
	{
		if (this._startAnimation)
		{
			this.removeChild(this._startAnimation);
			this._startAnimation.removeEventListener(MouseEvent.CLICK, onStartPressed, this);
			this._startAnimation.dispose();
			this._startAnimation = null;
		}
		if (this._introAnimation)
		{
			this._introAnimation.removeEventListener(DoorAnimation.ANIMATION_COMPLETE, onAnimationComplete, this);
			this.removeChild(this._introAnimation);
			this._introAnimation.dispose();
			this._introAnimation = null;
		}
		if (this._retriggerAnimation)
		{
			this._retriggerAnimation.removeEventListener(DoorAnimation.ANIMATION_COMPLETE, onAnimationComplete, this);
			this.removeChild(this._retriggerAnimation);
			this._retriggerAnimation.dispose();
			this._retriggerAnimation = null;
		}
		if (this._outroAnimation)
		{
			this._outroAnimation.removeEventListener(DoorAnimation.ANIMATION_COMPLETE, onAnimationComplete, this);
			this.removeChild(this._outroAnimation);
			this._outroAnimation.dispose();
			this._outroAnimation = null;
		}
	}
	
	function onStartPressed(event)
	{
		this.dispatchEvent(new Event("startPressed"));
	}
	
	function onAnimationComplete(event)
	{
		if(event.target == this._introAnimation)
			this.dispatchEvent(new Event("introEnded"));
		else if(event.target == this._retriggerAnimation)
			this.dispatchEvent(new Event("retriggerEnded"));
		else if(event.target == this._outroAnimation)
			this.dispatchEvent(new Event("outroEnded"));
	}
	
	return p;
})());