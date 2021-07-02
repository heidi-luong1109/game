Button("StartAnimation",
{
},
(function()
{
	var p = 
	{
		init: function(config)
		{
			this._super("startView", 405, 260);
			
			this.setSize(470, 200);
			this.addClass(config.language);
			this._pressStartSound = SoundManager.getInstance().play("pressStartSound",true);
			
			if(!this._pressStartSound)
				SoundManager.getInstance().addEventListener(SoundManager.SOUND_LOADED, onSoundLoaded, this);
		},
		dispose:function ()
		{
			SoundManager.getInstance().removeEventListener(SoundManager.SOUND_LOADED, onSoundLoaded, this);
			SoundManager.getInstance().stop(this._pressStartSound);
		}

	};
	
	function onSoundLoaded(event)
	{
		if(event.data.soundIndex == 5)
			this._pressStartSound = SoundManager.getInstance().play("pressStartSound",true);
	}
	
	return p;
})());