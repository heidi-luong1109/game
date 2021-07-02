function Config()
{
    this.reelWidth = 172 ;
    this.reelHeight = 516;
    this.reelSpacing = 17;

    this.numImages = 11;
    this.numReels = 5;
    this.numReelCards = 3;
    this.wildIndex = 9;
    this.linesCount = [1, 5, 10, 15, 20 ];
    this.hasFreespins = true;

    this.coinAnimationCoef = 20;

    this.linesSelectActiveColor = 0xc0ff00;
    this.linesSelectInactiveColor = 0xb5b1aa;
    this.linesSelectActiveGlowColor = 0x0a5200;
    this.linesSelectInactiveGlowColor = 0x01060f;
    this.gameNumberTimeHelpColor = 0x773500;
    this.labelsColor = 0xe5a61f;

    this.toolTipMainTextColor = 0xFFFFFF;
    this.toolTipUsernameTextColor = 0xe5a61f;
    this.toolTipWinAmountTextColor = 0xFFFFFF;
    this.toolTipCurrencyTextColor = 0xe5a61f;
    this.toolTipDateTextColor = 0xbfbfbf;
    this.toolTipNumberOfWinnersTextColor = 0xe5a61f;
    this.toolTipDateSeparator = "/";

    this.paytablePageCount = 5;
    this.paytableGamblePage = 2;

    this.scatterConfig  = [
        {index: 10, minCount: 3, freespinMinCount: 3,
            validReels: [ true, false , true, false , true ], freespinVideoIndex: -1, freespinSound: "winScatterFs",
            stopSounds:["stopScatterSound", "stopScatterSound", "stopScatterSound", "stopScatterSound", "stopScatterSound"]}
    ];

    this.reelVideos = [
        {src:["images/videos/00-0.json"], fps: 10},
        {src:["images/videos/01-0.json"], fps: 10},
        {src:["images/videos/02-0.json"], fps: 10},
        {src:["images/videos/03-0.json"], fps: 10},
        {src:["images/videos/04-0.json", "images/videos/04-1.json"], fps: 10},
        {src:["images/videos/05-0.json", "images/videos/05-1.json"], fps: 10},
        {src:["images/videos/06-0.json"], fps: 10},
        {src:["images/videos/07-0.json", "images/videos/07-1.json", "images/videos/07-2.json"], fps: 10},
        {src:["images/videos/08-0.json", "images/videos/08-1.json"], fps: 10},
        {src:["images/videos/09-0.json", "images/videos/09-1.json", "images/videos/09-2.json"], fps: 15},
        {src:["images/videos/10-0.json", "images/videos/10-1.json"], fps: 15}
    ];

    this.reelImages = ["reelImages.json"];

    this.linesCoords = [
        {coords:[184,320, 1095,320], color:0xfff221},
        {coords:[184,150, 1095,150], color:0xf9af0c},
        {coords:[184,497, 1095,497], color:0x17e614},
        {coords:[184,157, 259,157, 640,507, 1018,157, 1095,157], color:0xdf3d3d},
        {coords:[184,506, 259,506, 640,140, 1018,506, 1095,506], color:0xc90404},
        {coords:[184,143, 444,143, 833,488, 1095,488], color:0x60bad},
        {coords:[184,488, 457,488, 838,143, 1095,143], color:0x1189ba},
        {coords:[184,336, 259,336, 442,505, 850,505, 1018,336, 1095,336], color:0xc86b07},
        {coords:[184,305, 259,305, 462,141, 824,141, 1011,305, 1095,305], color:0x3bb108},
        {coords:[184,134, 245,134, 449,327, 829,327, 1039,134, 1095,134], color:0x4a82f3},
        {coords:[184,479, 280,479, 451,311, 825,311, 997,479, 1095,479], color:0xce0089},
        {coords:[184,343, 276,343, 440,497, 831,141, 1060,343, 1095,343], color:0xce52a1},
        {coords:[184,297, 262,297, 452,143, 851,497, 1049,297, 1095,297], color:0xaf2dc5},
        {coords:[184,164, 284,164, 447,318, 640,134, 830,320, 1000,164, 1095,164], color:0x3a9e26},
        {coords:[184,514, 236,514, 442,312, 640,497, 838,315, 1043,514, 1095,514], color:0x227ab3},
        {coords:[184,329, 466,329, 640,490, 816,329, 1095,329], color:0x6e0cb3},
        {coords:[184,311, 447,311, 640,129, 826,311, 1095,311], color:0xce00ba},
        {coords:[184,172, 264,172, 439,499, 640,137, 850,497, 1012,172, 1095,172], color:0xcba303},
        {coords:[184,471, 268,471, 451,141, 640,498, 831,141, 1009,471, 1095,471], color:0xbc3500},
        {coords:[184,289, 265,289, 453,137, 640,489, 831,138, 1002,289, 1095,289], color:0xa2a2a2}
    ];

    this.fullLineSounds = [
        {card:0, name:"fullLine1"}, {card:1, name:"fullLine1"},
        {card:2, name:"fullLine1"}, {card:3, name:"fullLine2"},
        {card:4, name:"fullLine2"}, {card:5, name:"fullLine3"},
        {card:6, name:"fullLine3"}, {card:7, name:"fullLine4"},
        {card:8, name:"fullLine4"}, {card:9, name:"fullLine4"},
        {card:10, name:"fullLine4"}, {card:11, name:"fullLine4"}
    ];

    this.gameSounds = [
        {
            src: "shortSounds.mp3", sounds:[
                {name: "reelAccelerateSound", start:1, duration: 2.05},
                {name: "stopScatterSound", start:0, duration: 0.37}]
        },
        {
            src: "winSounds.mp3", sounds:[
                {name: "win3", start:2, duration: 2.44},
                {name: "win4", start:0, duration: 1.6},
                {name: "win5", start:5, duration: 2.7},
                {name: "win6", start:8, duration: 4.93},
                {name: "win7", start:13, duration: 6.7},
                {name: "win8", start:20, duration: 5.45},
                {name: "win9", start:26, duration: 1.5},
                {name: "winScatterFs", start:28, duration: 8.4},
                {name: "creditAnimationSound", start:37, duration: 10.0}]
        }];

    this.freespinSounds = [
        {
            src: "freespinSounds.mp3", id: "freespinSounds", sounds:[
                {name: "pressStartSound", start:0, duration: 8},
                {name: "introSound", start:9, duration: 10},
                {name: "outroSound", start:20, duration: 9.9},
                {name: "doorHitSound", start:30, duration: 2.218}]
        }];

    this.helpLanguages = ["en", "bg", "ro", "es", "pt", "it", "da", "sv"];
    this.paytableLanguages = ['en', 'bg', 'ru', 'mk', 'fr', 'nl', 'es','ro', 'pt', 'it', 'da', 'hu', 'sv', 'de'];
    this.freespinLanguages = ['en', 'bg', 'ru', 'mk', 'fr', 'nl', 'es','ro', 'pt', 'it', 'da', 'hu', 'sv', 'de'];
}

com.egt.baseslot.Config = Config;
com.egt.baseslot.buildTime = 1562835494834;