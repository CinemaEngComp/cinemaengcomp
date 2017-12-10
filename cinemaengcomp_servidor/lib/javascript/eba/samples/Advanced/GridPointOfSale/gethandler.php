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


// *******************************************************************
// This code block just sets up the database and tries to figure out what index number
// our data starts at. This code has nothing to do with the grid itself so think of it as
// business logic.
// *******************************************************************

$accessDB = dirname(__FILE__) . DIRECTORY_SEPARATOR .  "data" . DIRECTORY_SEPARATOR . "data.mdb";
$strConn = "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA SOURCE=$accessDB;USER ID=;PASSWORD=;";

$objConn = new COM("ADODB.Connection");
$recordSet = new COM("ADODB.RecordSet");

$objConn->ConnectionString = $strConn;
$objConn->Open();

$newQuery = "SELECT * FROM pricing";
$recordSet = $objConn->Execute($newQuery);

// *******************************************************************
// Lets Set up the Output
// *******************************************************************
$getHandler = new EBAGetHandler();
$getHandler->ProcessRecords() ;  // We set up the getHandler and define the column CustomerID as our Index

// First we define how many columns we are sending in each record, and name each field.
// We will do this by using the $getHandler->DefineField function. We will name each
// field of data after its column name in the database.

$getHandler->DefineField("Product");
$getHandler->DefineField("Description");
$getHandler->DefineField("Quantity");
$getHandler->DefineField("UnitPrice");
$getHandler->DefineField("ImageButton");
$getHandler->DefineField("LookButton");
$getHandler->DefineField("StockQuantity");
$getHandler->DefineField("Total");

// *******************************************************************
// Lets loop through our data and send it to the grid
// *******************************************************************

while (!$recordSet->EOF)
{


	$getHandler->CreateNewRecord($recordSet->Fields[0]->Value);
	$getHandler->DefineRecordFieldValue("Product", $recordSet->Fields[1]->Value);
	$getHandler->DefineRecordFieldValue("Description", $recordSet->Fields[2]->Value);
	$getHandler->DefineRecordFieldValue("Quantity", $recordSet->Fields[3]->Value);
	$getHandler->DefineRecordFieldValue("UnitPrice", $recordSet->Fields[4]->Value);
	$getHandler->DefineRecordFieldValue("ImageButton", $recordSet->Fields[5]->Value);
	$getHandler->DefineRecordFieldValue("LookButton", $recordSet->Fields[6]->Value);
	$getHandler->DefineRecordFieldValue("StockQuantity", $recordSet->Fields[7]->Value);
	$getHandler->DefineRecordFieldValue("Total", "0.00");
	$getHandler->SaveRecord();


	$recordSet->MoveNext();
}

$getHandler->CompleteGet();
$recordSet->Close();
$objConn->Close();

?>
