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
		//alert(whichCode);
		if (whichCode == 13 || whichCode == 0 || whichCode == 8 || whichCode == 118) return true;  // TECLA Enter, (jb 07/10/2011 TAB, BACKSPACE, CTRL+V)
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
	//var whichCode = window.event.keyCode;
	
	e = e || window.event; // GLA - 14/07/2016
	var whichCode = e.keyCode || e.which; // GLA - 14/07/2016
	if (whichCode == 8 || whichCode == 9 || whichCode == 13) return true;  // TAB, VOLTA e Enter
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

function getRadioValue(idOrName) {
        var value = null;
        var element = document.getElementById(idOrName);
        var radioGroupName = null;  
        
        // if null, then the id must be the radio group name
        if (element == null) {
                radioGroupName = idOrName;
        } else {
                radioGroupName = element.name;     
        }
        if (radioGroupName == null) {
                return null;
        }
        var radios = document.getElementsByTagName('input');
        for (var i=0; i<radios.length; i++) {
                var input = radios[ i ];    
                if (input.type == 'radio' && input.name == radioGroupName && input.checked) {                          
                        value = input.value;
                        break;
                }
        }
        return value;
}

// Funcao limita somente digitaçao de numeros
function limita_number(text){
	var obj_value = text;
	var new_value = text;
	for(var i=0; i<obj_value.length; i++){
		var value_letra = obj_value.charAt(i);
		var code_letra = obj_value.charCodeAt(i);		
	
		if(code_letra < 48 || code_letra > 57){
			new_value = new_value.replace(value_letra, '');
		}
	}
	return(new_value);	
}

// Funcao alternativa para impressão de pagina
function altPrint(){	
	var oPrint, oJan;
	oPrint = window.document.getElementById("mainCONTEUDO").innerHTML;
	oJan = window.open("impressao",toolbar=0,scrollbars=0,status=0);
	oJan.document.write('<link rel="stylesheet" type="text/css" href="/global2.css">'+oPrint);
	oJan.document.close();
	oJan.focus();
	oJan.print();
	oJan.close();
}
if (typeof console === "undefined") console = {log: function() {}};