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
//	echo gettype($number) . ":" . $number . "<BR>\r\n";
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
$accessDB = dirname(__FILE__) . DIRECTORY_SEPARATOR .  "data" . DIRECTORY_SEPARATOR . "customers.mdb";
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
		$myQuery  = "INSERT INTO tblcustomers (CustomerID, CustomerName, CustomerAddress, CustomerNumber, CustomerType, SalesPerson, EmailAddress, Birthday) VALUES (" .
					"" .  $saveHandler->ReturnInsertField($currentRecord, "CustomerID") . ", " .
					"'" . $saveHandler->ReturnInsertField($currentRecord, "CustomerName") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord, "CustomerAddress") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord, "CustomerNumber") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord, "CustomerType") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord, "SalesPerson") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord, "EmailAddress") . "'," .
					"'" . $saveHandler->ReturnInsertField($currentRecord, "Birthday") . "'" .
					");";

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
		$myQuery = 	"UPDATE tblCustomers " .
					"SET tblCustomers.[CustomerName] = '" . GetNullOrNumber($saveHandler->ReturnUpdateField($currentRecord,"CustomerName")) . "', " .
					"tblCustomers.[CustomerAddress] = '" . $saveHandler->ReturnUpdateField($currentRecord,"CustomerAddress") . "', ".
					"tblCustomers.[CustomerNumber] = '" . GetNullOrNumber($saveHandler->ReturnUpdateField($currentRecord,"CustomerNumber")) . "', " .
					"tblCustomers.[CustomerType] = '" . GetNullOrNumber($saveHandler->ReturnUpdateField($currentRecord,"CustomerType")) . "', " .
					"tblCustomers.[SalesPerson] = '" . $saveHandler->ReturnUpdateField($currentRecord,"SalesPerson") . "', " .
					"tblCustomers.[EmailAddress] = '" . $saveHandler->ReturnUpdateField($currentRecord,"EmailAddress") . "', " .
					"tblCustomers.[Birthday] = '" . $saveHandler->ReturnUpdateField($currentRecord,"Birthday") . "' " .
					" WHERE CustomerID = " . $saveHandler->ReturnUpdateField($currentRecord, "");

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
		$myQuery = "DELETE FROM tblCustomers WHERE CustomerID = " . $saveHandler->ReturnDeleteField($currentRecord);

		// Now we execute this query
		 $objConn->Execute($myQuery);
	}
}

$saveHandler->CompleteSave();
$objConn->Close();

?>
