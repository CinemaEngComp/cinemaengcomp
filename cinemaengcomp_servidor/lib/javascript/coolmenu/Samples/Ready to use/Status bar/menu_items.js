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
	{pos:[10,10], itemoff:[21,0], leveloff:[0,129], style:STYLE, size:[22,130]},
	{code:"Custom status",
		sub:[
			{},
			{code:"SubItem 1", status:'First subitem.'},
			{code:"SubItem 2", status:'Second subitem.'},
			{code:"SubItem 3", status:'Third subitem.'}
		]	
	},
	{code:"code:'...' as status",
		sub:[
			{status:'code'},
			{code:"SubItem 1"},
			{code:"SubItem 2"},
			{code:"SubItem 3"}
		]	
	},
	{code:"url:'...' as status",
		sub:[
			{status:'url'},
			{code:"SubItem 1", url:'http://www.google.com'},
			{code:"SubItem 2", url:'http://www.lycos.com'},
			{code:"SubItem 3", url:'http://www.yahoo.com'}
		]	
	}
];
