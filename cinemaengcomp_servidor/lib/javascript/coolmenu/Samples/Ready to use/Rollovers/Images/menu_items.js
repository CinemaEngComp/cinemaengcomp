BLANK_IMAGE = 'images/b.gif';

var STYLE = {
	border:0,			// item's border width, pixels; zero means "none"
	shadow:0,			// item's shadow size, pixels; zero means "none"
	color:{
		border:"",		// color of the item border, if any
		shadow:"",		// color of the item shadow, if any
		bgON:"",		// background color for the items
		bgOVER:""		// background color for the item which is under mouse right now
	},
	css:{
		ON:"",			// CSS class for items
		OVER:""			// CSS class  for item which is under mouse
	}
};

var MENU_ITEMS = [
	{pos:[10,10], itemoff:[24,0], leveloff:[0,111], style:STYLE, size:[24,111]},
	{code:'<img src="images/item1.gif" width="111" height="24" />',
		ocode:'<img src="images/item1o.gif" width="111" height="24" />',
		sub:[
			{},
			{code:'<img src="images/subitem1.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem1o.gif" width="111" height="24" />'},
			{code:'<img src="images/subitem2.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem2o.gif" width="111" height="24" />'},
			{code:'<img src="images/subitem3.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem3o.gif" width="111" height="24" />'}
		]
	},
	{code:'<img src="images/item2.gif" width="111" height="24" />',
		ocode:'<img src="images/item2o.gif" width="111" height="24" />',
		sub:[
			{},
			{code:'<img src="images/subitem1.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem1o.gif" width="111" height="24" />'},
			{code:'<img src="images/subitem2.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem2o.gif" width="111" height="24" />'},
			{code:'<img src="images/subitem3.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem3o.gif" width="111" height="24" />'}
		]
	},
	{code:'<img src="images/item3.gif" width="111" height="24" />',
		ocode:'<img src="images/item3o.gif" width="111" height="24" />',
		sub:[
			{},
			{code:'<img src="images/subitem1.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem1o.gif" width="111" height="24" />'},
			{code:'<img src="images/subitem2.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem2o.gif" width="111" height="24" />'},
			{code:'<img src="images/subitem3.gif" width="111" height="24" />',
				ocode:'<img src="images/subitem3o.gif" width="111" height="24" />'}
		]
	}
];
