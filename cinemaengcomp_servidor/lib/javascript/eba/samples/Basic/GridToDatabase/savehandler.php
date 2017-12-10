<?php

require("EBAXML.PHP");

// This file is used as a Save Handler for the Grid control. When the user clicks
// the save button in default.asp a datagram is sent to this script.
// The script in turn looks at each update in the datagram and processes them accordingly.

// We have provided all the necessary functionality in the EBASaveHandler_ functions to extract any of the update instructions.
// For more details please have a look at our shipped online help under Reference/Server

// We need this small function in order to handle NULL values for number columns in the database
function GetNullOrNumber($number)
{
	if (gettype($number) == NULL || $number == "")
	{
		return "NULL";
	}
	else
	{
		return $number;
	}
}

$saveHandler = new EBASaveHandler();

$saveHandler->ProcessRecords();

// This block of code is ADO connection code used only for demonstration purposes
// objConn is an ADODB object we use here for demonstration purposes.
$accessDB = dirname(__FILE__) . DIRECTORY_SEPARATOR .  "data" . DIRECTORY_SEPARATOR . "data.mdb";
$strConn = "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA SOURCE=$accessDB;USER ID=;PASSWORD=;";

$objConn = new COM("ADODB.Connection");
$objConn->ConnectionString = $strConn;
$objConn->Open();

// ********************************************************** //
// Begin by processing our inserts
// ********************************************************** //
$insertCount = $saveHandler->ReturnInsertCount();
if ($insertCount > 0)
{
	// Yes there are INSERTs to perform...
	for ($currentRecord = 0; $currentRecord < $insertCount; $currentRecord++)
	{
		$myQuery  = "INSERT INTO tblPricing (ID,client, service, quantity, charge, [memo], [date], [inet], [image]) VALUES (" .
					$saveHandler->ReturnInsertField($currentRecord) . "," .
					"" . GetNullOrNumber($saveHandler->ReturnInsertField($currentRecord, "client"))  . "," .
					"'" . $saveHandler->ReturnInsertField($currentRecord,"service") . "'," .
					"" . GetNullOrNumber($saveHandler->ReturnInsertField($currentRecord,"quantity")) . "," .
					"" . GetNullOrNumber($saveHandler->ReturnInsertField($currentRecord,"charge")) . "," .
					"'" . $saveHandler->ReturnInsertField($currentRecord,"memo") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord,"date") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord,"inet") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord,"image") . "'" .
					"); ";

		// Now we execute this query
		$objConn->Execute($myQuery);
	}
}

// ********************************************************** //
// Continue by processing our updates
// ********************************************************** //
$updateCount = $saveHandler->ReturnUpdateCount();
if ($updateCount > 0)
{
	// Yes there are UPDATEs to perform...
	for ($currentRecord = 0; $currentRecord < $updateCount; $currentRecord++)
	{
		$myQuery = "UPDATE tblPricing ";

		$myQuery .= "SET tblPricing.[client] = " . GetNullOrNumber($saveHandler->ReturnUpdateField($currentRecord,"client")) . ", ";
		$myQuery .= "tblPricing.[service] = '" . $saveHandler->ReturnUpdateField($currentRecord,"service") . "', ";
		$myQuery .= "tblPricing.[quantity] = " . GetNullOrNumber($saveHandler->ReturnUpdateField($currentRecord,"quantity")) . ", ";
		$myQuery .= "tblPricing.[charge] = " . GetNullOrNumber($saveHandler->ReturnUpdateField($currentRecord,"charge")) . ", ";
		$myQuery .= "tblPricing.[memo] = '" . $saveHandler->ReturnUpdateField($currentRecord,"memo") . "', ";
		$myQuery .= "tblPricing.[date] = '" . $saveHandler->ReturnUpdateField($currentRecord,"date") . "', ";
		$myQuery .= "tblPricing.[inet] = '" . $saveHandler->ReturnUpdateField($currentRecord,"inet") . "', ";
		$myQuery .= "tblPricing.[image] = '" . $saveHandler->ReturnUpdateField($currentRecord,"image") . "' ";
		$myQuery .= " WHERE ID = " . $saveHandler->ReturnUpdateField($currentRecord, "");

		// Now we execute this query
		 $objConn->Execute($myQuery);
	}
}

// ********************************************************** //
// Finish by processing our deletes
// ********************************************************** //
$deleteCount = $saveHandler->ReturnDeleteCount();
if ($deleteCount > 0)
{
	// Yes there are DELETEs to perform...
	for ($currentRecord = 0; $currentRecord < $deleteCount; $currentRecord++)
	{
		$myQuery = "DELETE FROM tblPricing WHERE ID = " . $saveHandler->ReturnDeleteField($currentRecord);

		// Now we execute this query
		 $objConn->Execute($myQuery);
	}
}

$saveHandler->CompleteSave();
$objConn->Close();

?>
