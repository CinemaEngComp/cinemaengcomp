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
	{pos:[10,10], itemoff:[21,0], leveloff:[0,99], style:STYLE, size:[22,100]},
	{code:"Relative URLS",
		sub:[
			{},
			{code:"In this file", url:"#sectionName"},
			{code:"Other file", url:"other.html"},
			{code:"Other folder", url:"../other_folder/file.html"}
		]	
	},
	{code:"GET Queries",
		sub:[
			{},
			{code:"Same file", url:"?parameter1=value1"},
			{code:"Other file", url:"some_script.php?parameter2=value2"}
		]	
	},
	{code:"Absolute URLS",
		sub:[
			{},
			{code:"Same server", url:"/some_folder/some_file.html"},
			{code:"Other server", url:"http://www.other-server.com/some_file.html"}
		]	
	},
	{code:"Other protocols",
		sub:[
			{},
			{code:"HTTPS", url:"https://www.secure-server.com/"},
			{code:"FTP", url:"ftp://sunsite.unc.edu/"},
			{code:"E-mail", url:"mailto:somebody@somewhere.com"}
		]	
	},
	{code:"JavaScript",
		sub:[
			{},
			{code:"Function call", url:"javascript:void(alert('Function has been called.'))"}
		]	
	}
];
