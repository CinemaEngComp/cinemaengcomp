function TimStatus(message) {
    status=message;
}


function changeSTATUS(message) {
    status=message;
    setTimeout('TimStatus("'+message+'")',1);
}


var isNN = (navigator.appName.indexOf("Netscape")!=-1);

function autoTab(input,len, e) {
var keyCode = (isNN) ? e.which : e.keyCode; 
var filter = (isNN) ? [0,8,9] : [0,8,9,16,17,18,37,38,39,40,46];
if(input.value.length >= len && !containsElement(filter,keyCode)) {
input.value = input.value.slice(0, len);
input.form[(getIndex(input)+1) % input.form.length].focus();
}

function containsElement(arr, ele) {
var found = false, index = 0;
while(!found && index < arr.length)
if(arr[index] == ele)
found = true;
else
index++;
return found;
}

function getIndex(input) {
var index = -1, i = 0, found = false;
while (i < input.form.length && index == -1)
if (input.form[i] == input)index = i;
else i++;
return index;
}
return true;
}


function isEmpty(s) {
	return ((s == null) || (s.length == 0))
}

function isDigitDouble (c)
{   return ( ((c >= "0") && (c <= "9")) || (c == ".") || (c == ",") )
}

function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}

function isDouble (s)
{   var i;
    if (isEmpty(s)) 
       if (isDouble.arguments.length == 1) return defaultEmptyOK;
       else return (isDouble.arguments[1] == true);
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (!isDigitDouble(c)) return false;
    }
    return true;
}

function isWhitespace (s)

{   var i;
    if (isEmpty(s)) return true;
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (whitespace.indexOf(c) == -1) return false;
    }
    return true;
}

function isInteger (s)
{   var i;
    if (isEmpty(s)) 
       if (isInteger.arguments.length == 1) return defaultEmptyOK;
       else return (isInteger.arguments[1] == true);
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (!isDigit(c)) return false;
    }
    return true;
}

function abrePOP(link,w,h){
	det = "'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=no, top=0, left=0, width="+w+",height="+h+"'";
	window.open(link,'',det);
}

function varToFlashSoundPlayer(id,arq,tit){
   var sendFILE = arq;
   window.document.getElementById(id).SetVariable("caminho", sendFILE);
}

function showLAYER(id,posX,posY) {

	document.getElementById(id).visible = true;
	document.getElementById(id).left = 50;
	document.getElementById(id).top = 50;

}

function confirmDELETE(link) {
	if (confirm('Deseja excluir o registro ???')){
		window.location.href = link;
	}
}

function isNUMB(c)	{

	if((cx=c.indexOf(","))!=-1)
		{		
		c = c.substring(0,cx)+"."+c.substring(cx+1);
		}
	if((parseFloat(c) / c != 1))
		{
		if(parseFloat(c) * c == 0)
			{
			return(1);
			}
		else
			{
			return(0);
			}
		}
	else
		{
		return(1);
		}
}

function LIMP(c)	{
	while((cx=c.indexOf("-"))!=-1)
		{		
		c = c.substring(0,cx)+c.substring(cx+1);
		}
	while((cx=c.indexOf("/"))!=-1)
		{		
		c = c.substring(0,cx)+c.substring(cx+1);
		}
	while((cx=c.indexOf(","))!=-1)
		{		
		c = c.substring(0,cx)+c.substring(cx+1);
		}
	while((cx=c.indexOf("."))!=-1)
		{		
		c = c.substring(0,cx)+c.substring(cx+1);
		}
	while((cx=c.indexOf("("))!=-1)
		{		
		c = c.substring(0,cx)+c.substring(cx+1);
		}
	while((cx=c.indexOf(")"))!=-1)
		{		
		c = c.substring(0,cx)+c.substring(cx+1);
		}
	while((cx=c.indexOf(" "))!=-1)
		{		
		c = c.substring(0,cx)+c.substring(cx+1);
		}
	return(c);
}

function VerifyCNPJ(CNPJ)	{
	CNPJ = LIMP(CNPJ);
	if(isNUMB(CNPJ) != 1)
		{
		return(0);
		}
	else
		{
		if(CNPJ == 0)
			{
			return(0);
			}
		else
			{
			g=CNPJ.length-2;
			if(RealTestaCNPJ(CNPJ,g) == 1)
				{
				g=CNPJ.length-1;
				if(RealTestaCNPJ(CNPJ,g) == 1)
					{	
					return(1);
					}
				else
					{
					return(0);
					}
				}
			else
				{
				return(0);
				}
			}
		}
}
function RealTestaCNPJ(CNPJ,g)	{
	var VerCNPJ=0;
	var ind=2;
	var tam;
	for(f=g;f>0;f--)
		{
		VerCNPJ+=parseInt(CNPJ.charAt(f-1))*ind;
		if(ind>8)
			{
			ind=2;
			}
		else
			{
			ind++;
			}
		}
		VerCNPJ%=11;
		if(VerCNPJ==0 || VerCNPJ==1)
			{
			VerCNPJ=0;
			}
		else
			{
			VerCNPJ=11-VerCNPJ;
			}
	if(VerCNPJ!=parseInt(CNPJ.charAt(g)))
		{
		return(0);
		}
	else
		{
		return(1);
		}
}

function FormataCGC(Formulario, Campo, TeclaPres) 
  { 
    var tecla = TeclaPres.keyCode; 
    var strCampo; 
    var vr; 
    var tam; 
    var TamanhoMaximo = 14; 
  
    eval("strCampo = document." + Formulario + "." + Campo); 
  
    vr = strCampo.value; 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace(",", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    tam = vr.length; 

    if (tam < TamanhoMaximo && tecla != 8) 
    { 
      tam = vr.length + 1; 
    } 

    if (tecla == 8) 
    { 
      tam = tam - 1; 
    } 

    if (tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105) 
    { 
      if (tam <= 2) 
      { 
        strCampo.value = vr; 
      } 
       if ((tam > 2) && (tam <= 6)) 
       { 
         strCampo.value = vr.substr(0, tam - 2) + '-' + vr.substr(tam - 2, tam); 
       } 
       if ((tam >= 7) && (tam <= 9)) 
       { 
         strCampo.value = vr.substr(0, tam - 6) + '/' + vr.substr(tam - 6, 4) + '-' + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 10) && (tam <= 12)) 
       { 
         strCampo.value = vr.substr(0, tam - 9) + '.' + vr.substr(tam - 9, 3) + '/' + vr.substr(tam - 6, 4) + '-' + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 13) && (tam <= 14)) 
       { 
         strCampo.value = vr.substr(0, tam - 12) + '.' + vr.substr(tam - 12, 3) + '.' + vr.substr(tam - 9, 3) + '/' + vr.substr(tam - 6, 4) + '-' + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 15) && (tam <= 17)) 
       { 
         strCampo.value = vr.substr(0, tam - 14) + '.' + vr.substr(tam - 14, 3) + '.' + vr.substr(tam - 11, 3) + '.' + vr.substr(tam - 8, 3) + '.' + vr.substr(tam - 5, 3) + '-' + vr.substr(tam - 2, tam); 
      } 
    } 
  } 


