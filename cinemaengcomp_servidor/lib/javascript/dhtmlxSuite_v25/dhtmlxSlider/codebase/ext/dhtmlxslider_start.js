//v.2.5 build 090904

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/
function dhx_init_sliders(){var z=document.getElementsByTagName("input");for (var i=0;i<z.length;i++)if (z[i].className=="dhtmlxSlider"){var n=z[i];var pos=n.getAttribute("position")||"over";var d=document.createElement("DIV");d.style.width=n.offsetWidth+"px";d.style.height=n.offsetHeight+"px";n.parentNode.insertBefore(d,n);if (pos=="over")n.style.display="none";else{var x=document.createElement("DIV");var w=Math.round(n.offsetWidth/3);if (w>50)w=50

 x.style.width=n.offsetWidth-w+"px";d.style.position="relative";x.style[(pos=="left")?"right":"left"]=x.style.top=n.style.top=n.style[pos]="0px";x.style.position=n.style.position="absolute";n.style.width=w+"px";x.style.height=n.offsetHeight+"px";d.appendChild(n);d.appendChild(x);d=x};var l=new dhtmlxSlider(d,d.offsetWidth,(n.getAttribute("skin")||""),false,(n.getAttribute("min")||""),(n.getAttribute("max")||""),(n.value),(n.getAttribute("step")||""));l.linkTo(n);l.init()}};if (window.addEventListener)window.addEventListener("load",dhx_init_sliders,false);else if (window.attachEvent)window.attachEvent("onload",dhx_init_sliders);




//v.2.5 build 090904

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/