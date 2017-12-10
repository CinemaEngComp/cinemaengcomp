<?php

require("EBAXML.PHP");

/************************************************************************************************
** This file is used as a Get Handler for the Grid control. When the grid is initialized,
** the get handler script (this page) is called and expected to return a properly formatted
** xml stream. We have provided all the necessary functionality to do this without actually
** requiring you to construct XML. Simply interface with your datasource and use the provided
** function calls to create the necessary output.
**
** Gethandlers must be able to output xml when called without any parameters.
**
** We have provided all the necessary functionality in the EBASaveHandler_ functions to extract
** any of the update instructions.
** For more details please have a look at our shipped online help under Reference/Server
************************************************************************************************/

$filename = "data" . DIRECTORY_SEPARATOR . "data.csv";  // file to read
$records = LoadCSVFile($filename);
$numRecords = count($records);

if ($numRecords == 0)
{
	return;
}

$headings = $records[0];

/************************************************************************************************
** Let's Set up the Output
************************************************************************************************/

$gethandler = new EBAGetHandler();

// We set up the getHandler and define the column CustomerID as our Index
$gethandler->ProcessRecords("");

// First we define how many columns we are sending in each record, and name each field.

// We will do this by using the $gethandler->DefineField function. We will name each
// field of data after its column name in the database.

$gethandler->DefineField("client");
$gethandler->DefineField("service");
$gethandler->DefineField("quantity");
$gethandler->DefineField("charge");
$gethandler->DefineField("memo");
$gethandler->DefineField("date");
$gethandler->DefineField("inet");
$gethandler->DefineField("image");

for ($i = 1; $i < $numRecords; $i++)
{
	$line = $records[$i];
	$gethandler->CreateNewRecord($line[0]);				// create new record with ID
	$gethandler->DefineRecordFieldValue("client",		$line[1]);	// set client
	$gethandler->DefineRecordFieldValue("service", 	$line[2]);	// set service
	$gethandler->DefineRecordFieldValue("quantity",	$line[3]);	// set quantity
	$gethandler->DefineRecordFieldValue("charge", 	$line[4]); 	// set charge
	$gethandler->DefineRecordFieldValue("memo", 	$line[5]);	// set memo
	$gethandler->DefineRecordFieldValue("date", 		$line[6]); 	// set date
	$gethandler->DefineRecordFieldValue("inet", 		$line[7]); 	// set inet
	$gethandler->DefineRecordFieldValue("image", 	$line[8]); 	// set image
	$gethandler->SaveRecord();
}

$gethandler->CompleteGet();

// Loads a CSV file and returns an array of records.
// This function uses standard PHP. There is no specific grid functionality here.
function LoadCSVFile($filename)
{
	$records = array();
	if (is_readable($filename))
	{
		$handle = fopen($filename, 'r');
		while (($line = fgetcsv($handle)) !== FALSE)
		{
			$records[] = $line;
		}
		fclose($handle);
	}
	return $records;
}

?>
