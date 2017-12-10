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
	{code:"Item 1",
		sub:[
			{leveloff:[21,0]},
			{code:"Item 2",
				sub:[
					{leveloff:[21,0]},
					{code:"Item 3"},
					{code:"Item 4"},
					{code:"Item 5"}
				]
			},
			{code:"Item 6",
				sub:[
					{leveloff:[21,-99]},
					{code:"Item 7"},
					{code:"Item 8"},
					{code:"Item 9"}
				]
			},
			{code:"Item 10",
				sub:[
					{leveloff:[21,-198]},
					{code:"Item 11"},
					{code:"Item 12"},
					{code:"Item 13"}
				]
			}
		]
	},
	{code:"Item 13",
		sub:[
			{leveloff:[21,-99]},
			{code:"Item 14",
				sub:[
					{leveloff:[21,0]},
					{code:"Item 15"},
					{code:"Item 16"},
					{code:"Item 17"}
				]
			},
			{code:"Item 18",
				sub:[
					{leveloff:[21,-99]},
					{code:"Item 19"},
					{code:"Item 20"},
					{code:"Item 21"}
				]
			},
			{code:"Item 22",
				sub:[
					{leveloff:[21,-198]},
					{code:"Item 23"},
					{code:"Item 24"},
					{code:"Item 25"}
				]
			}
		]
	},
	{code:"Item 26",
		sub:[
			{leveloff:[21,-198]},
			{code:"Item 27",
				sub:[
					{leveloff:[21,0]},
					{code:"Item 28"},
					{code:"Item 29"},
					{code:"Item 30"}
				]
			},
			{code:"Item 31",
				sub:[
					{leveloff:[21,-99]},
					{code:"Item 32"},
					{code:"Item 33"},
					{code:"Item 34"}
				]
			},
			{code:"Item 35",
				sub:[
					{leveloff:[21,-198]},
					{code:"Item 36"},
					{code:"Item 37"},
					{code:"Item 38"}
				]
			}
		]
	}
];
