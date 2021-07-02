DoorAnimation("RetriggerAnimation",
{
},
(function()
{
	var p = 
	{
		init: function(config)
		{
			this._config = config;
			this._config.translations = FreeSpinTranslations[this._config.language].RetriggerAnimation;
			this._super("retriggerAnimation", config);
		},
		playSoundManagerAfterWebFont: function()
		{
			this._sound = SoundManager.getInstance().play("introSound",false);
		},
		_onFadeInComplete: function()
		{
			this._super(3700);
		},
		_dispose:function()
		{
			SoundManager.getInstance().stop(this._sound);
		}
	};
	
	return p;
})());