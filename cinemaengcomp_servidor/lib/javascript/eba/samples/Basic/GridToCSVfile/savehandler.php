<?php

require("EBAXML.PHP");

// This file is used as a Save Handler for the Grid control. When the user clicks
// the save button in index.asp a datagram is sent to this script.
// The script in turn looks at each update in the datagram and processes them accordingly.
// We have provided all the necessary functionality in the$savehandler-> functions to
// extract any of the update instructions.
// For more details please have a look at our shipped online help under Reference/Server.

// Load the CSV file and call$savehandler->ProcessRecords to set everything up

$records = LoadCSVFile("data" . DIRECTORY_SEPARATOR . "data.csv");

$savehandler = new EBASaveHandler();
$savehandler->ProcessRecords();

/***********************************************************
** Begin by processing our inserts
************************************************************/
$insertCount =$savehandler->ReturnInsertCount();
if ($insertCount > 0)
{
	// Yes there are INSERTs to perform...
	for ($currentRecord = 0; $currentRecord < $insertCount; $currentRecord++)
	{
		$newEntry = array();

		// key, as we do not have defined an onGenerateRecordKey
		$newEntry[0] = $savehandler->ReturnInsertField($currentRecord, "");
		$newEntry[1] = $savehandler->ReturnInsertField($currentRecord, "client");
		$newEntry[2] = $savehandler->ReturnInsertField($currentRecord, "service");
		$newEntry[3] = $savehandler->ReturnInsertField($currentRecord, "quantity");
		$newEntry[4] = $savehandler->ReturnInsertField($currentRecord, "charge");
		$newEntry[5] = $savehandler->ReturnInsertField($currentRecord, "memo");
		$newEntry[6] = $savehandler->ReturnInsertField($currentRecord, "date");
		$newEntry[7] = $savehandler->ReturnInsertField($currentRecord, "inet");
		$newEntry[8] = $savehandler->ReturnInsertField($currentRecord, "image");

		InsertRecord($newEntry, $records);
	}
}

/***********************************************************
** Continue by processing our updates
************************************************************/
$updateCount =$savehandler->ReturnUpdateCount();
if ($updateCount > 0)
{
	// Yes there are UPDATEs to perform...
	for ($currentRecord = 0; $currentRecord < $updateCount; $currentRecord++)
	{
		$updateEntry = array();

		$key =$savehandler->ReturnUpdateField($currentRecord, "");
		$updateEntry[0] = $key;
		$updateEntry[1] = $savehandler->ReturnUpdateField($currentRecord, "client");
		$updateEntry[2] = $savehandler->ReturnUpdateField($currentRecord, "service");
		$updateEntry[3] = $savehandler->ReturnUpdateField($currentRecord, "quantity");
		$updateEntry[4] = $savehandler->ReturnUpdateField($currentRecord, "charge");
		$updateEntry[5] = $savehandler->ReturnUpdateField($currentRecord, "memo");
		$updateEntry[6] = $savehandler->ReturnUpdateField($currentRecord, "date");
		$updateEntry[7] = $savehandler->ReturnUpdateField($currentRecord, "inet");
		$updateEntry[8] = $savehandler->ReturnUpdateField($currentRecord, "image");

		UpdateRecord($key, $updateEntry, $records);
	}
}

/***********************************************************
** Finish by processing our deletes
************************************************************/
$deleteCount =$savehandler->ReturnDeleteCount();
if ($deleteCount > 0)
{
	// Yes there are DELETEs to perform...
	for ($currentRecord = 0; $currentRecord < $deleteCount; $currentRecord++)
	{
		$key =$savehandler->ReturnDeleteField($currentRecord);
		DeleteRecord($key, $records);
	}
}

// Update the CSV.
SaveFile("data" . DIRECTORY_SEPARATOR . "data.csv", $records);

$savehandler->CompleteSave();

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

// Saves a CSV file given an array of records.
// This function uses standard PHP. There is  no specific grid functionality here.
function SaveFile($filename, $records)
{
	if (!file_exists($filename) || is_writeable($filename))
	{
		$handle = fopen($filename, 'w');
		foreach ($records as $record) {
			if ($record[0] != "delete")
			{
				fputcsv($handle, $record);
			}
		}
		fclose($handle);
		return 0;
	}
	return -1;
}

// Inserts a new entry into the array records
// This function uses standard PHP. There is  no specific grid functionality here.
function InsertRecord($newEntry, &$records)
{
	$count = count($newEntry);
	for ($i = 0; $i < $count; $i++)
	{
		$newEntry[$i] = str_replace(",", "", $newEntry[$i]);
	}
	$records[] = $newEntry;
}

// Updates the records Array with the given key and update entry
// This function uses standard PHP. There is  no specific grid functionality here.
function UpdateRecord($key, $updateEntry, &$records)
{
	$found = false;
	$count = count($records);
	for ($i = 1; $i < $count; $i++)
	{
		if ($records[$i][0] == $key)
		{
			$found = true;
			break;
		}
	}
	if ($found)
	{
		$count = count($records[$i]);
		for ($j = 0; $j < $count; $j++)
		{
			$records[$i][$j] = str_replace(",","", $updateEntry[$j]);
		}
	}
}

// Deletes one entry of the records Array with the given key
// This function uses standard PHP. There is  no specific grid functionality here.
function DeleteRecord($key, &$records)
{
	$count = count($records);
	for ($i = 0; $i < $count; $i++)
	{
		if ($records[$i][0] == $key)
		{
			$records[$i][0] = "delete";
			break;
		}
	}
}

function fputcsv($handle, $row, $fd=',', $quot='"')
{
	$str= "";
	foreach ($row as $cell) {
		str_replace(Array($quot, "\r\n"), Array($quot.$quot,  ''), $cell);
		if (strchr($cell, $fd))
		{
			$str .= $quot . $cell . $quot . $fd . ' ';
		}
		else
		{
			$str .= $cell . $fd . ' ';
		}
	}
	fputs($handle, substr($str, 0, -2) . "\r\n");

	return $str - 1;
}
?>
