BLANK_IMAGE = 'images/b.gif';

var NOSTYLE = {
	border:0,
	shadow:0,
	color:{
		border:"",
		shadow:"",
		bgON:"",
		bgOVER:""
	},
	css:{
		ON:"",
		OVER:""
	}
};

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
	{pos:[24,28], itemoff:[0,99], leveloff:[0,0], style:NOSTYLE, size:[22,100]},
	{code:"",
		sub:[
			{itemoff:[21,0], leveloff:[21,0], style:STYLE},
			{code:"SubItem 1",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 2",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 3",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			}
		]
	},
	{code:"", format:{itemoff:[35,54]},
		sub:[
			{itemoff:[21,0], leveloff:[21,0], style:STYLE},
			{code:"SubItem 1",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 2",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 3",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			}
		]
	},
	{code:"", format:{itemoff:[-28,77]},
		sub:[
			{itemoff:[21,0], leveloff:[21,0], style:STYLE},
			{code:"SubItem 1",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 2",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 3",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			}
		]
	},
	{code:"", format:{itemoff:[37,46]},
		sub:[
			{itemoff:[21,0], leveloff:[21,0], style:STYLE},
			{code:"SubItem 1",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 2",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			},
			{code:"SubItem 3",
				sub:[
					{leveloff:[0,99]},
					{code:"SubSubItem 1"},
					{code:"SubSubItem 2"},
					{code:"SubSubItem 3"}
				]
			}
		]
	}
];
