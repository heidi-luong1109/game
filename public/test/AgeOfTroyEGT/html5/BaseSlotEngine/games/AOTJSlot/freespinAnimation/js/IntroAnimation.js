DoorAnimation("IntroAnimation",
{

},
(function()
{
	var p = 
	{
		init: function(config)
		{
			this._config = config;
			this._config.translations = FreeSpinTranslations[this._config.language].IntroAnimation;
			this._super("introAnimation", config);
		},
		playSoundManagerAfterWebFont: function()
		{
			this._sound = SoundManager.getInstance().play("introSound",false);
		},
		_onFadeInComplete: function()
		{
			this._super(4700);
		},
		_dispose:function()
		{
			SoundManager.getInstance().stop(this._sound);
		}
	};
	
	return p;
})());