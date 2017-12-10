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

var RED_STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"#FFE0E0",		// background color for the items
		bgOVER:"#FF0000"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOn",		// CSS class for items
		OVER:"clsCMOver"	// CSS class  for item which is under mouse
	}
};

var GREEN_STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"#E0FFE0",		// background color for the items
		bgOVER:"#008000"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOn",		// CSS class for items
		OVER:"clsCMOver"	// CSS class  for item which is under mouse
	}
};

var BLUE_STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"#E0E0FF",		// background color for the items
		bgOVER:"#0000FF"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOn",		// CSS class for items
		OVER:"clsCMOver"	// CSS class  for item which is under mouse
	}
};

var MENU_ITEMS = [
	{pos:[10,10], itemoff:[21,0], leveloff:[0,99], style:STYLE, size:[22,100]},
	{code:"Red items",
		sub:[
			{style:RED_STYLE},
			{code:"SubItem 1",
				sub:[
					{},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 2",
				sub:[
					{},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 3",
				sub:[
					{},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			}
		]
	},
	{code:"Green items",
		sub:[
			{style:GREEN_STYLE},
			{code:"Red items",
				sub:[
					{style:RED_STYLE},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"Green items",
				sub:[
					{style:GREEN_STYLE},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"Blue items",
				sub:[
					{style:BLUE_STYLE},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			}
		]
	},
	{code:"Mixed items",
		sub:[
			{},
			{code:"SubItem 1", format:{style:RED_STYLE},
				sub:[
					{},
					{code:"SubSubItem 1", format:{style:BLUE_STYLE}},
					{code:"SubSubItem 2", format:{style:GREEN_STYLE}},
					{code:"SubSubItem 3", format:{style:RED_STYLE}}
				]
			},
			{code:"SubItem 2", format:{style:GREEN_STYLE},
				sub:[
					{},
					{code:"SubSubItem 1", format:{style:RED_STYLE}},
					{code:"SubSubItem 2", format:{style:BLUE_STYLE}},
					{code:"SubSubItem 3", format:{style:GREEN_STYLE}}
				]
			},
			{code:"SubItem 3", format:{style:BLUE_STYLE},
				sub:[
					{},
					{code:"SubSubItem 1", format:{style:RED_STYLE}},
					{code:"SubSubItem 2", format:{style:GREEN_STYLE}},
					{code:"SubSubItem 3", format:{style:BLUE_STYLE}}
				]
			}
		]
	}
];
