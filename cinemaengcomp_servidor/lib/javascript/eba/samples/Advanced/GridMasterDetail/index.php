<HTML xmlns:eba>
<!-- Note the namespace defined in the HTML tag. -->
<!--
	This page is the main page in the sample. It places the grid on the webpage
	and sets up its datasource and save handler.
-->
<head>
<title>EBA: Grid Control V2.7 Master-Detail Demo</title>
<!-- Create a link to the eba.css, which provides formatting detail for the grid.
	 You can modify eba.css to change your grid style.
 -->
<link type="text/css" rel="stylesheet" href="styles/ebagrids/eba.css">
<script language="Javascript">

// The number of new records generated without saving.
var gNUMKEYS=0


<!-- ********************************************************* -->
<!-- **   function PopulatePrice()                          ** -->
<!-- **                                                     ** -->
<!-- **   Description: When the user chooses an item from   ** -->
<!-- **   the lookup field, the quantity and price fields   ** -->
<!-- **   are automatically populated with data from        ** -->
<!-- **   the lookup dataset, specifically the column       ** -->
<!-- **   "price".                                          ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function PopulatePrice() {

	//Get a reference to the grid control, CG is your grid object
	var CG = chargesGrid.object;


	// Now retrieve records b and c from the lookup box.
	var newprice = CG.getSelectedLookupColumn("price");

	// if the lookup isnt empty do the following
	if (newprice!=null) {

		// Do the same for price.. but in column 2
		CG.setCell(CG.getRow(),2,newprice);
		CG.setCell(CG.getRow(),4,newprice);

	}

	var today = new Date()


	CG.setCell(CG.getRow(),1,today);


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
<!-- **   function delCustomerRow()                         ** -->
<!-- **                                                     ** -->
<!-- **   Description: This function deletes the selected   ** -->
<!-- **   record when the user clicks on the delete image   ** -->
<!-- **   button.                                           ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function delCustomerRow()
{

	input_box=confirm("Are you sure you\nwant to delete\nthis customer?");
	if (input_box==true)

	{
		var CG = customerGrid.object;  //mygrid is your grid object
		CG.deleteRow();

	}

}
<!-- ********************************************************* -->


<!-- ********************************************************* -->
<!-- **   function delPurchaseRow()                         ** -->
<!-- **                                                     ** -->
<!-- **   Description: This function deletes the selected   ** -->
<!-- **   record when the user clicks on the delete image   ** -->
<!-- **   button.                                           ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function delPurchaseRow()
{

	input_box=confirm("Are you sure you\nwant to delete\nthis purchase?");
	if (input_box==true)

	{
		var CG = chargesGrid.object;
		CG.deleteRow();

	}

}
<!-- ********************************************************* -->



<!-- ********************************************************* -->
<!-- **   function showdetails()                            ** -->
<!-- **                                                     ** -->
<!-- **   Description: This function is fired when the      ** -->
<!-- **   user clicks on the customer details button in the ** -->
<!-- **   grid. A request is sent to the 2nd grid to load   ** -->
<!-- **   the data for that customer.                       ** -->
<!-- **                                                     ** -->
<!-- ********************************************************* -->
function showdetails()
{
	var CG = customerGrid.object;  //mygrid is your grid object
	var CustomerID = CG.getCellValue(CG.getRow(),1);

	var ChargesGrid = chargesGrid.object;

	ChargesGrid.getHandler = 'gethandler.php?cid=' + CustomerID;

	ChargesGrid.GetPage(0);

	customername.innerHTML = '<b>Customer:</b> ' + CG.getCellValue(CG.getRow(),2);

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
	var CG = chargesGrid.object;
	CG.insertRow();

}
<!-- ********************************************************* -->
// Definition of the errorhandler for the Grid. In case of an error the function would print out the error message to the errorSpan.
function showError() {
	alert('The grid encountered a problem - probably related to write permissions.\n\nClick OK to see the response from the savehandler.');
	alert(chargesGrid.object.lastError);
	alert(customerGrid.object.lastError);
}

</script>
<!-- Include the code for the grid control. -->
<script language="JScript.Encode" src="ebagrid.js"></script>
<!-- Define your data columns. Note that data for this XML object is retrieved
	 by gethandler.asp in the init() function.  That is, getclientpricing.asp
	 acts as a datasource for the grid. -->
</head>
<!-- The body of the webpage. Note the call to 'init()' that initialises
	 any grids on the page when it loads. -->
<body onload="init()">

<!-- Insert the grid. -->
<table align=center width="680">
  <tr>
    <td align=left><font face=arial size=3><b>EBA: Grid Control V2.7 Master-Detail Demo</b><br>
      <br>
      </font> <font size=2 face=verdana>This demonstration shows a "master-detail" relationship. At the top, we have a grid showing customer records. You can click on a customer record to see the current invoice for that customer. The data for each customer is requested from the server in real-time.<br>
      <br>
      Try adjusting the quantity ordered, or unit price to see the subtotals change in real-time.<br>
      <br>
      You can also add a purchase for a specific customer, however, saving has not been enabled here to reduce the complexity of this sample.</font><br>
		<br>
    </td>
  </tr>
</table>
<table align=center width=680>
  <tr>
    <td><font face=arial size=3><b>Customer List:</b></font><br>
      <br>
      <eba:gridlist id="customerGrid" getHandler="customer_gethandler.php" height="213" width="610" cellHeight="18" rowhighlight="Y" showNav="N" sortColumn="2" onError="showError()" >
	  	<eba:columndefinition type="IMAGE"  	label=" "             xdatafld="CustomerType"     width="26"   initial="look.gif"   oncellclick="showdetails()" />
		<eba:columndefinition type="TEXTAREA"   label="ID"            xdatafld="CustomerID"       width="30"   celldisabled="Y"     oncellclick="showdetails()" />
		<eba:columndefinition type="TEXTAREA"   label="Customer" 	  xdatafld="CustomerName"     width="120"  celldisabled="Y"     oncellclick="showdetails()" />
		<eba:columndefinition type="TEXTAREA"   label="Address"       xdatafld="CustomerAddress"  width="200"  celldisabled="Y"     oncellclick="showdetails()" />
		<eba:columndefinition type="TEXTAREA"   label="Telephone"     xdatafld="CustomerNumber"   width="90"   celldisabled="Y"     oncellclick="showdetails()" />
		<eba:columndefinition type="IMAGE"  	label="Details"                                   width="60"   imageurl="look.gif"  oncellclick="showdetails()" />
		<eba:columndefinition type="IMAGE"  	label="Remove"                                    width="60"   imageurl="del.gif"   oncellclick="delCustomerRow()" />
	</eba:gridlist>
	<br>
      <font face=arial size=3>
      <div id="customername"><b>All Recent Purchases</b> - Click on customer's name to see details.<br>
      </div>
      </font><br>
      <eba:gridlist id="chargesGrid" getHandler="gethandler.php"  height="150" width="610" cellHeight="18" showNav="N"  sortColumn="1" onError="showError()" onafterpaging="summarizetotals()">
	  	<eba:columndefinition type="LOOKUP"  label="Product"    xdatafld="ItemName"      width="117"  getHandler="data/services.xml" onvalidate="PopulatePrice();" columnPad="100" />
	 	<eba:columndefinition type="DATE"    label="Date"       xdatafld="PurchaseDate"  width="200"  mask="dddd, mmmm dd yyyy" />
		<eba:columndefinition type="NUMBER"  label="Unit Price" xdatafld="ItemCost"      width="70"   mask="#,##0.00" initial="0.00"  />
		<eba:columndefinition type="NUMBER"  label="Quantity"   xdatafld="ItemQuantity"  width="70"   mask="#,##0" initial="1"  />
		<eba:ColumnDefinition type="FORMULA" label="Total"      xdatafld="TotalCost"     width="70"	  formula="field(ItemCost)*field(ItemQuantity)" showSummary="Y"  />
		<eba:columndefinition type="IMAGE"   label="Remove"                              width="60"   imageurl="del.gif"  oncellclick="delPurchaseRow()" />
	  </eba:gridlist>
     </td>
  </tr>
</table>
<table align=center width="680">
  <tr>
    <td align=left><br>
      <br>
      <font face=arial size=3><b>Related Tutorials</b><br>
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


	  </td>
  </tr>
</table>
</body>
</html>
