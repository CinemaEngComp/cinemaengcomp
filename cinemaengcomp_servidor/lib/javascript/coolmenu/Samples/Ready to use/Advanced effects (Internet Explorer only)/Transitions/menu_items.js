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
	/*,
	fadeIn:'progid:DXImageTransform.Microsoft.Fade(duration=0.3)',
	fadeOut:'progid:DXImageTransform.Microsoft.Fade(duration=0.3)'*/
};

var MENU_ITEMS = [
	{pos:[10,10], delay:[200, 800], itemoff:[0,99], leveloff:[21,0], style:STYLE, size:[22,100]},
	{code:"Fade in",
		sub:[
			{itemoff:[21,0], levelFilters:[ 'progid:DXImageTransform.Microsoft.Fade(duration=0.3)', null ]},
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
	{code:"Fade out",
		sub:[
			{itemoff:[21,0], levelFilters:[ null, 'progid:DXImageTransform.Microsoft.Fade(duration=0.3)' ]},
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
	{code:"Fade in/out",
		sub:[
			{itemoff:[21,0], levelFilters:[ 'progid:DXImageTransform.Microsoft.Fade(duration=0.3)', 'progid:DXImageTransform.Microsoft.Fade(duration=0.3)' ]},
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
	{code:"Pixelate",
		sub:[
			{itemoff:[21,0], levelFilters:[ 'progid:DXImageTransform.Microsoft.Pixelate(duration=0.3)', 'progid:DXImageTransform.Microsoft.Pixelate(duration=0.3)' ]},
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
	{code:"Dissolve",
		sub:[
			{itemoff:[21,0], levelFilters:[ 'progid:DXImageTransform.Microsoft.RandomDissolve(duration=0.3)', 'progid:DXImageTransform.Microsoft.RandomDissolve(duration=0.3)' ]},
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
	{code:"Wipe",
		sub:[
			{itemoff:[21,0], levelFilters:[ 'progid:DXImageTransform.Microsoft.GradientWipe(GradientSize=0.25,wipestyle=0,motion=forward,duration=0.5)', 'progid:DXImageTransform.Microsoft.GradientWipe(GradientSize=0.25,wipestyle=0,motion=forward,duration=0.5)' ]},
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
