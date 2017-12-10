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

$accessDB = dirname(__FILE__) . DIRECTORY_SEPARATOR .  "data" . DIRECTORY_SEPARATOR . "invoices.mdb";
$strConn = "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA SOURCE=$accessDB;USER ID=;PASSWORD=;";

$objConn = new COM("ADODB.Connection");
$recordSet = new COM("ADODB.RecordSet");

$objConn->ConnectionString = $strConn;
$objConn->Open();


// *******************************************************************
// Lets build our query
// *******************************************************************

$NewQuery = "";
$NewQuery = "select * from tblpurchases";

$CustomerID = 0;

if (isset($_GET['cid'])) {
	$CustomerID = $_GET['cid'];
}

if ($CustomerID > 0)
{
	$NewQuery .= " where CustomerID = " . $CustomerID;
} else
{
	$NewQuery .= " where CustomerID = 0";
}

$recordSet = $objConn->Execute($NewQuery);

// *******************************************************************
// Lets Set up the Output
// *******************************************************************
$getHandler = new EBAGetHandler();
$getHandler->ProcessRecords() ;  // We set up the getHandler and define the column CustomerID as our Index

// First we define how many columns we are sending in each record, and name each field.
// We will do this by using the $getHandler->DefineField function. We will name each
// field of data after its column name in the database.

$getHandler->DefineField("PurchaseID");
$getHandler->DefineField("ItemName");
$getHandler->DefineField("ItemCost");
$getHandler->DefineField("ItemQuantity");
$getHandler->DefineField("TotalCost");
$getHandler->DefineField("PurchaseDate");

// *******************************************************************
// Lets loop through our data and send it to the grid
// *******************************************************************


while (!$recordSet->EOF)
{


$getHandler->CreateNewRecord($recordSet->Fields[0]->Value);
	$getHandler->DefineRecordFieldValue("PurchaseID", $recordSet->Fields[0]->Value);
	$getHandler->DefineRecordFieldValue("ItemName", $recordSet->Fields[1]->Value);
	$getHandler->DefineRecordFieldValue("ItemCost", $recordSet->Fields[2]->Value);
	$getHandler->DefineRecordFieldValue("ItemQuantity", $recordSet->Fields[3]->Value);
	$getHandler->DefineRecordFieldValue("TotalCost", $recordSet->Fields[4]->Value);
	$getHandler->DefineRecordFieldValue("PurchaseDate", $recordSet->Fields[5]->Value);
	$getHandler->SaveRecord();

	$recordSet->MoveNext();
}

$getHandler->CompleteGet();
$recordSet->Close();
$objConn->Close();

?>
