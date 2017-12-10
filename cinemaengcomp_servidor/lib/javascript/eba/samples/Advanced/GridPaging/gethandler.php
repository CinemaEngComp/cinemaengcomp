<?php

require("EBAXML.PHP");

// This file is used as a Get Handler for the Grid control. When the grid is initialized,
// the get handler script (this page) is called and expected to return a properly formatted
// xml stream. We have provided all the necessary functionality to do this without actually
// requiring you to construct XML. Simply interface with your datasource and use the provided
// function calls to create the necessary output.

// Gethandlers must be able to output xml when called without any parameters.

// We have provided all the necessary functionality in the EBASaveHandler_ functions to extract any of the update instructions.
// For more details please have a look at our shipped online help under Reference/Server


// Begin by grabbing the querystring parameters start and pagesize

	$pagesize = 0;

	if (isset($_GET['pagesize'])) {
		$pagesize = $_GET['pagesize'];
	}

	if ($pagesize < 1) {
		$pagesize=15;
	}

	$ordinalStart = 0;

	if (isset($_GET['start'])) {
		$ordinalStart = $_GET['start'];
	}

	if ($ordinalStart < 1) {
		$ordinalStart=0;
	}



// *******************************************************************
// This code block just sets up the database and tries to figure out what index number
// our data starts at. This code has nothing to do with the grid itself so think of it as
// business logic.
// *******************************************************************

$accessDB = dirname(__FILE__) . DIRECTORY_SEPARATOR .  "data" . DIRECTORY_SEPARATOR . "customers.mdb";
$strConn = "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA SOURCE=$accessDB;USER ID=;PASSWORD=;";

$objConn = new COM("ADODB.Connection");
$recordSet = new COM("ADODB.RecordSet");

$objConn->ConnectionString = $strConn;
$objConn->Open();

$newQuery = "SELECT * FROM tblcustomers ORDER BY CustomerID";
$recordSet = $objConn->Execute($newQuery);

// *******************************************************************
// Lets Set up the Output
// *******************************************************************
$getHandler = new EBAGetHandler();
$getHandler->ProcessRecords() ;  // We set up the getHandler and define the column CustomerID as our Index

// First we define how many columns we are sending in each record, and name each field.
// We will do this by using the $getHandler->DefineField function. We will name each
// field of data after its column name in the database.

$getHandler->DefineField("CustomerName");
$getHandler->DefineField("CustomerAddress");
$getHandler->DefineField("CustomerNumber");
$getHandler->DefineField("CustomerType");
$getHandler->DefineField("SalesPerson");
$getHandler->DefineField("EmailAddress");
$getHandler->DefineField("Birthday");
$getHandler->DefineField("CustomerID");

// *******************************************************************
// Lets loop through our data and send it to the grid
// *******************************************************************

$ordinalRecordNumber = 0;
$addedRecords = 0;

while ((!$recordSet->EOF) && ($addedRecords < $pagesize))
{
	if (($ordinalRecordNumber-1) > $ordinalStart)
	{

		$getHandler->CreateNewRecord($recordSet->Fields[0]->Value);
		$getHandler->DefineRecordFieldValue("CustomerName", $recordSet->Fields[1]->Value);
		$getHandler->DefineRecordFieldValue("CustomerAddress", $recordSet->Fields[2]->Value);
		$getHandler->DefineRecordFieldValue("CustomerNumber", $recordSet->Fields[3]->Value);
		$getHandler->DefineRecordFieldValue("CustomerType", $recordSet->Fields[4]->Value);
		$getHandler->DefineRecordFieldValue("SalesPerson", $recordSet->Fields[5]->Value);
		$getHandler->DefineRecordFieldValue("EmailAddress", $recordSet->Fields[6]->Value);
		$getHandler->DefineRecordFieldValue("Birthday", $recordSet->Fields[7]->Value);
		$getHandler->DefineRecordFieldValue("CustomerID", $recordSet->Fields[0]->Value);
		$getHandler->SaveRecord();
		$addedRecords = $addedRecords + 1;
	}

	$ordinalRecordNumber = $ordinalRecordNumber + 1;
	$recordSet->MoveNext();
}

$getHandler->CompleteGet();
$recordSet->Close();
$objConn->Close();

?>
