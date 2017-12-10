<!-- Original:  Fabiano Vanucci -->
var script_current_url='';
var script_current_target='';
var script_postfunction;
var script_current_url_popup='';
var script_current_target_popup='';
function NUCCI_AJAX_RefreshLastPage() {
	NUCCI_AJAX_GetPage(script_current_url,script_current_target);
}
function NUCCI_AJAX_GetPage(url,target,postfunction) {
		script_current_url=url;
		script_current_target=target;
		script_postfunction=postfunction;
		indicatorNucciLoading_SHOW('visible')
		new Ajax.Request(url, { method: 'get'
			  ,onComplete: GetOK
			  ,onError  : GetNOTOK
			  ,timeout  : 120
		});
}
function NUCCI_AJAX_GetPage_background(url,target) {
		script_current_url_popup	=url;
		script_current_target_popup	=target;
//		indicatorNucciLoading_SHOW('visible')
		new Ajax.Request(url, { method: 'get'
			  ,onComplete: GetOK_background
			  ,onError  : GetNOTOK_background
			  ,timeout  : 120
		});
}

function GetNOTOK (transport){
	indicatorNucciLoading_SHOW('hidden');
	showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico ');
	
}
function GetNOTOK_background (transport){
//	indicatorNucciLoading_SHOW('hidden');
//	showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico ');
	
}
function GetOK_background (transport){
	if (200 == transport.status) {
		if (""==transport.responseText) {
//			showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (PHP#1).');
		} else {
			document.getElementById(script_current_target_popup).innerHTML=transport.responseText;
		}
	}  else {
//		showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (4)='+transport.status);
	}	
}	
function GetOK (transport){
	indicatorNucciLoading_SHOW('hidden');
	if (200 == transport.status) {
		indicatorNucciLoading_SHOW('hidden');
		if (""==transport.responseText) {
			showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (PHP#1).');
		} else {
			document.getElementById(script_current_target).innerHTML=transport.responseText;
			if ("function"==typeof(script_postfunction)) {
				script_postfunction.call(this,null);
			}
		}
	}  else {
		showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (4)='+transport.status);
	}	
}	
	function NUCCI_AJAX_GetPage_popup(url,target) {
		script_current_url_popup=url;
		script_current_target_popup=target;

		indicatorNucciLoading_SHOW('visible')
		new Ajax.Request(url, { method: 'get'
//			  ,onLoading: function(request){indicatorNucciLoading_SHOW('visible');}
			  ,onComplete: GetOK_popup
			  ,onError  : GetNOTOK_popup
			  ,timeout  : 120
		});
	}

function GetOK_popup (transport){
	indicatorNucciLoading_SHOW('hidden');
	if (200 == transport.status) {
		indicatorNucciLoading_SHOW('hidden');
		if (""==transport.responseText) {
			alert('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (2)='+transport.status);
		} else {
			document.getElementById(script_current_target_popup).innerHTML=transport.responseText;
		}
	} else {
		alert('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (3)='+transport.status);
	}
}

function GetNOTOK_popup (transport){
	indicatorNucciLoading_SHOW('hidden');
	alert('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (PHP#4).');
}


function showERROR(msg) {
	alert(msg);
}
function doonShow_LARANJA() {
	document.getElementById('overlay_modal').style.backgroundColor="#FF9900";
//	document.getElementById('dialog_buttons').style.backgroundColor="#FF9900";
//	document.getElementById('dialog_buttons').style.visible=false;
}
function doonShow_VERDE() {
	document.getElementById('overlay_modal').style.backgroundColor="#00FF00";
}
function doonShow_ROXO() {
	document.getElementById('overlay_modal').style.backgroundColor="#9102AE";
}
function doonShow_AZUL() {
	document.getElementById('overlay_modal').style.backgroundColor="#0000FF";
}
function doonShow_VERMELHO() {
	document.getElementById('overlay_modal').style.backgroundColor="#FF0000";
}
function doonShow_BRANCO() {
	document.getElementById('overlay_modal').style.backgroundColor="#FFFFFF";
}
function doonShow_PRETO() {
	document.getElementById('overlay_modal').style.backgroundColor="#000000";
}
function doNULL() {

}


<!-- Original: Richard Gorremans (RichardG@spiritwolfx.com) ==>
<!-- Updates: www.spiritwolfx.com

// Check browser version
var isNav4 = false, isNav5 = false, isIE4 = false
var strSeperator = "/"; 
// If you are using any Java validation on the back side you will want to use the / because 
// Java date validations do not recognize the dash as a valid date separator.

var vDateType = 3; // Global value for type of date format
//                1 = mm/dd/yyyy
//                2 = yyyy/dd/mm  (Unable to do date check at this time)
//                3 = dd/mm/yyyy

var vYearType = 4; //Set to 2 or 4 for number of digits in the year for Netscape
var vYearLength = 4; // Set to 4 if you want to force the user to enter 4 digits for the year before validating.

var err = 0; // Set the error code to a default of zero


if(navigator.appName == "Netscape") 
{
   if (navigator.appVersion < "5")  
   {
      isNav4 = true;
      isNav5 = false;
	}
   else
   if (navigator.appVersion > "4") 
   {
      isNav4 = false;
      isNav5 = true;
	}
}
else  
{
   isIE4 = true;
}


function DateFormat(vDateName, vDateValue, e, dateCheck, dateType)  {

vDateType = dateType;
mDateValue = vDateValue;

// vDateName = object name
// vDateValue = value in the field being checked
// e = event
// dateCheck 
//       True  = Verify that the vDateValue is a valid date
//       False = Format values being entered into vDateValue only
// vDateType
//       1 = mm/dd/yyyy
//       2 = yyyy/mm/dd
//       3 = dd/mm/yyyy

   
   //Enter a tilde sign for the first number and you can check the variable information.
   if (vDateValue == "~")
   {
      alert("AppVersion = "+navigator.appVersion+" \nNav. 4 Version = "+isNav4+" \nNav. 5 Version = "+isNav5+" \nIE Version = "+isIE4+" \nYear Type = "+vYearType+" \nDate Type = "+vDateType+" \nSeparator = "+strSeperator);
      vDateName.value = "";
      vDateName.focus();
      return true;
   }
      
   var whichCode = (window.Event) ? e.which : e.keyCode;
 
   // Check to see if a seperator is already present.
   // bypass the date if a seperator is present and the length greater than 8
   if (vDateValue.length > 8 && isNav4)
   {
      if ((vDateValue.indexOf("-") >= 1) || (vDateValue.indexOf("/") >= 1))
         return true;
   }
   
   //Eliminate all the ASCII codes that are not valid
   var alphaCheck = " abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/-";
   if (alphaCheck.indexOf(vDateValue.charAt(vDateValue.length-1)) >= 1)  
   {
      if (isNav4)
      {
         vDateName.value = "";
         vDateName.focus();
         vDateName.select();
         return false;
      }
      else
      {
         vDateName.value = vDateName.value.substr(0, (vDateValue.length-1));
         return false;
      } 
   }
   if (whichCode == 8) //Ignore the Netscape value for backspace. IE has no value
      return false;
   else 
   {
      //Create numeric string values for 0123456789/
      //The codes provided include both keyboard and keypad values
      
      var strCheck = 'undefined,0,47,48,49,50,51,52,53,54,55,56,57,58,59,65,95,96,97,98,99,100,101,102,103,104,105';
      if (strCheck.indexOf(whichCode) != -1)  
      {
         if (isNav4)  
         {
            if (((vDateValue.length < 6 && dateCheck) || (vDateValue.length == 7 && dateCheck)) && (vDateValue.length >=1))
            {
               alert("Data Inválida\nDigite novamente.");
               vDateName.value = "";
               vDateName.focus();
               vDateName.select();
               return false;
            }
            if (vDateValue.length == 6 && dateCheck)  
            {
               var mDay = vDateName.value.substr(2,2);
               var mMonth = vDateName.value.substr(0,2);
               var mYear = vDateName.value.substr(4,4)
               
               //Turn a two digit year into a 4 digit year
               if (mYear.length == 2 && vYearType == 4) 
               {
                  var mToday = new Date();
                  
                  //If the year is greater than 30 years from now use 19, otherwise use 20
                  var checkYear = mToday.getFullYear() + 30; 
                  var mCheckYear = '20' + mYear;
                  if (mCheckYear >= checkYear)
                     mYear = '19' + mYear;
                  else
                     mYear = '20' + mYear;
               }
               var vDateValueCheck = mMonth+strSeperator+mDay+strSeperator+mYear;
               
               if (!dateValid(vDateValueCheck))  
               {
                  alert("Data Inválida\nDigite novamente.");
                  vDateName.value = "";
                  vDateName.focus();
                  vDateName.select();
                  return false;
		         }
               vDateName.value = vDateValueCheck;
               return true;
            
            }
            else
            {
               // Reformat the date for validation and set date type to a 1
               
               
               if (vDateValue.length >= 8  && dateCheck)  
               {
                  if (vDateType == 1) // mmddyyyy
                  {
                     var mDay = vDateName.value.substr(2,2);
                     var mMonth = vDateName.value.substr(0,2);
                     var mYear = vDateName.value.substr(4,4)
                     vDateName.value = mMonth+strSeperator+mDay+strSeperator+mYear;
                  }
                  if (vDateType == 2) // yyyymmdd
                  {
                     var mYear = vDateName.value.substr(0,4)
                     var mMonth = vDateName.value.substr(4,2);
                     var mDay = vDateName.value.substr(6,2);
                     vDateName.value = mYear+strSeperator+mMonth+strSeperator+mDay;
                  }
                  if (vDateType == 3) // ddmmyyyy
                  {
                     var mMonth = vDateName.value.substr(2,2);
                     var mDay = vDateName.value.substr(0,2);
                     var mYear = vDateName.value.substr(4,4)
                     vDateName.value = mDay+strSeperator+mMonth+strSeperator+mYear;
                  }
                  
                  //Create a temporary variable for storing the DateType and change
                  //the DateType to a 1 for validation.
                  
                  var vDateTypeTemp = vDateType;
                  vDateType = 1;
                  var vDateValueCheck = mMonth+strSeperator+mDay+strSeperator+mYear;
                  
                  if (!dateValid(vDateValueCheck))  
                  {
                     alert("Data Inválida\nDigite novamente.");
                     vDateType = vDateTypeTemp;
                     vDateName.value = "";
                     vDateName.focus();
                     vDateName.select();
                     return false;
		            }
                     vDateType = vDateTypeTemp;
                     return true;
	            }
               else
               {
                  if (((vDateValue.length < 8 && dateCheck) || (vDateValue.length == 9 && dateCheck)) && (vDateValue.length >=1))
                  {
                     alert("Data Inválida\nDigite novamente.");
                     vDateName.value = "";
                     vDateName.focus();
                     vDateName.select();
                     return false;
                  }
               }
            }
         }
         else  
         {
         // Non isNav Check
            if (((vDateValue.length < 8 && dateCheck) || (vDateValue.length == 9 && dateCheck)) && (vDateValue.length >=1))
            {
               alert("Data Inválida\nDigite novamente.");
               vDateName.value = "";
               vDateName.focus();
               return true;
            }
            
            // Reformat date to format that can be validated. mm/dd/yyyy
            
            
            if (vDateValue.length >= 8 && dateCheck)  
            {
            
               // Additional date formats can be entered here and parsed out to
               // a valid date format that the validation routine will recognize.
               
               if (vDateType == 1) // mm/dd/yyyy
               {
                  var mMonth = vDateName.value.substr(0,2);
                  var mDay = vDateName.value.substr(3,2);
                  var mYear = vDateName.value.substr(6,4)
               }
               if (vDateType == 2) // yyyy/mm/dd
               {
                  var mYear = vDateName.value.substr(0,4)
                  var mMonth = vDateName.value.substr(5,2);
                  var mDay = vDateName.value.substr(8,2);
               }
               if (vDateType == 3) // dd/mm/yyyy
               {
                  var mDay = vDateName.value.substr(0,2);
                  var mMonth = vDateName.value.substr(3,2);
                  var mYear = vDateName.value.substr(6,4)
               }
               if (vYearLength == 4)
               {
                  if (mYear.length < 4)
                  {
                     alert("Data Inválida\nDigite novamente.");
                     vDateName.value = "";
                     vDateName.focus();
                     return true;
                  }
               }
               
               // Create temp. variable for storing the current vDateType
               var vDateTypeTemp = vDateType;
               
               // Change vDateType to a 1 for standard date format for validation
               // Type will be changed back when validation is completed.
               vDateType = 1;
               
               // Store reformatted date to new variable for validation.
               var vDateValueCheck = mMonth+strSeperator+mDay+strSeperator+mYear;
               
               if (mYear.length == 2 && vYearType == 4 && dateCheck)  
               {
                  
                  //Turn a two digit year into a 4 digit year
                  var mToday = new Date();
                  
                  //If the year is greater than 30 years from now use 19, otherwise use 20
                  var checkYear = mToday.getFullYear() + 30; 
                  var mCheckYear = '20' + mYear;
                  if (mCheckYear >= checkYear)
                     mYear = '19' + mYear;
                  else
                     mYear = '20' + mYear;
                  vDateValueCheck = mMonth+strSeperator+mDay+strSeperator+mYear;
                  
                  // Store the new value back to the field.  This function will
                  // not work with date type of 2 since the year is entered first.
                  
                  if (vDateTypeTemp == 1) // mm/dd/yyyy
                     vDateName.value = mMonth+strSeperator+mDay+strSeperator+mYear;
                  if (vDateTypeTemp == 3) // dd/mm/yyyy
                     vDateName.value = mDay+strSeperator+mMonth+strSeperator+mYear;

               } 
               
               
               if (!dateValid(vDateValueCheck))  
               {
                  alert("Data Inválida\nDigite novamente.");
                  vDateType = vDateTypeTemp;
                  vDateName.value = "";
                  vDateName.focus();
                  return true;
		         }
               vDateType = vDateTypeTemp;
               return true;
            
            }
            else
            {
               
               if (vDateType == 1)
               {
                  if (vDateValue.length == 2)  
                  {
                     vDateName.value = vDateValue+strSeperator;
                  }
                  if (vDateValue.length == 5)  
                  {
                     vDateName.value = vDateValue+strSeperator;
                  }
               }
               if (vDateType == 2)
               {
                  if (vDateValue.length == 4)  
                  {
                     vDateName.value = vDateValue+strSeperator;
                  }
                  if (vDateValue.length == 7)  
                  {
                     vDateName.value = vDateValue+strSeperator;
                  }
               } 
               if (vDateType == 3)
               {
                  if (vDateValue.length == 2)  
                  {
                     vDateName.value = vDateValue+strSeperator;
                  }
                  if (vDateValue.length == 5)  
                  {
                     vDateName.value = vDateValue+strSeperator;
                  }
               }
               return true;
            }
         }
         if (vDateValue.length == 10   && dateCheck)  
         {
            if (!dateValid(vDateName))  
            {
// Un-comment the next line of code for debugging the dateValid() function error messages
//               alert(err);  
               alert("Data Inválida\nDigite novamente.");
               vDateName.focus();
               vDateName.select();
	         }
         }
         return false;
      }
      else  
      {
         // If the value is not in the string return the string minus the last
         // key entered.
         if (isNav4)
         {
            vDateName.value = "";
            vDateName.focus();
            vDateName.select();
            return false;
         }
         else
         {
			if (whichCode != 16){
	            vDateName.value = vDateName.value.substr(0, (vDateValue.length-1));
			}
            return false;
         }
		}
	}
}


   function dateValid(objName) {
      var strDate;
      var strDateArray;
      var strDay;
      var strMonth;
      var strYear;
      var intday;
      var intMonth;
      var intYear;
      var booFound = false;
      var datefield = objName;
      var strSeparatorArray = new Array("-"," ","/",".");
      var intElementNr;
      // var err = 0;
      var strMonthArray = new Array(12);
      strMonthArray[0] = "Jan";
      strMonthArray[1] = "Feb";
      strMonthArray[2] = "Mar";
      strMonthArray[3] = "Apr";
      strMonthArray[4] = "May";
      strMonthArray[5] = "Jun";
      strMonthArray[6] = "Jul";
      strMonthArray[7] = "Aug";
      strMonthArray[8] = "Sep";
      strMonthArray[9] = "Oct";
      strMonthArray[10] = "Nov";
      strMonthArray[11] = "Dec";
      
      //strDate = datefield.value;
      strDate = objName;
      
      if (strDate.length < 1) {
         return true;
      }
      for (intElementNr = 0; intElementNr < strSeparatorArray.length; intElementNr++) {
         if (strDate.indexOf(strSeparatorArray[intElementNr]) != -1) 
         {
            strDateArray = strDate.split(strSeparatorArray[intElementNr]);
            if (strDateArray.length != 3) 
            {
               err = 1;
               return false;
            }
            else 
            {
               strDay = strDateArray[0];
               strMonth = strDateArray[1];
               strYear = strDateArray[2];
            }
            booFound = true;
         }
      }
      if (booFound == false) {
         if (strDate.length>5) {
            strDay = strDate.substr(0, 2);
            strMonth = strDate.substr(2, 2);
            strYear = strDate.substr(4);
         }
      }
      //Adjustment for short years entered
      if (strYear.length == 2) {
         strYear = '20' + strYear;
      }
      strTemp = strDay;
      strDay = strMonth;
      strMonth = strTemp;
      intday = parseInt(strDay, 10);
      if (isNaN(intday)) {
         err = 2;
         return false;
      }
      
      intMonth = parseInt(strMonth, 10);
      if (isNaN(intMonth)) {
         for (i = 0;i<12;i++) {
            if (strMonth.toUpperCase() == strMonthArray[i].toUpperCase()) {
               intMonth = i+1;
               strMonth = strMonthArray[i];
               i = 12;
            }
         }
         if (isNaN(intMonth)) {
            err = 3;
            return false;
         }
      }
      intYear = parseInt(strYear, 10);
      if (isNaN(intYear)) {
         err = 4;
         return false;
      }
      if (intMonth>12 || intMonth<1) {
         err = 5;
         return false;
      }
      if ((intMonth == 1 || intMonth == 3 || intMonth == 5 || intMonth == 7 || intMonth == 8 || intMonth == 10 || intMonth == 12) && (intday > 31 || intday < 1)) {
         err = 6;
         return false;
      }
      if ((intMonth == 4 || intMonth == 6 || intMonth == 9 || intMonth == 11) && (intday > 30 || intday < 1)) {
         err = 7;
         return false;
      }
      if (intMonth == 2) {
         if (intday < 1) {
            err = 8;
            return false;
         }
         if (LeapYear(intYear) == true) {
            if (intday > 29) {
               err = 9;
               return false;
            }
         }
         else {
            if (intday > 28) {
               err = 10;
               return false;
            }
         }
      }
         return true;
      }

   function LeapYear(intYear) {
      if (intYear % 100 == 0) {
         if (intYear % 400 == 0) { return true; }
      }
      else {
         if ((intYear % 4) == 0) { return true; }
      }
         return false;
      }




function getNextElement (field) {
  var form = field.form;
  for (var e = 0; e < form.elements.length; e++)
    if (field == form.elements[e])
      break;
  return form.elements[++e % form.elements.length];
}
function tabOnEnter (field, evt) {
  var keyCode = document.layers ? evt.which : document.all ? 
evt.keyCode : evt.keyCode;
  if (keyCode != 13)
    return true;
  else {
    getNextElement(field).focus();
    return false;
  }
}

var defaultEmptyOK = false
var whitespace = " \t\n\r";

function isAlphaDigit (c)
{   return ( ((c >= "a") && (c <= "z")) || ((c >= "A") && (c <= "Z")))
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
function isDigitCurrency (c)
{   return ( ((c >= "0") && (c <= "9")) || (c==".")  || (c==",") || (c=="-"))
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

function isWhitespace (s) {
	var reWhitespace = /^\s+$/
	
  return (isEmpty(s) || reWhitespace.test(s));
	var i;
	var whitespace = " \t\n\r";
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
function isCurrency (s)
{   var i;
    if (isEmpty(s)) 
       if (isCurrency.arguments.length == 1) return defaultEmptyOK;
       else return (isCurrency.arguments[1] == true);
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (!isDigitCurrency(c)) return false;
    }
    return true;
}

function check_date(field){

var checkstr = "0123456789";
var DateField = field;
var Datevalue = "";
var DateTemp = "";
var seperator = ".";
var day;
var month;
var year;
var leap = 0;
var err = 0;
var i;

   err = 0;

//   DateValue = DateField.value;
   DateValue = field;

   /* Delete all chars except 0..9 */
   for (i = 0; i < DateValue.length; i++) {
	  if (checkstr.indexOf(DateValue.substr(i,1)) >= 0) {
	     DateTemp = DateTemp + DateValue.substr(i,1);
	  }
   }
   DateValue = DateTemp;
   /* Always change date to 8 digits - string*/
   /* if year is entered as 2-digit / always assume 20xx */
   if (DateValue.length == 6) {
      DateValue = DateValue.substr(0,4) + '20' + DateValue.substr(4,2); }
   if (DateValue.length != 8) {
      err = 19;}
   /* year is wrong if year = 0000 */
   year = DateValue.substr(4,4);
   if (year == 0) {
      err = 20;
   }
   /* Validation of month*/
   month = DateValue.substr(2,2);
   if ((month < 1) || (month > 12)) {
      err = 21;
   }
   /* Validation of day*/
   day = DateValue.substr(0,2);
   if (day < 1) {
     err = 22;
   }
   /* Validation leap-year / february / day */
   if ((year % 4 == 0) || (year % 100 == 0) || (year % 400 == 0)) {
      leap = 1;
   }
   if ((month == 2) && (leap == 1) && (day > 29)) {
      err = 23;
   }
   if ((month == 2) && (leap != 1) && (day > 28)) {
      err = 24;
   }
   /* Validation of other months */
   if ((day > 31) && ((month == "01") || (month == "03") || (month == "05") || (month == "07") || (month == "08") || (month == "10") || (month == "12"))) {
      err = 25;
   }
   if ((day > 30) && ((month == "04") || (month == "06") || (month == "09") || (month == "11"))) {
      err = 26;
   }
   /* if 00 ist entered, no error, deleting the entry */
   if ((day == 0) && (month == 0) && (year == 00)) {
      err = 0; day = ""; month = ""; year = ""; seperator = "";
   }
   /* if no error, write the completed date to Input-Field (e.g. 13.12.2001) */
   if (err == 0) {
//      DateField.value = day + seperator + month + seperator + year;
    return true;

   }
   /* Error-message if err != 0 */
   else {
//      alert("Date is incorrect!");
//      DateField.select();
//	  DateField.focus();
        return false;
   }
   
}
	function checkCHAR(e) {
		var strCheck = '0123456789';
		var whichCode = (window.Event) ? e.which: e.keyCode ;
		if (whichCode == 13) return true;  // TECLA Enter
		key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
		if (strCheck.indexOf(key) == -1) {
			return false;  // NAUM EH UMA TECLA VALIDA
		}
		return true;
	}
	function checkCHAR_NUM(e) {
		var strCheck = '0123456789,.';
		var whichCode = (window.Event) ? e.which: window.event.keyCode ;
		if (whichCode == 13) return true;  // TECLA Enter
		key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
		if (strCheck.indexOf(key) == -1) {
			return false;  // NAUM EH UMA TECLA VALIDA
		}
		return true;
	}
	function checkCHAR_NUM_IE(e) {
		var strCheck = '0123456789,.';
		var whichCode = window.event.keyCode;
		if (whichCode == 13) return true;  // TECLA Enter
		key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
		if (strCheck.indexOf(key) == -1) {
			return false;  // NAUM EH UMA TECLA VALIDA
		}
		return true;
	}
function checkCHAR_IE(e) {
	var strCheck = '0123456789';
//	var whichCode = (window.Event) ? e.which : e.keyCode;
	var whichCode = window.event.keyCode;
	if (whichCode == 13) return true;  // Enter
	key = String.fromCharCode(whichCode);  // Get key value from key code
	if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
}


function Trim(TRIM_VALUE){
if(TRIM_VALUE.length < 1){
return"";
}
TRIM_VALUE = RTrim(TRIM_VALUE);
TRIM_VALUE = LTrim(TRIM_VALUE);
if(TRIM_VALUE==""){
return "";
}
else{
return TRIM_VALUE;
}
}

function RTrim(VALUE){
var w_space = String.fromCharCode(32);
var v_length = VALUE.length;
var strTemp = "";
if(v_length < 0){
return"";
}
var iTemp = v_length -1;

while(iTemp > -1){
if(VALUE.charAt(iTemp) == w_space){
}
else{
strTemp = VALUE.substring(0,iTemp +1);
break;
}
iTemp = iTemp-1;

} //End While
return strTemp;

} //End Function

function LTrim(VALUE){
var w_space = String.fromCharCode(32);
if(v_length < 1){
return"";
}
var v_length = VALUE.length;
var strTemp = "";

var iTemp = 0;

while(iTemp < v_length){
if(VALUE.charAt(iTemp) == w_space){
}
else{
strTemp = VALUE.substring(iTemp,v_length);
break;
}
iTemp = iTemp + 1;
} //End While
return strTemp;
} //End Function


  function checkCR(evt) {

    var evt  = (evt) ? evt : ((event) ? event : null);

    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);

    if ((evt.keyCode == 13) && (node.type=="text")) {return false;}

  }
  document.onkeypress = checkCR;  

function isPlaca (s)
{
   var defaultEmptyOK=false;
   var i;

    if (isEmpty(s)) 
       if (isPlaca.arguments.length == 1) return defaultEmptyOK;
       else return (isPlaca.arguments[1] == true);

	var c = s.charAt(0);
    if (!isAlphaDigit(c)) return false;
	var c = s.charAt(1);
    if (!isAlphaDigit(c)) return false;
	var c = s.charAt(2);
    if (!isAlphaDigit(c)) return false;

	var c = s.charAt(3);
    if (!isDigit(c)) return false;
	var c = s.charAt(4);
    if (!isDigit(c)) return false;
	var c = s.charAt(5);
    if (!isDigit(c)) return false;
	var c = s.charAt(6);
    if (!isDigit(c)) return false;

    return true;
}
function URLEncode(meuvalor) {
	// The Javascript escape and unescape functions do not correspond
	// with what browsers actually do...
	var SAFECHARS = "0123456789" +					// Numeric
					"ABCDEFGHIJKLMNOPQRSTUVWXYZ" +	// Alphabetic
					"abcdefghijklmnopqrstuvwxyz" +
					"-_.!~*'()";					// RFC2396 Mark characters
	var HEX = "0123456789ABCDEF";

	var plaintext = meuvalor;
	var encoded = "";
	for (var i = 0; i < plaintext.length; i++ ) {
		var ch = plaintext.charAt(i);
	    if (ch == " ") {
		    encoded += "+";				// x-www-urlencoded, rather than %20
		} else if (SAFECHARS.indexOf(ch) != -1) {
		    encoded += ch;
		} else {
		    var charCode = ch.charCodeAt(0);
			if (charCode > 255) {
			    alert( "Unicode Character '" 
                        + ch 
                        + "' cannot be encoded using standard URL encoding.\n" +
				          "(URL encoding only supports 8-bit characters.)\n" +
						  "A space (+) will be substituted." );
				encoded += "+";
			} else {
				encoded += "%";
				encoded += HEX.charAt((charCode >> 4) & 0xF);
				encoded += HEX.charAt(charCode & 0xF);
			}
		}
	} // for

	return encoded;
};
function generateKey() {     return -1;}
function integerFormat(fld, milSep, decSep, e) {
var sep = 0;
var key = '';
var i = j = 0;
var len = len2 = 0;
var strCheck = '0123456789';
var aux = aux2 = '';
var whichCode = (window.Event) ? e.which : e.keyCode;
if (whichCode == 13) return false;  // Enter
key = String.fromCharCode(whichCode);  // Get key value from key code
if (strCheck.indexOf(key) == -1) { 
//	alert('INVALIDO'+whichCode+'-'+e.which+'-'+e.keyCode);
	return false;  // Not a valid key
}	
len = fld.value.length;
for(i = 0; i < len; i++)
if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
aux = '';
for(; i < len; i++)
if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
aux += key;
len = aux.length;
if (len == 0) fld.value = '';
if (len == 1) fld.value = '0'+ decSep + '0' + aux;
if (len == 2) fld.value = '0'+ decSep + aux;
if (len > 2) {
aux2 = '';
for (j = 0, i = len - 3; i >= 0; i--) {
if (j == 3) {
aux2 += milSep;
j = 0;
}
aux2 += aux.charAt(i);
j++;
}
fld.value = '';
len2 = aux2.length;
for (i = len2 - 1; i >= 0; i--)
fld.value += aux2.charAt(i);
fld.value += decSep + aux.substr(len - 2, len);
}
return false;
 }
 
function currencyFormat(fld, milSep, decSep, e) {
var sep = 0;
var key = '';
var i = j = 0;
var len = len2 = 0;
var strCheck = '0123456789';
var aux = aux2 = '';
var whichCode = (window.Event) ? e.which : e.keyCode;
if (whichCode == 13) return false;  // Enter
key = String.fromCharCode(whichCode);  // Get key value from key code
if (strCheck.indexOf(key) == -1) { 
//	alert('INVALIDO'+whichCode+'-'+e.which+'-'+e.keyCode);
	return false;  // Not a valid key
}	
len = fld.value.length;
for(i = 0; i < len; i++)
if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
aux = '';
for(; i < len; i++)
if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
aux += key;
len = aux.length;
if (len == 0) fld.value = '';
if (len == 1) fld.value = '0'+ decSep + '0' + aux;
if (len == 2) fld.value = '0'+ decSep + aux;
if (len > 2) {
aux2 = '';
for (j = 0, i = len - 3; i >= 0; i--) {
if (j == 3) {
aux2 += milSep;
j = 0;
}
aux2 += aux.charAt(i);
j++;
}
fld.value = '';
len2 = aux2.length;
for (i = len2 - 1; i >= 0; i--)
fld.value += aux2.charAt(i);
fld.value += decSep + aux.substr(len - 2, len);
}
return false;
}
function currencyFormat_only_ie(fld, milSep, decSep, e) {
var sep = 0;
var key = '';
var i = j = 0;
var len = len2 = 0;
var strCheck = '0123456789';
var aux = aux2 = '';

var whichCode =  e.keyCode;
if (whichCode == 13) return false;  // Enter
key = String.fromCharCode(whichCode);  // Get key value from key code
if (strCheck.indexOf(key) == -1) { 
 //alert('INVALIDO'+whichCode+'-'+e.which+'-'+e.keyCode);
 return false;  // Not a valid key
} 
len = fld.value.length;
for(i = 0; i < len; i++)
if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
aux = '';
for(; i < len; i++)
if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
aux += key;
len = aux.length;
if (len == 0) fld.value = '';
if (len == 1) fld.value = '0'+ decSep + '0' + aux;
if (len == 2) fld.value = '0'+ decSep + aux;
if (len > 2) {
aux2 = '';
for (j = 0, i = len - 3; i >= 0; i--) {
if (j == 3) {
aux2 += milSep;
j = 0;
}
aux2 += aux.charAt(i);
j++;
}
fld.value = '';
len2 = aux2.length;
for (i = len2 - 1; i >= 0; i--)
fld.value += aux2.charAt(i);
fld.value += decSep + aux.substr(len - 2, len);
}
return false;
}

function formatCurrency(num) {
num = num.toString().replace(/\$|\,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+'.'+
num.substring(num.length-(4*i+3));
return (((sign)?'':'-') + '$' + num + ',' + cents);
}
function formatCurrency2(num) {
num = num.toString().replace(/\$|\,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+'.'+
num.substring(num.length-(4*i+3));
return (((sign)?'':'-') + '' + num + ',' + cents);
}
function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}
function format_moeda(dValor) {
	return "R$"+sprintf("%10.2f",dValor);
}

function format_moeda2(num) {
	num = num.toString().replace(/\$|\,/g,'');
}

function ajustVALUEFROM(valor) {
		valor1 = valor.replace(/,/, '.');
		return valor1;
}

function Fix_Float_Integer(valor) {
//		nucci_debug('nucci_debug_cargaonline','ajustVALUEFROMGRID_Integer:'+valor);
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
}
function Fix_Float_Valor(valor) {
//		nucci_debug('nucci_debug_cargaonline','ajustVALUEFROMGRID_Float:'+valor);
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
}

/**
*
*  URL encode / decode
*  http://www.webtoolkit.info/
*
**/

var Url = {

	// public method for url encoding
	encode : function (string) {
		return escape(this._utf8_encode(string));
	},

	// public method for url decoding
	decode : function (string) {
		return this._utf8_decode(unescape(string));
	},

	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c > 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c < 127) && (c > 2048)) {
				utftext += String.fromCharCode((c << 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c << 12) | 224);
				utftext += String.fromCharCode(((c << 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i > utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c > 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c < 191) && (c > 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) >> 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) >> 12) | ((c2 & 63) >> 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}

}

// ====================================================================
//       URLEncode and URLDecode functions
//
// Copyright Albion Research Ltd. 2002
// http://www.albionresearch.com/
//
// You may copy these functions providing that 
// (a) you leave this copyright notice intact, and 
// (b) if you use these functions on a publicly accessible
//     web site you include a credit somewhere on the web site 
//     with a link back to http://www.albionresearch.com/
//
// If you find or fix any bugs, please let us know at albionresearch.com
//
// SpecialThanks to Neelesh Thakur for being the first to
// report a bug in URLDecode() - now fixed 2003-02-19.
// And thanks to everyone else who has provided comments and suggestions.
// ====================================================================
function URLEncode(plaintext)
{
	// The Javascript escape and unescape functions do not correspond
	// with what browsers actually do...
	var SAFECHARS = "0123456789" +					// Numeric
					"ABCDEFGHIJKLMNOPQRSTUVWXYZ" +	// Alphabetic
					"abcdefghijklmnopqrstuvwxyz" +
					"-_.!~*'()";					// RFC2396 Mark characters
	var HEX = "0123456789ABCDEF";

	var encoded = "";
	for (var i = 0; i < plaintext.length; i++ ) {
		var ch = plaintext.charAt(i);
	    if (ch == " ") {
		    encoded += "+";				// x-www-urlencoded, rather than %20
		} else if (SAFECHARS.indexOf(ch) != -1) {
		    encoded += ch;
		} else {
		    var charCode = ch.charCodeAt(0);
			if (charCode > 255) {
			    alert( "Unicode Character '" 
                        + ch 
                        + "' cannot be encoded using standard URL encoding.\n" +
				          "(URL encoding only supports 8-bit characters.)\n" +
						  "A space (+) will be substituted." );
				encoded += "+";
			} else {
				encoded += "%";
				encoded += HEX.charAt((charCode >> 4) & 0xF);
				encoded += HEX.charAt(charCode & 0xF);
			}
		}
	} // for

	return encoded;
};

function URLDecode(encoded )
{
   // Replace + with ' '
   // Replace %xx with equivalent character
   // Put [ERROR] in output if %xx is invalid.
   var HEXCHARS = "0123456789ABCDEFabcdef"; 
   var plaintext = "";
   var i = 0;
   while (i < encoded.length) {
       var ch = encoded.charAt(i);
	   if (ch == "+") {
	       plaintext += " ";
		   i++;
	   } else if (ch == "%") {
			if (i < (encoded.length-2) 
					&& HEXCHARS.indexOf(encoded.charAt(i+1)) != -1 
					&& HEXCHARS.indexOf(encoded.charAt(i+2)) != -1 ) {
				plaintext += unescape( encoded.substr(i,3) );
				i += 3;
			} else {
				alert( 'Bad escape combination near ...' + encoded.substr(i) );
				plaintext += "%[ERROR]";
				i++;
			}
		} else {
		   plaintext += ch;
		   i++;
		}
	} // while
   return plaintext;
};
var MONTH_NAMES=new Array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro','Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez');var DAY_NAMES=new Array('Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Dom','Seg','Ter','Qua','Qui','Sex','Sab');
function LZ(x){return(x<0||x>9?"":"0")+x}
function isDate(val,format){var date=getDateFromFormat(val,format);if(date==0){return false;}return true;}
function compareDates(date1,dateformat1,date2,dateformat2){var d1=getDateFromFormat(date1,dateformat1);var d2=getDateFromFormat(date2,dateformat2);if(d1==0 || d2==0){return -1;}else if(d1 > d2){return 1;} else if(d1 < d2){return 2;}return 0;}
function formatDate(date,format){format=format+"";var result="";var i_format=0;var c="";var token="";var y=date.getYear()+"";var M=date.getMonth()+1;var d=date.getDate();var E=date.getDay();var H=date.getHours();var m=date.getMinutes();var s=date.getSeconds();var yyyy,yy,MMM,MM,dd,hh,h,mm,ss,ampm,HH,H,KK,K,kk,k;var value=new Object();if(y.length < 4){y=""+(y-0+1900);}value["y"]=""+y;value["yyyy"]=y;value["yy"]=y.substring(2,4);value["M"]=M;value["MM"]=LZ(M);value["MMM"]=MONTH_NAMES[M-1];value["NNN"]=MONTH_NAMES[M+11];value["d"]=d;value["dd"]=LZ(d);value["E"]=DAY_NAMES[E+7];value["EE"]=DAY_NAMES[E];value["H"]=H;value["HH"]=LZ(H);if(H==0){value["h"]=12;}else if(H>12){value["h"]=H-12;}else{value["h"]=H;}value["hh"]=LZ(value["h"]);if(H>11){value["K"]=H-12;}else{value["K"]=H;}value["k"]=H+1;value["KK"]=LZ(value["K"]);value["kk"]=LZ(value["k"]);if(H > 11){value["a"]="PM";}else{value["a"]="AM";}value["m"]=m;value["mm"]=LZ(m);value["s"]=s;value["ss"]=LZ(s);while(i_format < format.length){c=format.charAt(i_format);token="";while((format.charAt(i_format)==c) &&(i_format < format.length)){token += format.charAt(i_format++);}if(value[token] != null){result=result + value[token];}else{result=result + token;}}return result;}
function _isInteger(val){var digits="1234567890";for(var i=0;i < val.length;i++){if(digits.indexOf(val.charAt(i))==-1){return false;}}return true;}
function _getInt(str,i,minlength,maxlength){for(var x=maxlength;x>=minlength;x--){var token=str.substring(i,i+x);if(token.length < minlength){return null;}if(_isInteger(token)){return token;}}return null;}
function getDateFromFormat(val,format){val=val+"";format=format+"";var i_val=0;var i_format=0;var c="";var token="";var token2="";var x,y;var now=new Date();var year=now.getYear();var month=now.getMonth()+1;var date=1;var hh=now.getHours();var mm=now.getMinutes();var ss=now.getSeconds();var ampm="";while(i_format < format.length){c=format.charAt(i_format);token="";while((format.charAt(i_format)==c) &&(i_format < format.length)){token += format.charAt(i_format++);}if(token=="yyyy" || token=="yy" || token=="y"){if(token=="yyyy"){x=4;y=4;}if(token=="yy"){x=2;y=2;}if(token=="y"){x=2;y=4;}year=_getInt(val,i_val,x,y);if(year==null){return 0;}i_val += year.length;if(year.length==2){if(year > 70){year=1900+(year-0);}else{year=2000+(year-0);}}}else if(token=="MMM"||token=="NNN"){month=0;for(var i=0;i<MONTH_NAMES.length;i++){var month_name=MONTH_NAMES[i];if(val.substring(i_val,i_val+month_name.length).toLowerCase()==month_name.toLowerCase()){if(token=="MMM"||(token=="NNN"&&i>11)){month=i+1;if(month>12){month -= 12;}i_val += month_name.length;break;}}}if((month < 1)||(month>12)){return 0;}}else if(token=="EE"||token=="E"){for(var i=0;i<DAY_NAMES.length;i++){var day_name=DAY_NAMES[i];if(val.substring(i_val,i_val+day_name.length).toLowerCase()==day_name.toLowerCase()){i_val += day_name.length;break;}}}else if(token=="MM"||token=="M"){month=_getInt(val,i_val,token.length,2);if(month==null||(month<1)||(month>12)){return 0;}i_val+=month.length;}else if(token=="dd"||token=="d"){date=_getInt(val,i_val,token.length,2);if(date==null||(date<1)||(date>31)){return 0;}i_val+=date.length;}else if(token=="hh"||token=="h"){hh=_getInt(val,i_val,token.length,2);if(hh==null||(hh<1)||(hh>12)){return 0;}i_val+=hh.length;}else if(token=="HH"||token=="H"){hh=_getInt(val,i_val,token.length,2);if(hh==null||(hh<0)||(hh>23)){return 0;}i_val+=hh.length;}else if(token=="KK"||token=="K"){hh=_getInt(val,i_val,token.length,2);if(hh==null||(hh<0)||(hh>11)){return 0;}i_val+=hh.length;}else if(token=="kk"||token=="k"){hh=_getInt(val,i_val,token.length,2);if(hh==null||(hh<1)||(hh>24)){return 0;}i_val+=hh.length;hh--;}else if(token=="mm"||token=="m"){mm=_getInt(val,i_val,token.length,2);if(mm==null||(mm<0)||(mm>59)){return 0;}i_val+=mm.length;}else if(token=="ss"||token=="s"){ss=_getInt(val,i_val,token.length,2);if(ss==null||(ss<0)||(ss>59)){return 0;}i_val+=ss.length;}else if(token=="a"){if(val.substring(i_val,i_val+2).toLowerCase()=="am"){ampm="AM";}else if(val.substring(i_val,i_val+2).toLowerCase()=="pm"){ampm="PM";}else{return 0;}i_val+=2;}else{if(val.substring(i_val,i_val+token.length)!=token){return 0;}else{i_val+=token.length;}}}if(i_val != val.length){return 0;}if(month==2){if( ((year%4==0)&&(year%100 != 0) ) ||(year%400==0) ){if(date > 29){return 0;}}else{if(date > 28){return 0;}}}if((month==4)||(month==6)||(month==9)||(month==11)){if(date > 30){return 0;}}if(hh<12 && ampm=="PM"){hh=hh-0+12;}else if(hh>11 && ampm=="AM"){hh-=12;}var newdate=new Date(year,month-1,date,hh,mm,ss);return newdate.getTime();}
function parseDate(val){var preferEuro=(arguments.length==2)?arguments[1]:false;generalFormats=new Array('y-M-d','MMM d, y','MMM d,y','y-MMM-d','d-MMM-y','MMM d');monthFirst=new Array('M/d/y','M-d-y','M.d.y','MMM-d','M/d','M-d');dateFirst =new Array('d/M/y','d-M-y','d.M.y','d-MMM','d/M','d-M');var checkList=new Array('generalFormats',preferEuro?'dateFirst':'monthFirst',preferEuro?'monthFirst':'dateFirst');var d=null;for(var i=0;i<checkList.length;i++){var l=window[checkList[i]];for(var j=0;j<l.length;j++){d=getDateFromFormat(val,l[j]);if(d!=0){return new Date(d);}}}return null;}

function ValidaData(objeto,formato) {
var checkformato='dd/MM/yyyy';
if (""!=formato) {checkformato=formato;}
if( (!isDate(objeto.value,checkformato)) &&  (''!=objeto.value)) {  
	objeto.value="";
	alert('Data inválida. Digite novamente.');
	objeto.focus();
} 
if(2==compareDates(HOJE,'dd/MM/yyyy',objeto.value,formato)) {
	objeto.value="";
	alert('Data não pode ser no futuro. Digite novamente.');
	objeto.focus();
}
}
/**
 * @author Márcio d'Ávila
 * @version 1.01, 2004
 *
 * PROTÓTIPOS:
 * método String.lpad(int pSize, char pCharPad)
 * método String.trim()
 *
 * String unformatNumber(String pNum)
 * String formatCpfCnpj(String pCpfCnpj, boolean pUseSepar, boolean pIsCnpj)
 * String dvCpfCnpj(String pEfetivo, boolean pIsCnpj)
 * boolean isCpf(String pCpf)
 * boolean isCnpj(String pCnpj)
 * boolean isCpfCnpj(String pCpfCnpj)
 */


NUM_DIGITOS_CPF  = 11;
NUM_DIGITOS_CNPJ = 14;
NUM_DGT_CNPJ_BASE = 8;


/**
 * Adiciona método lpad() à classe String.
 * Preenche a String à esquerda com o caractere fornecido,
 * até que ela atinja o tamanho especificado.
 */
String.prototype.lpad = function(pSize, pCharPad)
{
	var str = this;
	var dif = pSize - str.length;
	var ch = String(pCharPad).charAt(0);
	for (; dif>0; dif--) str = ch + str;
	return (str);
} //String.lpad


/**
 * Adiciona método trim() à classe String.
 * Elimina brancos no início e fim da String.
 */
String.prototype.trim = function()
{
	return this.replace(/^\s*/, "").replace(/\s*$/, "");
} //String.trim


/**
 * Elimina caracteres de formatação e zeros à esquerda da string
 * de número fornecida.
 * @param String pNum
 * 	String de número fornecida para ser desformatada.
 * @return String de número desformatada.
 */
function unformatNumber(pNum)
{
	return String(pNum).replace(/\D/g, "").replace(/^0+/, "");
} //unformatNumber


/**
 * Formata a string fornecida como CNPJ ou CPF, adicionando zeros
 * à esquerda se necessário e caracteres separadores, conforme solicitado.
 * @param String pCpfCnpj
 * 	String fornecida para ser formatada.
 * @param boolean pUseSepar
 * 	Indica se devem ser usados caracteres separadores (. - /).
 * @param boolean pIsCnpj
 * 	Indica se a string fornecida é um CNPJ.
 * 	Caso contrário, é CPF. Default = false (CPF).
 * @return String de CPF ou CNPJ devidamente formatada.
 */
function formatCpfCnpj(pCpfCnpj, pUseSepar, pIsCnpj)
{
	if (pIsCnpj==null) pIsCnpj = false;
	if (pUseSepar==null) pUseSepar = true;
	var maxDigitos = pIsCnpj? NUM_DIGITOS_CNPJ: NUM_DIGITOS_CPF;
	var numero = unformatNumber(pCpfCnpj);

	numero = numero.lpad(maxDigitos, '0');
	if (!pUseSepar) return numero;

	if (pIsCnpj)
	{
		reCnpj = /(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/;
		numero = numero.replace(reCnpj, "$1.$2.$3/$4-$5");
	}
	else
	{
		reCpf  = /(\d{3})(\d{3})(\d{3})(\d{2})$/;
		numero = numero.replace(reCpf, "$1.$2.$3-$4");
	}
	return numero;
} //formatCpfCnpj


/**
 * Calcula os 2 dígitos verificadores para o número-efetivo pEfetivo de
 * CNPJ (12 dígitos) ou CPF (9 dígitos) fornecido. pIsCnpj é booleano e
 * informa se o número-efetivo fornecido é CNPJ (default = false).
 * @param String pEfetivo
 * 	String do número-efetivo (SEM dígitos verificadores) de CNPJ ou CPF.
 * @param boolean pIsCnpj
 * 	Indica se a string fornecida é de um CNPJ.
 * 	Caso contrário, é CPF. Default = false (CPF).
 * @return String com os dois dígitos verificadores.
 */
function dvCpfCnpj(pEfetivo, pIsCnpj)
{
	if (pIsCnpj==null) pIsCnpj = false;
	var i, j, k, soma, dv;
	var cicloPeso = pIsCnpj? NUM_DGT_CNPJ_BASE: NUM_DIGITOS_CPF;
	var maxDigitos = pIsCnpj? NUM_DIGITOS_CNPJ: NUM_DIGITOS_CPF;
	var calculado = formatCpfCnpj(pEfetivo, false, pIsCnpj);
	calculado = calculado.substring(2, maxDigitos);
	var result = "";

	for (j = 1; j <= 2; j++)
	{
		k = 2;
		soma = 0;
		for (i = calculado.length-1; i >= 0; i--)
		{
			soma += (calculado.charAt(i) - '0') * k;
			k = (k-1) % cicloPeso + 2;
		}
		dv = 11 - soma % 11;
		if (dv > 9) dv = 0;
		calculado += dv;
		result += dv
	}

	return result;
} //dvCpfCnpj


/**
 * Testa se a String pCpf fornecida é um CPF válido.
 * Qualquer formatação que não seja algarismos é desconsiderada.
 * @param String pCpf
 * 	String fornecida para ser testada.
 * @return <code>true</code> se a String fornecida for um CPF válido.
 */
function isCpf(pCpf)
{

	if (pCpf.length != 11) {
		return false;
	}	
	var i; 
  	s = pCpf; 
  	var c = s.substr(0,9); 
  	var dv = s.substr(9,2); 
  	var d1 = 0; 
  
	for (i = 0; i < 9; i++){
		d1 += c.charAt(i)*(10-i); 
  	} 
  
	if (d1 == 0){ 
  		return false; 
  	} 
  
	d1 = 11 - (d1 % 11); 
  	if (d1 > 9) d1 = 0; 
  	if (dv.charAt(0) != d1){ 
  		return false; 
  	} 
  	d1 *= 2; 
  	for (i = 0; i < 9; i++){ 
  		d1 += c.charAt(i)*(11-i); 
  	} 
  
	d1 = 11 - (d1 % 11); 
  
	if (d1 > 9) d1 = 0; 
 	
 	if (dv.charAt(1) != d1){ 
  		return false; 
  	} 
  
	return true; 
  
	
	
	
} //isCpf


/**
 * Testa se a String pCnpj fornecida é um CNPJ válido.
 * Qualquer formatação que não seja algarismos é desconsiderada.
 * @param String pCnpj
 * 	String fornecida para ser testada.
 * @return <code>true</code> se a String fornecida for um CNPJ válido.
 */
function isCnpj(pCnpj)
{
	
	// verifica o tamanho
	pcgc=pCnpj;
	if (pcgc.length != 14) {
 		sim=false;
 		//alert ("Tamanho Invalido de CGC");
		return false;
	}else{
		sim=true;
	}

	if (sim ){  // verifica se e numero
   		for (i=0;((i<=(pcgc.length-1))&& sim); i++){
  			val = pcgc.charAt(i);
       		// alert (val);
   			if((val!="9")&&(val!="0")&&(val!="1")&&(val!="2")&&(val!="3")&&(val!="4") && (val!="5")&&(val!="6")&&(val!="7")&&(val!="8")){
				sim=false;
				return false;
			}
   		}
   		if (sim){  // se for numero continua
   
    		m2 = 2;
    		soma1 = 0;
    		soma2 = 0;
    		for (i=11;i>=0;i--){
    
     			val = eval(pcgc.charAt(i));
       		// alert ("Valor do Val: "+val);
     			m1 = m2;
  				if (m2<9) { 
					m2 = m2+1;
				}else{
  					m2 = 2;
				}
  				soma1 = soma1 + (val * m1);
  				soma2 = soma2 + (val * m2);
    		}  // fim do for de soma
	
  			soma1 = soma1 % 11;
  			if (soma1 < 2) {  
				d1 = 0;
			}else{ 
				d1 = 11- soma1;
			}
			soma2 = (soma2 + (2 * d1)) % 11;
  			if (soma2 < 2) { 
				d2 = 0;
			}else{ 
				d2 = 11- soma2;
			}
        		// alert (d1);
       		// alert (d2);
    		if ((d1==pcgc.charAt(12)) && (d2==pcgc.charAt(13))){ 
				//alert("Valor Valido de CCG");
				return true;
			} else{
				//alert("Valor invalido de CCG");
				return false;
   			}
		}

	}
	
	
	
	
} //isCnpj


/**
 * Testa se a String pCpfCnpj fornecida é um CPF ou CNPJ válido.
 * Se a String tiver uma quantidade de dígitos igual ou inferior
 * a 11, valida como CPF. Se for maior que 11, valida como CNPJ.
 * Qualquer formatação que não seja algarismos é desconsiderada.
 * @param String pCpfCnpj
 * 	String fornecida para ser testada.
 * @return <code>true</code> se a String fornecida for um CPF ou CNPJ válido.
 */
function isCpfCnpj(pCpfCnpj)
{
	var numero = pCpfCnpj.replace(/\D/g, "");
	if (numero.length > NUM_DIGITOS_CPF)
		return isCnpj(pCpfCnpj)
	else
		return isCpf(pCpfCnpj);
} //isCpfCnpj

function isINSS(pINSS){
	Fcamp=pINSS;
	if(isInteger(Fcamp)==false){
		return false;
	}
	if(0==Fcamp){
		return false;
	}
	if(Fcamp.length!=11){
		return false;
	}
	
	FTAB = "3298765432";
	TOT = 0;
	for(I=0;I<10;I++){
		TOT = TOT + Fcamp.substring(I,I+1) * FTAB.substring(I,I+1);
	}

	RESTO = TOT % 11;
	if(RESTO!=0){
		RESTO = 11 - RESTO;
	}
	if(10==RESTO){RESTO=0;}
	if(RESTO!=Fcamp.substring(10,11)){
		return false;
	}
	return true;

}


if (typeof console === "undefined") console = {log: function() {}};