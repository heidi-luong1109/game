DoorAnimation("OutroAnimation",
{
},
(function()
{
	var p = 
	{
		init: function(config, valueText)
		{
			this._config = config;
			this._config.translations = FreeSpinTranslations[this._config.language].OutroAnimation;
			this._config.valueText = valueText;
			this._super("outroAnimation",config);
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
			SoundManager.getInstance().stop(this.sound);
		},


	};
	
	return p;
})());