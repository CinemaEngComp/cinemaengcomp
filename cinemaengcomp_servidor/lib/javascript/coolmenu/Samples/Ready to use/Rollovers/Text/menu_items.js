BLANK_IMAGE = 'images/b.gif';

var STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"white",		// background color for the items
		bgOVER:"white"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOn",		// CSS class for items
		OVER:"clsCMOver"	// CSS class  for item which is under mouse
	}
};

var MENU_ITEMS = [
	{pos:[10,10], itemoff:[21,0], leveloff:[0,99], style:STYLE, size:[22,100]},
	{code:"Item 1",
		sub:[
			{},
			{code:"SubItem 1", ocode:"SubItem <u>1</u>"},
			{code:"SubItem 2", ocode:"SubItem <u>2</u>"},
			{code:"SubItem 3", ocode:"SubItem <u>3</u>"},
			{code:"SubItem 4", ocode:"SubItem <u>4</u>"}
		]
	},
	{code:"Item 2",
		sub:[
			{},
			{code:"SubItem 1", ocode:"- SubItem 1 -"},
			{code:"SubItem 2", ocode:"- SubItem 2 -"},
			{code:"SubItem 3", ocode:"- SubItem 3 -"},
			{code:"SubItem 4", ocode:"- SubItem 4 -"}
		]
	},
	{code:"Item 3",
		sub:[
			{},
			{code:"SubItem 1", ocode:"[ SubItem 1 ]"},
			{code:"SubItem 2", ocode:"[ SubItem 2 ]"},
			{code:"SubItem 3", ocode:"[ SubItem 3 ]"},
			{code:"SubItem 4", ocode:"[ SubItem 4 ]"}
		]
	}
];
