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

$newQuery = "SELECT * FROM tblPricing";
$recordSet = $objConn->Execute($newQuery);

// *******************************************************************
// Lets Set up the Output
// *******************************************************************
$getHandler = new EBAGetHandler();
$getHandler->ProcessRecords();

// First we define how many columns we are sending in each record, and name each field.
// We will do this by using the EBAGetHandler_DefineField function. We will name each
// field of data after its column name in the database.

$getHandler->DefineField("client");
$getHandler->DefineField("service");
$getHandler->DefineField("quantity");
$getHandler->DefineField("charge");
$getHandler->DefineField("memo");
$getHandler->DefineField("date");
$getHandler->DefineField("inet");
$getHandler->DefineField("image");

// *******************************************************************
// Lets loop through our data and send it to the grid
// *******************************************************************

while (!$recordSet->EOF)
{
	$getHandler->CreateNewRecord($recordSet->Fields[0]->Value);
	$getHandler->DefineRecordFieldValue("client", $recordSet->Fields[1]->Value);	// set client
	$getHandler->DefineRecordFieldValue("service", $recordSet->Fields[2]->Value);	// set service
	$getHandler->DefineRecordFieldValue("quantity", $recordSet->Fields[3]->Value);	// set quantity
	$getHandler->DefineRecordFieldValue("charge", $recordSet->Fields[4]->Value);	// set charge
	$getHandler->DefineRecordFieldValue("memo", $recordSet->Fields[5]->Value);	// set memo
	$getHandler->DefineRecordFieldValue("date", $recordSet->Fields[6]->Value);		// set date
	$getHandler->DefineRecordFieldValue("inet", $recordSet->Fields[7]->Value);		// set inet
	$getHandler->DefineRecordFieldValue("image", $recordSet->Fields[8]->Value);	// set image
	$getHandler->SaveRecord();

	$recordSet->MoveNext();
}

$getHandler->CompleteGet();
$recordSet->Close();
$objConn->Close();

?>
