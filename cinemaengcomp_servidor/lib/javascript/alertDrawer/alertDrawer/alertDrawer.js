/*
	for this code to appear correctly, be sure to style the "alertDrawer" div that the 
	drawer functions generate; sample CSS would be:
	#alertDrawer {
		text-align: center;
		background-color: #fff;
		z-index: 999;
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		font-size: 200%;
		font-weight: bold;
		color: #000;
	}
	#alertDrawer p {
		padding: 1em 3em;
	}
*/
/*
	alertDrawer is the replacement for the JavaScript "alert('this is the text');" function,
	and is called in exactly the same way: "alertDrawer('this is the text');"
*/
function alertDrawer(theText) {
	openDrawer(theText);
}

/*
	confirmDrawer is the replacement for the JavaScript "confirm('are you sure?');" function,
	but is called a little differently: "confirmDrawer('are you sure?','doSomething');" is the call,
	where 'are you sure?' is the text you want to display, and 'doSomething' is the name of the
	function you want to pass information to.  The function you pass information to needs to be
	able to take a Boolean value; this value is determined by whether the user has pressed
	"OK" (which passes) or "Cancel" (which passes a False).
	To get a better idea of how this works, try this script on a page that has this code on it:
	<a href="#" onclick="confirmDrawer('Do you want to proceed?','cheesePuffs'); return false">test</a>
*/
function confirmDrawer(theText,theFunction) {
	openDrawer(theText,theFunction);
}

//this is just a dummy function to test the confirmDrawer functionality
function cheesePuffs(theValue) {
	if (theValue) {
		alert('You confirmed');
	} else {
		alert('You cancelled');
	}
}

function createAlertDiv() {
	var theBody = document.getElementsByTagName("body")[0];
	var theAlertDiv = document.createElement("div");
	theAlertDiv.setAttribute('id','alertDrawer');
	theAlertDiv.style.display = 'none';
	theBody.appendChild(theAlertDiv);
}

function openDrawer(theText,confirmFunction) {
	if (!document.getElementById("alertDrawer")) {
		if (!document.getElementsByTagName || (!document.getElementById || (!document.createElement || !document.createTextNode))) {
			alert(theText);
			return false;
		} else {
			createAlertDiv();
		}
	}
	var theAlertDiv = document.getElementById("alertDrawer");
	clearKids(theAlertDiv);
	var alertP = document.createElement("p");
	alertP.appendChild(document.createTextNode(theText));
	theAlertDiv.appendChild(alertP);
	setCurrentTop('alertDrawer');
	if (confirmFunction != null) {
		var confirmForm = document.createElement("form");
		var confirmProceed = document.createElement("input");
		confirmProceed.setAttribute('type','button');
		confirmProceed.setAttribute('value','Sim');
		confirmProceed.onclick = function(){processConfirm(confirmFunction,'true');};
		confirmForm.appendChild(confirmProceed);
		confirmForm.appendChild(document.createTextNode(" "));
		var confirmCancel = document.createElement("input");
		confirmCancel.setAttribute('type','button');
		confirmCancel.setAttribute('value','Não');
		confirmForm.appendChild(confirmCancel);
		confirmCancel.onclick = function(){processConfirm(confirmFunction,'false');};
		alertP.appendChild(confirmForm);
	} else {
		var theReadTime = getReadTime(theText);
		if (theReadTime < 3000) {
			theReadTime = 3000; //so that we don't put the message away before the fade is over
		}
		var theTimer = setTimeout(listenForMouseMove, theReadTime);
	}
	//the following two lines are dependent upon the presence of the script.aculo.us libraries
	var theBlind = new Effect.BlindDown('alertDrawer', {duration:0.5});
	var theFade = new Effect.Opacity('alertDrawer', {duration:3.0, from:1.0, to:0.7});
	window.onscroll = function(){setCurrentTop('alertDrawer');};
}

function processConfirm(theFunction,theValue) {
	eval(theFunction+'('+theValue+');');
	closeDrawer();
}

function setCurrentTop(theElement) {
	var thisElement = document.getElementById(theElement);
	var theTop = 0;
	if (window.innerHeight) {
		theTop = window.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop) {
		theTop = document.documentElement.scrollTop;
	} else if (document.body) {
		theTop = document.body.scrollTop;
	}
	thisElement.style.top = theTop+"px";
}

function clearKids(theElement) {
	while (theElement.firstChild) {
		theElement.removeChild(theElement.firstChild);
	}
}

function getReadTime(theText) {
	var theWords = theText.split(/\s+/g);
	var theSeconds = Math.ceil(theWords.length/4); //average human reading speed is 4 words per second
	return theSeconds * 1000;
}

function listenForMouseMove() {
	document.onmousemove = closeDrawer;
}

function closeDrawer() {
	document.onmousemove = null;
	window.onscroll = null;
	if (document.getElementById("alertDrawer")) {
		//the following line is dependent upon the presence of script.aculo.us
		var theBlind = new Effect.BlindUp('alertDrawer', {duration:0.5});
	}
}