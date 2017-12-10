BLANK_IMAGE = 'images/b.gif';

var STYLE = {
	border:1,			// item's border width, pixels; zero means "none"
	shadow:0,			// item's shadow size, pixels; zero means "none"
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
	{pos:[10,10], delay:[200, 800], itemoff:[0,99], leveloff:[21,0], style:STYLE, size:[22,100]},
	{code:"Transparency",
		sub:[
			{itemoff:[21,0], levelFilters:'progid:DXImageTransform.Microsoft.Alpha(opacity=40)'},
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
	{code:"Shadow",
		sub:[
			{itemoff:[21,0], levelFilters:'progid:DXImageTransform.Microsoft.Shadow(direction=135,color=#aaaaaa,strength=3)'},
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
	{code:"Waves",
		sub:[
			{itemoff:[21,0], levelFilters:'progid:DXImageTransform.Microsoft.Wave(freq=1,LightStrength=10,Phase=-17,Strength=5)'},
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
	{code:"Combined",
		sub:[
			{itemoff:[21,0], levelFilters:'progid:DXImageTransform.Microsoft.Alpha(opacity=60) progid:DXImageTransform.Microsoft.Shadow(direction=135,color=#CCCCCC,strength=5) progid:DXImageTransform.Microsoft.Wave(freq=1,LightStrength=10,Phase=-17,Strength=5)'},
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
