<HTML xmlns:eba>
<!-- Note the namespace defined in the HTML tag. -->
<!--
	This page is the main page in the sample. It places the grid on the webpage
	and sets up its datasource and save handler.
-->
<head>
<title>Grid V2.7 Point of Sales Demo</title>


<!-- Create a link to the eba.css, which provides formatting detail for the grid.
	 You can modify eba.css to change your grid style.
 -->

<script language="Javascript">


<!-- ********************************************************* -->
<!-- **   function PopulateDescandPrice()                   ** -->
<!-- **                                                     ** -->
<!-- **   Description: When the user chooses an item from   ** -->
<!-- **   the lookup field, the description field and price ** -->
<!-- **   field are automatically populated with data from  ** -->
<!-- **   the lookup dataset, specifically the columns      ** -->
<!-- **   "desc" and "price".                               ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function PopulateDescandPrice() {

	//Get a reference to the grid control, CG is your grid object
	var CG = chargesGrid.object;

	// Now retrieve records b and c from the lookup box.
	var newdesc = CG.getSelectedLookupColumn("desc");    // desc is name of the column in the xml file, returns empty string if no selection of the lookup has been made
	var newprice = CG.getSelectedLookupColumn("price");

	// if the lookup isnt empty do the following
	if (newdesc!=null || newprice!=null) {

		//Use setCell to put the description into column 1 (zero based) of the current row
		CG.setCell(CG.getRow(),1,newdesc);

		// Do the same for price.. but in column 2
		CG.setCell(CG.getRow(),2,newprice);
	}

	//We must return true to onvalidate to preserve the change
	return true;
}
<!-- ********************************************************* -->



<!-- ********************************************************* -->
<!-- **   function init()                                   ** -->
<!-- **                                                     ** -->
<!-- **   Description: This is the master initialization    ** -->
<!-- **   function for the page. It is called in the body   ** -->
<!-- **   tag onload="". This function is responsible for   ** -->
<!-- **   initializiting any grids on the page, and we also ** -->
<!-- **   use it to prepopulate the purchase total.         ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function init()
{

	// Initialize the controls.
	InitEBAGrids();


}
<!-- ********************************************************* -->



<!-- ********************************************************* -->
<!-- **   function delRow()                                 ** -->
<!-- **                                                     ** -->
<!-- **   Description: This function deletes the selected   ** -->
<!-- **   record when the user clicks on the delete image   ** -->
<!-- **   button.                                           ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function delRow()
{

	input_box=confirm("Are you sure you\nwant to delete\nthis record?");
	if (input_box==true)

	{
		var CG = chargesGrid.object;  //chargesGrid is your grid object
		CG.deleteRow();

	}

}
<!-- ********************************************************* -->


<!-- ********************************************************* -->
<!-- **   function showquantity()                           ** -->
<!-- **                                                     ** -->
<!-- **   Description: This function is fired when the      ** -->
<!-- **   user clicks on the Summary image button in the    ** -->
<!-- **   grid. An alert box is produced with some summary  ** -->
<!-- **   information about that record.                    ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function showquantity()
{

	var CG = chargesGrid.object;  //chargesGrid is your grid object
	var Item = CG.getCellValue(CG.getRow(),0);
	var Description = CG.getCellValue(CG.getRow(),1);

	var Cost = CG.getCellValue(CG.getRow(),2);

	if (Item.length > 0) {

		alert("Item: " + Item + "\n\nUnit Cost: $" + Cost + "\n\nDescription:\n" + Description);
	} else {
		alert("No item selected!");
	}

}
<!-- ********************************************************* -->


<!-- ********************************************************* -->
<!-- **   function AddCharge()                              ** -->
<!-- **                                                     ** -->
<!-- **   Description: Inserts a new row into the grid.     ** -->
<!-- **   This function is bound to a button at the bottom  ** -->
<!-- **   of the grid.                                      ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function AddCharge()
{
	var CG = chargesGrid.object;  //chargesGrid is your grid object
	CG.insertRow();

}
<!-- ********************************************************* -->


<!-- ********************************************************* -->
// Definition of the errorhandler for the Grid. In case of an error the function would print out the error message to the errorSpan.
function showError() {
	alert('The grid encountered a problem - probably related to write permissions.\n\nClick OK to see the response from the savehandler.');
	alert(chargesGrid.object.lastError);
}
</script>

<!-- Include the code and stylesheet for the grid control. -->
<script language="JScript.Encode" src="ebagrid.js"></script>
<link type="text/css" rel="stylesheet" href="styles\xp\eba.css">


</head>

<!-- The body of the webpage. Note the call to 'init()' that initializes any grids on the page when it loads. -->
<body onload="init()">

		<table align=center width="700">
			<tr>
				<td align=left>
				<font face=arial size=3><b>EBA: Grid Control V2.7 Invoice Demo</b><br>
				<br></font>
				<font size=2 face=verdana>This demo highlights two major areas of functionality.<br><br>
				One is the ability to perform real-time cell calculations. In this instance, row totals are being calculated by multiplying Unit Price and Quantity Together. Every time one of those values are altered, the event "onvalidate" fires and we use JavaScript to perform the calculation.<br><br>Another area of functionality shown here is the use of the ComboBox, or "lookup" field, which is bound to a remote datasource. In this case, the datasource is a static XML file, which is being read off the server. Try typing into the <b>Product</b> field, and notice how it attempts to autocomplete what you are typing by choosing from the datasource. Also, when you choose an item from the combobox, the description, and unit price fields are automatically completed for you based on this data.</font><br>
				<br>
			</td></tr>

		</table>

		<table align=center width="700">
			<tr>
				<td align=left>
					<eba:gridlist id="chargesGrid" getHandler="gethandler.php" height="160" width="686" rowhighlight="Y" cellHeight="18" showNav="N"  tabindex="1" sortColumn="2" onError="showError()">
						<eba:columndefinition type="LOOKUP"   label="Product"      xdatafld="Product"       width="70"  getHandler="data/services.xml" onvalidate="PopulateDescandPrice();"  columnPad="100" />
						<eba:columndefinition type="TEXTAREA" label="Description"  xdatafld="Description"   width="290"  />
						<eba:columndefinition type="NUMBER"   label="Unit Price"   xdatafld="UnitPrice"     width="70"  initial="0.00"   mask="#,##0.00"  />
						<eba:columndefinition type="NUMBER"   label="Quantity"     xdatafld="Quantity"      width="60"  initial="1"      mask="#,##0"     />
						<eba:ColumnDefinition type="FORMULA"  label="Total"        xdatafld="Total"         width="70"	formula="field(UnitPrice)*field(Quantity)" showSummary="Y"  />
						<eba:columndefinition type="IMAGE"    label="Summary"      xdatafld="LookButton"    width="60"  initial="look.gif" oncellclick="showquantity()" />
						<eba:columndefinition type="IMAGE"    label="Remove"       xdatafld="ImageButton"   width="60"  initial="del.gif"  oncellclick="delRow()" />
					</eba:gridlist>

				</td>
			</tr>
		</table>

		<table align=center width="700">
			<tr>
				<td align=left>
				<br><br><font face=arial size=3><b>Related Tutorials</b><br>
				<br>
				</font> <font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.asp?artid=91&catid=7">How do I build a master-detail grid?</a></font><br>
				<br>
				<font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.asp?artid=45&catid=7">How do I add a row at runtime (through JavaScript)?</a></font><br>
				<br>
				<font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.asp?artid=185&catid=7">Using a datepicker with the grid</a></font><br>
				<br>
				<font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.asp?artid=183&catid=7">How do I create a balance (or summary) row?</a></font><br>
				<br>
				<font face=verdana size=2><a href="http://developer.ebusiness-apps.com/ebakb/ebakb.asp?artid=181&catid=7">How do I configure cell calculations (or row forumulas)?</a></font><br>
				<br>
			</td></tr>

		</table>

</body>
</html>
