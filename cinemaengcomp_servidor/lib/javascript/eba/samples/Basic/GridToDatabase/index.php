<HTML xmlns:eba>
<!-- Note the namespace defined in the HTML tag. -->
<!-- This page is the main page in the sample. It places the grid on the webpage and sets up its datasource and save handler. -->

<head>
<title>Grid V2.7 GridToDatabase Demo</title>

<!-- Include the code and stylesheet for the grid control. -->
<script language="JScript.Encode" src="ebagrid.js"></script>
<link type="text/css" rel="stylesheet" href="styles\xp\eba.css">



<script language="Javascript">

// Definition of the errorhandler for the Grid. In case of an error the function would print out the error message to the errorSpan.
function errorHandler() {
	alert('The grid encountered a problem - probably related to write permissions.\n\nClick OK to see the response from the savehandler.');
	alert(myGrid.object.lastError);
}
// Used when the Save button is pressed. Saves the dirty records back to the datasource.
function saveData() {
	myGrid.object.save();
}
function OnBeforeSave() {
	saveSpan.innerText="saving data from grid...";
}
function OnAfterSave() {
	// alert(myGrid.object.lastSaveHandlerResponse);  // You can use this code to debug the response of the savehandler.
	saveSpan.innerText="saving data from grid...ok!";
	// clear the saveSpan text after 3 seconds.
	setTimeout("saveSpan.innerText=''",3000);
}
function generateKey() {
	// get the latest key from the server
	return Number(myGrid.object.getResponseFromURL("getkey.php"));
}

</script>
</head>

<!-- The body of the webpage. Note the call to 'InitEBAGrids()' that initialises any grids on the page when it loads. -->
<body onload="InitEBAGrids()">
	<table align=center width="680">
		<tr>
			<td align=left>
				<font face=arial size=3><b>EBA: Grid Control V2.7 Database Grid Demo</b><br>
			  <br></font>
			  <font size=2 face=verdana>This is an example of a <i>databound</i> grid, or a grid that uses a <b>getHandler</b> and a <b>saveHandler</b>.<br><Br>In this sample, an Access database is used to provide data to the grid.<br><br> Notice the use of comboboxes, listboxes, checkboxes, textboxes, image cells, number fields, date boxes, and hyperlink fields.</font><br>
			  <br>
			  <font size=2 face=verdana><a href="http://support.ebusiness-apps.com/esupport/index.php?_a=knowledgebase&_j=questiondetails&_i=98&nav=+%26gt%3B+%3Ca+href%3D%5C%27index.php%3F_a%3Dknowledgebase%26_j%3Dsubcat%26_i%3D1%5C%27%3EGrid+Control+V2%3C%2Fa%3E">Click here for an important note about this demo (click here if you are having problems saving).</a></font>				<br>
				<br>
		  </td>
		</tr>
	</table>
<table align=center >
	<tr>
		<td> <!-- Insert the grid. Note the id of the grid 'myGrid' which is used to reference the control. -->
			<eba:gridlist id="myGrid" getHandler="gethandler.php" saveHandler="savehandler.php" height="300" width="740" cellHeight="16" showNav="Y" onbeforesave="OnBeforeSave()" onaftersave="OnAfterSave()" onError="errorHandler()" onGenerateRecordKey="generateKey()">
				<eba:ColumnDefinition type="LISTBOX"  label="Client"    width="60"   xdatafld="client"    values="1:Aceme,2:Henry,3:Intra,4:West" show="value" />
				<eba:ColumnDefinition type="IMAGE"    label="Image"     width="50"   xdatafld="image"     initial="resources/test1.gif" />
				<eba:columndefinition type="NUMBER"   label="Quantity"  width="100"  xdatafld="quantity"  mask="###,##0.00" />
				<eba:columndefinition type="CHECKBOX" label="Charge"    width="80"   xdatafld="charge"    values="1:charge,0:notcharge" initial="1" />
				<eba:columndefinition type="LOOKUP"   label="Service"   width="80"   xdatafld="service"   getHandler="data/services.xml" />
				<eba:ColumnDefinition type="TEXTAREA"     label="Memo"      width="80"   xdatafld="memo"      />
				<eba:ColumnDefinition type="DATE"     label="Date"      width="160"  xdatafld="date"      mask="dddd, mm-dd-yyyy h:n:s" />
				<eba:ColumnDefinition type="LINK"     label="Inet"      width="128"  xdatafld="inet"      linkurl=field(inet) />
			</eba:gridlist>
		</td>
	</tr>
</table>

<center>
	<i>Press the INSERT key to create rows. <BR>Press the DELETE key to delete rows.</i><br><br>
	<!-- Insert a save button. Note the call to saveData() when the button is clicked. -->
	<button type="submit" onClick="saveData()" id="Button1"> <b>Save</b> </button>
	<br>
	<!-- used as a save-feedback placeholder -->
	<span id="saveSpan" style="font-family: Verdana; font-size: 10px;"></span> <br>
</center>
		<table align=center width="680">
  			<tr>
  				<td align=left>
  				<br><br><font face=arial size=3><b>Related Tutorials</b><br><br></font>
  			    <font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.php?artid=90&catid=6">Troubleshooting your Grid application?</a></font><br>
                <br>
                <font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.php?artid=84&catid=7">What can I do with Image cells?</a></font><br>
                <br>
                <font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.php?artid=96&catid=7">Using Date fields</a></font><br>
                <br>
                <font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.php?artid=185&catid=7">Using a datepicker with the grid</a></font>
  			</td>
  			</tr>

		</table>
</body>
</html>
