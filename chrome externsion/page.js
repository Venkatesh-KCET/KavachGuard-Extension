var currentDate = new Date();
var dd = currentDate.getDate();
var mm = currentDate.getMonth()+1;
var yy = currentDate.getFullYear();
if(dd<10) {dd = '0'+dd} 
if(mm<10) {mm = '0'+mm}
currentDate = (mm)+ "/"+ dd + "/" + yy;
chrome.runtime.onInstalled.addListener(function(details){
    var defaultSettings = {
		censorCharacter: "****",
		filterMethod: "0",
		filterToggle: false,
		matchMethod: "0",
		multipleMeaning: "0",
		password: "null", 
		warningDomains: [
			"https://www.facebook.com",

			"https://www.twitter.com",

			"https://www.9gag.com",

			"https://www.tumblr.com",

			"https://www.youtube.com",

			"https://www.pornhub.com",

			"https://www.theporndude.com",

			"https://www.pornsites.xxx",

			"https://www.allpornsite.xxx",
			
			"https://toppornsites.com",

			"https://www.xhamster.com",

			"https://www.xhamster.xxx",

			"https://xhamster.com",

			"https://www.tblop.com",

			"https://www.thumbzilla.com",

			"https://porndude.me",

			"https://www.xnxx.com",

			"https://theporndude.com",

			"https://sxyprn.com",

			"https://brattysisters.com",

			"https://brattysis.com",

		],
		websites: [
			{"count": "69","site": "https://www.google.com.ph"},
			
			{"count": "32","site": "https://notifications.google.com"},

			{"count": "38","site": "https://www.youtube.com"},

			{"count": "64","site": "https://www.twitter.com"},

			{"count": "47","site": "https://www.facebook.com"},
			
			],
		defaultWords: [
			{"count": 0,"word": "fuck","double":false},
			{"count": 0,"word": "fuckable","double":false},
			{"count": 0,"word": "fucked","double":false},
			{"count": 0,"word": "fucker","double":false},
			{"count": 0,"word": "fuckin","double":false},
			{"count": 0,"word": "fucks","double":false},
			{"count": 0,"word": "fvck","double":false},
			{"count": 0,"word": "shit","double":false},
			{"count": 0,"word": "asses","double":false},
			{"count": 0,"word": "asshole","double":false},
			{"count": 0,"word": "assshit","double":false},
			{"count": 0,"word": "ass-hat","double":false},
			{"count": 0,"word": "asssucker","double":false},
			{"count": 0,"word": "assbag","double":false},
			{"count": 0,"word": "assbite","double":false},
			{"count": 0,"word": "asscock","double":false},
			{"count": 0,"word": "assfuck","double":false},
			{"count": 0,"word": "asshead","double":false},
			{"count": 0,"word": "asslick","double":false},
			{"count": 0,"word": "asslicker","double":false},
			{"count": 0,"word": "assmonkey","double":false},
			{"count": 0,"word": "assmunch","double":false},
			{"count": 0,"word": "anal","double":false},
			{"count": 0,"word": "anus","double":false},
			{"count": 0,"word": "bastard","double":false},
			{"count": 0,"word": "blowjob","double":false},
			{"count": 0,"word": "bampot","double":false},
			{"count": 0,"word": "bitchass","double":false},
			{"count": 0,"word": "bitchy","double":false},
			{"count": 0,"word": "bullshit","double":false},
			{"count": 0,"word": "bitch","double":false},
			{"count": 0,"word": "cunt","double":false},
			{"count": 0,"word": "creampie","double":false},
			{"count": 0,"word": "cum","double":false},
			{"count": 0,"word": "clitface","double":false},
			{"count": 0,"word": "clusterfuck","double":false},
			{"count": 0,"word": "cockass","double":false},
			{"count": 0,"word": "cockbite","double":false},
			{"count": 0,"word": "cockburger","double":false},
			{"count": 0,"word": "cockface","double":false},
			{"count": 0,"word": "cockhead","double":false},
			{"count": 0,"word": "cockmonkey","double":false},
			{"count": 0,"word": "cocknose","double":false},
			{"count": 0,"word": "cocknugget","double":false},
			{"count": 0,"word": "cockshit","double":false},
			{"count": 0,"word": "cockwaffle","double":false},
			{"count": 0,"word": "cumbubble","double":false},
			{"count": 0,"word": "cumslut","double":false},
			{"count": 0,"word": "cumtart","double":false},
			{"count": 0,"word": "cuntass","double":false},
			{"count": 0,"word": "cumdumpster","double":false},
			{"count": 0,"word": "cuntface","double":false},
			{"count": 0,"word": "cuntrag","double":false},
			{"count": 0,"word": "cuntslut","double":false},
			{"count": 0,"word": "cock","double":false},
			{"count": 0,"word": "damn","double":false},
			{"count": 0,"word": "douche","double":false},
			{"count": 0,"word": "douchebag","double":false},
			{"count": 0,"word": "deepthroat","double":false},
			{"count": 0,"word": "dildo","double":false},
			{"count": 0,"word": "dildos","double":false},
			{"count": 0,"word": "dickbag","double":false},
			{"count": 0,"word": "dickface","double":false},
			{"count": 0,"word": "dickfuck","double":false},
			{"count": 0,"word": "dickfucker","double":false},
			{"count": 0,"word": "dickhead","double":false},
			{"count": 0,"word": "dickjuice","double":false},
			{"count": 0,"word": "dickmilk","double":false},
			{"count": 0,"word": "dicksucker","double":false},
			{"count": 0,"word": "dickeater","double":false},
			{"count": 0,"word": "dickwad","double":false},
			{"count": 0,"word": "dickweasel","double":false},
			{"count": 0,"word": "dickweed","double":false},
			{"count": 0,"word": "dickwod","double":false},
			{"count": 0,"word": "dipshit","double":false},
			{"count": 0,"word": "doochbag","double":false},
			{"count": 0,"word": "douchefag","double":false},
			{"count": 0,"word": "faggot","double":false},
			{"count": 0,"word": "fagg0t","double":false},
			{"count": 0,"word": "f@ggot","double":false},
			{"count": 0,"word": "fck","double":false},
			{"count": 0,"word": "dumass","double":false},
			{"count": 0,"word": "dumb ass","double":false},
			{"count": 0,"word": "dumbass","double":false},
			{"count": 0,"word": "dumbfuck","double":false},
			{"count": 0,"word": "dumbshit","double":false},
			{"count": 0,"word": "dumshit","double":false},
			{"count": 0,"word": "dick","double":false},
			{"count": 0,"word": "fag","double":false},
			{"count": 0,"word": "fagfucker","double":false},
			{"count": 0,"word": "fuckers","double":false},
			{"count": 0,"word": "fucken","double":false},
			{"count": 0,"word": "fucking","double":false},
			{"count": 0,"word": "fuckass","double":false},
			{"count": 0,"word": "eatass","double":false},
			{"count": 0,"word": "eatingass","double":false},
			{"count": 0,"word": "lickass","double":false},
			{"count": 0,"word": "lickingass","double":false},
			{"count": 0,"word": "handjob","double":false},
			{"count": 0,"word": "holyshit","double":false},
			{"count": 0,"word": "jizz","double":false},
			{"count": 0,"word": "motherfucker","double":false},
			{"count": 0,"word": "motherfucka","double":false},
			{"count": 0,"word": "orgy","double":false},
			{"count": 0,"word": "pron","double":false},
			{"count": 0,"word": "piss","double":false},
			{"count": 0,"word": "pissed","double":false},
			{"count": 0,"word": "pissing","double":false},
			{"count": 0,"word": "shite","double":false},
			{"count": 0,"word": "thefuck","double":false},
			{"count": 0,"word": "nigga","double":false},
			{"count": 0,"word": "nigger","double":false},
			{"count": 0,"word": "whore","double":false},
			{"count": 0,"word": "lesbian","double":false},
			{"count": 0,"word": "fyck","double":false},
			{"count": 0,"word": "retard","double":false},
			{"count": 0,"word": "milf","double":false},
			{"count": 0,"word": "retarded","double":false},
			{"count": 0,"word": "pussy","double":false},
			{"count": 0,"word": "pussylicker","double":false},
			{"count": 0,"word": "pussyeater","double":false},
			{"count": 0,"word": "sex","double":false},
			{"count": 0,"word": "intercourse","double":false},
			{"count": 0,"word": "sexy","double":false},
			{"count": 0,"word": "sexist","double":false},
			{"count": 0,"word": "rape","double":false},
			{"count": 0,"word": "raper","double":false},
			{"count": 0,"word": "rapist","double":false},
			{"count": 0,"word": "sexual","double":false},
			{"count": 0,"word": "porn","double":false},
			{"count": 0,"word": "xxx","double":false},
			{"count": 0,"word": ".xxx","double":false},
			{"count": 0,"word": "slut","double":false},
			{"count": 0,"word": "lesbo","double":false},
			{"count": 0,"word": "shitting","double":false},
			{"count": 0,"word": "shitter","double":false},
			{"count": 0,"word": "sht","double":false},
			{"count": 0,"word": "ahole","double":false},
			{"count": 0,"word": "boob","double":false},
			{"count": 0,"word": "vagina","double":false},
			{"count": 0,"word": "tit","double":false},

	

			
		],
		substituteWords: [
			{"substitute": "[butt]","word": "anal","double":false},
			{"substitute": "[butt]","word": "anus","double":false},
			{"substitute": "[butt-hat]","word": "ass-hat","double":false},
			{"substitute": "[buttbag]","word": "assbag","double":false},
			{"substitute": "[buttbite]","word": "assbite","double":false},
			{"substitute": "[buttcrook]","word": "asscock","double":false},
			{"substitute": "[butts]","word": "asses","double":false},
			{"substitute": "[butts]","word": "ahole","double":false},
			{"substitute": "[buttmate]","word": "assfuck","double":false},
			{"substitute": "[butthead]","word": "asshead","double":false},
			{"substitute": "[butthole]","word": "asshole","double":false},
			{"substitute": "[buttlick]","word": "asslick","double":false},
			{"substitute": "[buttlicker]","word": "asslicker","double":false},
			{"substitute": "[buttmonkey]","word": "assmonkey","double":false},
			{"substitute": "[butmunch]","word": "assmunch","double":false},
			{"substitute": "[buttard]","word": "assshit","double":false},
			{"substitute": "[buttsipper]","word": "asssucker","double":false},
			{"substitute": "[bam]","word": "bampot","double":false},
			{"substitute": "[insult]","word": "bastard","double":false},
			{"substitute": "[insult]","word": "bitch","double":false},
			{"substitute": "[mean]","word": "bitchass","double":false},
			{"substitute": "[mean]","word": "bitchy","double":false},
			{"substitute": "[job]","word": "blowjob","double":false},
			{"substitute": "[crap]","word": "bullshit","double":false},
			{"substitute": "[female]","word": "boob","double":false},
			{"substitute": "[face]","word": "clitface","double":false},
			{"substitute": "[mess]","word": "clusterfuck","double":false},
			{"substitute": "[rooster]","word": "cock","double":false},
			{"substitute": "[nonsense]","word": "cockass","double":false},
			{"substitute": "[rooster]","word": "cockbite","double":false},
			{"substitute": "[donkey]","word": "cockburger","double":false},
			{"substitute": "[cock]","word": "cockface","double":false},
			{"substitute": "[vex]","word": "cockhead","double":false},
			{"substitute": "[monkey]","word": "cockmonkey","double":false},
			{"substitute": "[nose]","word": "cocknose","double":false},
			{"substitute": "[nugget]","word": "cocknugget","double":false},
			{"substitute": "[cock]","word": "cockshit","double":false},
			{"substitute": "[waffle]","word": "cockwaffle","double":false},
			{"substitute": "[food]","word": "creampie","double":false},
			{"substitute": "[rum]","word": "cum","double":false},
			{"substitute": "[bubble]","word": "cumbubble","double":false},
			{"substitute": "[choosy]","word": "cumdumpster","double":false},
			{"substitute": "[tart]","word": "cumslut","double":false},
			{"substitute": "[tart]","word": "cumtart","double":false},
			{"substitute": "[insult]","word": "cunt","double":false},
			{"substitute": "[insult]","word": "retard","double":false},
			{"substitute": "[insult]","word": "retarded","double":false},
			{"substitute": "[irritating]","word": "cuntass","double":false},
			{"substitute": "[bunny]","word": "cuntface","double":false},
			{"substitute": "[napkin]","word": "cuntrag","double":false},
			{"substitute": "[annoying]","word": "cuntslut","double":false},
			{"substitute": "[duck]","word": "damn","double":false},
			{"substitute": "[throat]","word": "deepthroat","double":false},
			{"substitute": "[bob]","word": "dick","double":false},
			{"substitute": "[bag]","word": "dickbag","double":false},
			{"substitute": "[face]","word": "dickface","double":false},
			{"substitute": "[insult]","word": "dickfuck","double":false},
			{"substitute": "[anger]","word": "dickfucker","double":false},
			{"substitute": "[head]","word": "dickhead","double":false},
			{"substitute": "[juice]","word": "dickjuice","double":false},
			{"substitute": "[milk]","word": "dickmilk","double":false},
			{"substitute": "[gay]","word": "dicksucker","double":false},
			{"substitute": "[gay]","word": "dickeater","double":false},
			{"substitute": "[mean]","word": "dickwad","double":false},
			{"substitute": "[rude]","word": "dickweasel","double":false},
			{"substitute": "[weed]","word": "dickweed","double":false},
			{"substitute": "[annoying]","word": "dickwod","double":false},
			{"substitute": "[toy]","word": "dildo","double":false},
			{"substitute": "[toys]","word": "dildos","double":false},
			{"substitute": "[loser]","word": "dipshit","double":false},
			{"substitute": "[rude]","word": "doochbag","double":false},
			{"substitute": "[duck]","word": "douche","double":false},
			{"substitute": "[throat]","word": "douchebag","double":false},
			{"substitute": "[frat]","word": "douchefag","double":false},
			{"substitute": "[loser]","word": "dumass","double":false},
			{"substitute": "[butt]","word": "dumb ass","double":false},
			{"substitute": "[butt]","word": "dumbass","double":false},
			{"substitute": "[bob]","word": "dumbfuck","double":false},
			{"substitute": "[bob]","word": "dumbshit","double":false},
			{"substitute": "[bob]","word": "dumshit","double":false},
			{"substitute": "[duck]","word": "expression","double":false},
			{"substitute": "[happy]","word": "fag","double":false},
			{"substitute": "[happy]","word": "fagfucker","double":false},
			{"substitute": "[happy]","word": "faggot","double":false},
			{"substitute": "[happy]","word": "faggotfucker","double":false},
			{"substitute": "[happy]","word": "f@gg0t","double":false},
			{"substitute": "[happy]","word": "f@ggot","double":false},
			{"substitute": "[happy]","word": "fagg0t","double":false},
			{"substitute": "[love]","word": "fuck","double":false},
			{"substitute": "[love]","word": "sex","double":false},
			{"substitute": "[love]","word": "sexy","double":false},
			{"substitute": "[love]","word": "sexist","double":false},
			{"substitute": "[love]","word": "intercourse","double":false},
			{"substitute": "[love]","word": "fck","double":false},
			{"substitute": "[loveable]","word": "fuckable","double":false},
			{"substitute": "[loveass]","word": "fuckass","double":false},
			{"substitute": "[loved]","word": "fucked","double":false},
			{"substitute": "[loven]","word": "fucken","double":false},
			{"substitute": "[lover]","word": "fucker","double":false},
			{"substitute": "[lovers]","word": "fuckers","double":false},
			{"substitute": "[lovin]","word": "fuckin","double":false},
			{"substitute": "[loving]","word": "fucking","double":false},
			{"substitute": "[loves]","word": "fucks","double":false},
			{"substitute": "[love]","word": "fvck","double":false},
			{"substitute": "[hand]","word": "handjob","double":false},
			{"substitute": "[holy]","word": "holyshit","double":false},
			{"substitute": "[fluid]","word": "jizz","double":false},
			{"substitute": "[mother]","word": "motherfucker","double":false},
			{"substitute": "[group]","word": "orgy","double":false},
			{"substitute": "[urine]","word": "piss","double":false},
			{"substitute": "[mad]","word": "pissed","double":false},
			{"substitute": "[urinating]","word": "pissing","double":false},
			{"substitute": "[turd]","word": "shit","double":false},
			{"substitute": "[crap]","word": "shite","double":false},
			{"substitute": "[crap]","word": "thefuck","double":false},
			{"substitute": "[breast]","word": "tit","double":false},
			{"substitute": "[pathetic]","word": "whore","double":false},
			{"substitute": "[mean]","word": "nigga","double":false},
			{"substitute": "[mean]","word": "nigger","double":false},
			{"substitute": "[love]","word": "lesbian","double":false},
			{"substitute": "[love]","word": "lesbo","double":false},
			{"substitute": "[love]","word": "fyck","double":false},
			{"substitute": "[love]","word": "milf","double":false},
			{"substitute": "[love]","word": "pron","double":false},
			{"substitute": "[love]","word": "pussy","double":false},
			{"substitute": "[love]","word": "pussylicker","double":false},
			{"substitute": "[love]","word": "pussyeater","double":false},
			{"substitute": "[love]","word": "sex","double":false},
			{"substitute": "[love]","word": "sexy","double":false},
			{"substitute": "[love]","word": "porn","double":false},
			{"substitute": "[love]","word": "xxx","double":false},
			{"substitute": "[love]","word": ".xxx","double":false},
			{"substitute": "[insult]","word": "sexist","double":false},
			{"substitute": "[assult]","word": "sexual","double":false},
			{"substitute": "[assult]","word": "rape","double":false},
			{"substitute": "[assult]","word": "raper","double":false},
			{"substitute": "[assult]","word": "rapist","double":false},
			{"substitute": "[poop]","word": "shitting","double":false},
			{"substitute": "[poop]","word": "shitter","double":false},
			{"substitute": "[poop]","word": "sht","double":false},
			{"substitute": "[female]","word": "vagina","double":false},

	
		],
		textHistory: [],
		wordDates:[{date: currentDate, wordHist: []}]	
	}
});