<?php

// This file returns the next key in the database so that when the grid
// needs a new key it has a unique one. The solution presented here also
// shows a simple way how to deal with concurrency issues by saving
// the lastKeyWrittenToGrid to the ASP application object

// Query a database with some sql query and a connection string.
function getRecordSet($sqlQuery, $connectionString)
{
	$conn = new COM("ADODB.Connection");
	$conn->ConnectionString = $connectionString;
	$conn->Open();
	$recordSet = new COM("ADODB.RecordSet");
	$recordSet = $conn->Execute($sqlQuery);
	return $recordSet;
}

// Return the currently largest key in the database.
function main()
{
	// Set the time the document expires.
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	// Handle the header expiring date.
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

	// Tell the proxies not to cache this document.
	header ("Cache-Control: no-cache, must-revalidate");

	// Tell the browser to keep it uncached.
	header ("Pragma: no-cache");

	$accessDB = dirname(__FILE__) . DIRECTORY_SEPARATOR .  "data" . DIRECTORY_SEPARATOR . "data.mdb";
	$strconn = "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA SOURCE=" . $accessDB . ";USER ID=;PASSWORD=;";
	$recordSet = getRecordSet("SELECT Max(ID) FROM tblPricing;", $strconn);
	$lastKeyWrittenToGrid = $recordSet->Fields[0]->Value;
 	$lastKeyWrittenToGrid += 1;
 	echo $lastKeyWrittenToGrid;
}

main();

?>
