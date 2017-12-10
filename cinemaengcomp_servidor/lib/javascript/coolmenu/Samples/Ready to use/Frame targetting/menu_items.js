BLANK_IMAGE = 'images/b.gif';

var STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"white",		// background color for the items
		bgOVER:"#B6BDD2"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOn",		// CSS class for items
		OVER:"clsCMOver"	// CSS class  for item which is under mouse
	}
};

var MENU_ITEMS = [
	{pos:[10,10], itemoff:[0,99], leveloff:[21,0], style:STYLE, size:[22,100]},
	{code:"This frame",
		sub:[
			{itemoff:[21,0]},
			{code:"Google", url:"http://www.google.com/"},
			{code:"Lycos", url:"http://www.lycos.com/"},
			{code:"Yahoo!", url:"http://www.yahoo.com/"}
		]
	},
	{code:"Other frame",
		sub:[
			{itemoff:[21,0]},
			{code:"Google", url:"http://www.google.com/", target:"contents"},
			{code:"Lycos", url:"http://www.lycos.com/", target:"contents"},
			{code:"Yahoo!", url:"http://www.yahoo.com/", target:"contents"}
		]
	},
	{code:"New window",
		sub:[
			{itemoff:[21,0]},
			{code:"Google", url:"http://www.google.com/", target:"_blank"},
			{code:"Lycos", url:"http://www.lycos.com/", target:"_blank"},
			{code:"Yahoo!", url:"http://www.yahoo.com/", target:"_blank"}
		]
	}
];
