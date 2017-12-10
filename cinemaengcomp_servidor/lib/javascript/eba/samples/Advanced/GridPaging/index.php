<HTML xmlns:eba>
<!-- Note the namespace defined in the HTML tag. -->
<!-- This page is the main page in the sample. It places the grid on the webpage and sets up its datasource and save handler. -->

<head>
<title>Grid V2.7 Paging Demo</title>

<!-- Include the code and stylesheet for the grid control. -->
<script language="JScript.Encode" src="ebagrid.js"></script>
<link type="text/css" rel="stylesheet" href="styles\officexp\eba.css">

<script language="Javascript">

function init()
{
	InitEBAGrids();
}

function saveData()
{
	chargesGrid.object.save();
}

function generateKey() {
	// get the latest key from the server
	return Number(chargesGrid.object.getResponseFromURL("getkey.php"));
}

function GoToRecord(RecordNumber)
{
	chargesGrid.object.GetPage((RecordNumber-1));

	RecordLabel.innerHTML = 'Editing from Record ' + (RecordNumber) + ' to ' + (RecordNumber+14);

	return false;
}


// Definition of the errorhandler for the Grid. In case of an error the function would print out the error message to the errorSpan.
function showError() {
	alert('The grid encountered a problem - probably related to write permissions.\n\nClick OK to see the response from the savehandler.');
	alert(chargesGrid.object.lastError);

}

function SelectedPageChange()
{

	RecordLabel.innerHTML = 'Editing from Record ' + (chargesGrid.object.PageStart+1) + ' to ' + (chargesGrid.object.PageStart+15);

}

</script>
</head>

<!-- The body of the webpage. Note the call to 'InitEBAGrids()' that initialises any grids on the page when it loads. -->
<body onload="init()">

<table align=center width="750">
	<tr>
		<td align=left>
		<font face=arial size=3><b>EBA: Grid Control V2.7 Paging Demo</b><br>
		<br></font>
		<font size=2 face=verdana>This demo will allow you to navigate and edit a database of 5,000 customer records. Notice that every time a cell is changed, the database is updated automatically without any nead to manually save or even refresh the page.<br><br>If you insert a record, note that it will be placed at the end of the dataset, so be sure to navigate past record 5,000 to see it later on.<br><br><a href="http://support.ebusiness-apps.com/esupport/index.php?_a=knowledgebase&_j=questiondetails&_i=98&nav=+%26gt%3B+%3Ca+href%3D%5C%27index.php%3F_a%3Dknowledgebase%26_j%3Dsubcat%26_i%3D1%5C%27%3EGrid+Control+V2%3C%2Fa%3E">Click here for an important note about this demo (click here if you are having problems saving).</a></font><br><br><br>
	</td></tr>
	<tr>
		<td align=left>
		<font face=arial size=3><div id="RecordLabel">Editing from Record 1 to 15</div></font>
	</td></tr>

</table>

<table align=center>
	<tr>
		<td width="0" valign=top>
		<!-- Insert the grid. Note the id of the grid 'chargesGrid' which is used to reference the control. -->
			<eba:gridlist id="chargesGrid"  getHandler="gethandler.php" saveHandler="savehandler.php" height="300"  width="650" freezeColumn="3" PageSize="15" autoSave="Y" onGenerateRecordKey="generateKey()" showNav="Y" sortColumn="1" onError="showError()" onafterpaging="SelectedPageChange()" cellHeight="16" >
				<eba:columndefinition type="IMAGE"  label=" "           xdatafld="CustomerType"    width="25"  initial="person.gif" />
				<eba:columndefinition type="NUMBER" label="ID"          xdatafld="CustomerID"      width="40"  initial="00"  celldisabled="Y" />
				<eba:columndefinition type="TEXTAREA"   label="Customer&nbsp;Name"        xdatafld="CustomerName"    width="100"  />
				<eba:columndefinition type="TEXTAREA"   label="Address"     xdatafld="CustomerAddress" width="110"  />
				<eba:columndefinition type="TEXTAREA"   label="Telephone"   xdatafld="CustomerNumber"  width="80"   />
				<eba:columndefinition type="LINK"   label="eMail"       xdatafld="EmailAddress"    width="155"  initial="mailto:test@test.com"  linkurl=field(EmailAddress) />
				<eba:columndefinition type="DATE"   label="Birthday"    xdatafld="Birthday"        width="160"  initial="Tuesday, April 01 1980"  mask="dddd, mmmm dd yyyy" />
				<eba:columndefinition type="TEXTAREA"   label="Salesperson" xdatafld="SalesPerson"     width="100"  initial="Alexei White"  />
			</eba:gridlist>
		</td>

		<td valign=top align=center>
			<font face=verdana size=2>
				Paging Buttons<br><br>

				<div style="background-color: #c3daf9; padding: 5px; border: 1px dashed; border-color: #000000;"><a href="#" onclick="return GoToRecord(1)">Page to<br>record 1</a></div>

				<br><br><br><br>

				<div style="background-color: #c3daf9; padding: 5px; border: 1px dashed; border-color: #000000;"><a href="#" onclick="return GoToRecord(2000)">Page to<br>record 2000</a></div>

				<br><br><br><br>

				<div style="background-color: #c3daf9; padding: 5px; border: 1px dashed; border-color: #000000;"><a href="#" onclick="return GoToRecord(4986)">Page to<br>record 4986</a></div>

			</font>
		</td>

	</tr>
</table>

		<table align=center width="750">
			<tr>
				<td align=left>
				<br><br><font face=arial size=3><b>Related Tutorials</b><br></font>
				<br>
                <font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.asp?artid=79&catid=7">How do I implement paging?</a></font><br>
                <br>
                <font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.asp?artid=45&catid=7">How do I add a row at runtime (through JavaScript)?</a></font><br>
                <br>
                <font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.asp?artid=185&catid=7">Using a datepicker with the grid</a></font> <br>

			</td></tr>

		</table>

</body>
</html>