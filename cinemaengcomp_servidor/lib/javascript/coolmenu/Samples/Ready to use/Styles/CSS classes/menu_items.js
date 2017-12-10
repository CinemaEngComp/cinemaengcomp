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
		bgON:"white",		// background color for the items
		bgOVER:"#B6BDD2"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOnRed",	// CSS class for items
		OVER:"clsCMOverRed"	// CSS class  for item which is under mouse
	}
};

var GREEN_STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"white",		// background color for the items
		bgOVER:"#B6BDD2"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOnGreen",	// CSS class for items
		OVER:"clsCMOverGreen"	// CSS class  for item which is under mouse
	}
};

var BLUE_STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"white",		// background color for the items
		bgOVER:"#B6BDD2"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOnBlue",	// CSS class for items
		OVER:"clsCMOverBlue"	// CSS class  for item which is under mouse
	}
};

var CENTERED_STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"white",		// background color for the items
		bgOVER:"#B6BDD2"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOnCentered",	// CSS class for items
		OVER:"clsCMOverCentered"// CSS class  for item which is under mouse
	}
};

var IMAGED_STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:2,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"#666666",	// color of the item border, if any
		shadow:"#DBD8D1",	// color of the item shadow, if any
		bgON:"white",		// background color for the items
		bgOVER:"#B6BDD2"	// background color for the item which is under mouse right now
	},
	css:{
		ON:"clsCMOnImaged",	// CSS class for items
		OVER:"clsCMOverImaged"	// CSS class  for item which is under mouse
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
	},
	{code:"Centered items",
		sub:[
			{style:CENTERED_STYLE},
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
	{code:"Bg. image",
		sub:[
			{style:IMAGED_STYLE},
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
	}
];
