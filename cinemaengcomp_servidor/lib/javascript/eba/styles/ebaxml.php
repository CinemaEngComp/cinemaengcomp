<?php

// *****************************************************************************
// *****************************************************************************
// * EBAXML PHP Library v2.01
// *****************************************************************************
// * Copyright (C) eBusiness Applications
// * The SOFTWARE PRODUCT is protected by copyright laws and international
// * copyright treaties, as well as other intellectual property laws and treaties.
// * The SOFTWARE PRODUCT is licensed, not sold. The eBusiness Applications
// * distribution file may not have files added to it or removed from it.
// * None of its compiled or encoded contents may be decompiled, or reverse engineered.
// * You may not reverse engineer, decompile, or disassemble the SOFTWARE PRODUCT,
// * except and only to the extent that such activity is expressly permitted by
// * applicable law notwithstanding this limitation.
// *****************************************************************************

class EBAGetHandler
{
	var $FieldsCount = 0;
	var $Fields = array();
	var $Status = 0;
	var $Recordset = array();
	var $FieldsSet = array();

	function EBAGetHandler()
	{
	}

	function ConvertDate($MyDate)
	{
		foreach($MyDate as $item=>$value) {
			if ($value < 10)
			{
				$MyDate[$item] = "0".$value;
			}
		}

		return $MyDate['year']."-".$MyDate['mon']."-".$MyDate['mday']." ".$MyDate['hours'].":".$MyDate['minutes'].":".$MyDate['seconds'];
	}

	function ProcessRecords($XMLEncoding="utf-8")
	{
		header("Content-type: text/xml");
		//print "<?xml version=\"1.0\" encoding=\"";
		//print $XMLEncoding;
		//print "\">";

		$EBAFieldOrder = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

		$MainSetCounter = 0;

		for ( $ebacounter = 0; $ebacounter < 26; $ebacounter += 1)
		{
			$this->FieldsSet[$ebacounter] = $EBAFieldOrder[$ebacounter];
			$MainSetCounter += 1;
		}

		for ( $ebacounter = 0; $ebacounter < 26; $ebacounter += 1)
		{
			for ( $nebacounter = 0; $nebacounter < 26; $nebacounter += 1)
			{
				$this->FieldsSet[$MainSetCounter] = $EBAFieldOrder[$ebacounter] . $EBAFieldOrder[$nebacounter];
				$MainSetCounter += 1;
			}
		}

	}

	function CompleteGet()
	{

		if ($this->Status == 1)
		{
			print "\">";
		}
		print "</root>";
	}

	function DefineField($FieldName)
	{
		$this->Status = 1;

		if ($this->FieldsCount == 0)
		{

			print "<root fields=\"";
		}
		else
		{
			print "|";
		}

		$this->Fields[$this->FieldsCount] = $FieldName;
		print $this->Fields[$this->FieldsCount];
		$this->FieldsCount += 1;

	}

	function CreateNewRecord($KeyVal)
	{
		if ($this->Status == 1)
		{
			print "\">";
		}

		print "<e xk=\"";
		print $KeyVal;
		print "\" ";

		$this->Status = 2;
		$numFields = $this->FieldsCount;
		for ( $counter = 0; $counter < $numFields; $counter += 1)
		{
			$this->Recordset[$counter] = "";
		}
	}

	function SaveRecord()
	{
		if ($this->Status == 2)
		{
			$numFields = $this->FieldsCount;
			for ( $counter = 0; $counter < $numFields; $counter += 1)
			{
				print $this->FieldsSet[$counter];
				print "=\"";
				print $this->Recordset[$counter];
				print "\" ";
			}
			print "/>";
		}
	}

	function DefineRecordFieldValue($ColName, $DataValue)
	{
		if ($this->Status == 2)
		{
			// REMEMBER TO PREFORMAT THE STRING
			$EBAKey = array_search($ColName, $this->Fields);
			if ($EBAKey !== FALSE)
			{
				$this->Recordset[$EBAKey] = htmlentities(htmlentities($DataValue));
			}
		}
	}
}

class EBASaveHandler
{
	var $InsertRecords = array();
	var $UpdateRecords = array();
	var $DeleteRecords = array();
	var $InsertCount = 0;
	var $UpdateCount = 0;
	var $DeleteCount = 0;
	var $Fields = array();
	var $FieldsCount = 0;
	var $FieldsSet = array();

	function EBASaveHandler()
	{
	}

	function CompleteSave()
	{
		print $GLOBALS["HTTP_RAW_POST_DATA"];
	}

	function ReturnInsertCount()
	{
		return $this->InsertCount;
	}

	function ReturnUpdateCount()
	{
		return $this->UpdateCount;
	}

	function ReturnDeleteCount()
	{
		return $this->DeleteCount;
	}

	function ReturnInsertField($RecordNumber, $FieldName = "")
	{
		$postData = $GLOBALS["HTTP_RAW_POST_DATA"];

		$EBAResultValue = "";
		$EBASearchField = "";
		$index = array_search($FieldName, $this->Fields);
		if (($index !== FALSE) || ($FieldName == ""))
		{
			$EBASearchField = "xk=\"";
			if (strlen($FieldName) > 0)
			{
				$EBASearchField = $this->FieldsSet[$index]."=\"";
				if ($this->FieldsSet[$index] == "k")
				$EBASearchField = " ".$this->FieldsSet[$index] ."=\"";
			}

			$EBAUpdateGramTemp = EBAright($postData, strlen($postData) - $this->InsertRecords[$RecordNumber]);
			$EBANextPos = strpos($EBAUpdateGramTemp, $EBASearchField);

			if ($EBANextPos > 0)
			{
				$EBAUpdateGramTemp = EBAright($EBAUpdateGramTemp, strlen($EBAUpdateGramTemp) - $EBANextPos - strlen($EBASearchField));
				$EBANextPos = strpos($EBAUpdateGramTemp, "\"");
				$EBAUpdateGramTemp = EBAleft($EBAUpdateGramTemp,$EBANextPos);
				$EBAResultValue = $EBAUpdateGramTemp;
			}
		}
		return $EBAResultValue;
	}

	function ReturnUpdateField($RecordNumber, $FieldName = "")
	{
		$postData = $GLOBALS["HTTP_RAW_POST_DATA"];

		$EBAResultValue = "";
		$EBASearchField = "";
		$index = array_search($FieldName, $this->Fields);


		if (($index !== FALSE) || ($FieldName == ""))
		{
			$EBASearchField = "xk=\"";
			if (strlen($FieldName) > 0)
			{
				$EBASearchField = $this->FieldsSet[$index] ."=\"";
				if ($this->FieldsSet[$index] == "k")
					$EBASearchField = " ".$this->FieldsSet[$index] ."=\"";

			}
			$EBAUpdateGramTemp = EBAright($postData, strlen($postData) - $this->UpdateRecords[$RecordNumber]);

			$EBANextPos = strpos($EBAUpdateGramTemp, $EBASearchField);
			if ($EBANextPos > 0)
			{
				$EBAUpdateGramTemp = EBAright($EBAUpdateGramTemp, strlen($EBAUpdateGramTemp) - $EBANextPos - strlen($EBASearchField));
				$EBANextPos = strpos($EBAUpdateGramTemp, "\"");
				$EBAUpdateGramTemp = EBAleft($EBAUpdateGramTemp, $EBANextPos);
				$EBAResultValue = $EBAUpdateGramTemp;
			}
		}
		return $EBAResultValue;
	}

	function ReturnDeleteField($RecordNumber)
	{
		$postData = $GLOBALS["HTTP_RAW_POST_DATA"];

		$EBAResultValue = "";
		$EBASearchField = "xk=\"";
		$EBADeleteGramTemp = EBAright($postData, strlen($postData) - $this->DeleteRecords[$RecordNumber]);
		$EBANextPos = strpos($EBADeleteGramTemp, $EBASearchField);

		if ($EBANextPos > 0)
		{
			$EBADeleteGramTemp = EBAright($EBADeleteGramTemp, strlen($EBADeleteGramTemp) - $EBANextPos - strlen($EBASearchField));
			$EBANextPos = strpos($EBADeleteGramTemp, "\"");
			$EBADeleteGramTemp = EBAleft($EBADeleteGramTemp, $EBANextPos);
			$EBAResultValue = $EBADeleteGramTemp;
		}
		return $EBAResultValue;
	}

	function ProcessRecords()
	{
		$postData = $GLOBALS["HTTP_RAW_POST_DATA"];

		// Populate EBAGetHandler_Fields with the fields names
		$EBAUpdategram = $postData;
		$ParsePos = 0;
		if (strlen($EBAUpdategram) > 5)
		{
			$ParsePos = strpos(strtolower($EBAUpdategram), "fields");
			$ParsePos = strpos(EBAright($EBAUpdategram, strlen($EBAUpdategram) - $ParsePos), "\"") + 7;
 			$EBAUpdategram = EBAright($EBAUpdategram, strlen($EBAUpdategram) - $ParsePos);

			//Begin grabbing fields
			$EBANextPos = 0;
			$EBAFieldName = "";
			do
			{
				$EBANextPos = strpos($EBAUpdategram, "|");
				if ($EBANextPos > 0)
				{
					$EBAFieldName = EBAleft($EBAUpdategram, $EBANextPos);
					$EBAUpdategram = EBAright($EBAUpdategram, strlen($EBAUpdategram) - $EBANextPos - 1);
					$this->Fields[$this->FieldsCount] = $EBAFieldName;
					$this->FieldsCount += 1;
				}
			}
			while ($EBANextPos > 0);

			$EBANextPos = strpos($EBAUpdategram, "\"");
			if ($EBANextPos > 0)
			{
				$EBAFieldName = EBAleft($EBAUpdategram, $EBANextPos);
				$EBAUpdategram = EBAright($EBAUpdategram, strlen($EBAUpdategram) - $EBANextPos - 1);
				$this->Fields[$this->FieldsCount] = $EBAFieldName;
				$this->FieldsCount += 1;
			}

			// Now we count the insert instructions
			$EBAUpdategram = $postData;
			$EBAUpdateGramTemp = $EBAUpdategram;
			$EBATotalCount = 0;
			do
			{
				$EBANextPos = strpos($EBAUpdateGramTemp, "<insert");
				if ($EBANextPos > 0)
				{
					$EBATotalCount += $EBANextPos+1;
					$this->InsertRecords[$this->InsertCount] = $EBATotalCount;
					$this->InsertCount += 1;
					$EBAUpdateGramTemp = EBAright($EBAUpdateGramTemp, strlen($EBAUpdateGramTemp) - $EBANextPos - 1);
				}
			}
			while ($EBANextPos > 0);

			$EBAUpdateGramTemp = $EBAUpdategram;
			$EBATotalCount = 0;
			do
			{
				$EBANextPos = strpos($EBAUpdateGramTemp, "<update");
				if ($EBANextPos > 0)
				{
					$EBATotalCount += $EBANextPos;
					$this->UpdateRecords[$this->UpdateCount] = $EBATotalCount;
					$this->UpdateCount += 1;
					$EBAUpdateGramTemp = EBAright($EBAUpdateGramTemp, strlen($EBAUpdateGramTemp) - $EBANextPos - 1);
				}
			}
			while ($EBANextPos > 0);

			$EBAUpdateGramTemp = $EBAUpdategram;
			$EBATotalCount = 0;
			do
			{
				$EBANextPos = strpos($EBAUpdateGramTemp, "<delete");
				if ($EBANextPos > 0)
				{
					$EBATotalCount += $EBANextPos;
					$this->DeleteRecords[$this->DeleteCount] = $EBATotalCount;
					$this->DeleteCount += 1;
					$EBAUpdateGramTemp = EBAright($EBAUpdateGramTemp, strlen($EBAUpdateGramTemp) - $EBANextPos - 1);
				}
			}
			while ($EBANextPos > 0);

			$EBAFieldOrder = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
			$MainSetCounter = 0;
			for ( $ebacounter = 0; $ebacounter < 26; $ebacounter += 1)
			{
				$this->FieldsSet[$ebacounter] = $EBAFieldOrder[$ebacounter];
				$MainSetCounter += 1;
			}
			for ( $ebacounter = 0; $ebacounter < 26; $ebacounter += 1)
			{
				for ( $nebacounter = 0; $nebacounter < 26; $nebacounter += 1)
				{
					$this->FieldsSet[$MainSetCounter] = $EBAFieldOrder[$ebacounter] . $EBAFieldOrder[$nebacounter];
					$MainSetCounter += 1;
				}
			}
		}
		else
		{
			print "No valid EBA updategram was discovered!";
		}
	}
}

function EBAleft ($str, $howManyCharsFromLeft)
{
	return substr ($str, 0, $howManyCharsFromLeft);
}

function EBAright ($str, $howManyCharsFromRight)
{
	$strLen = strlen ($str);
	return substr ($str, $strLen - $howManyCharsFromRight, $strLen);
}

function EBAmid ($str, $start, $howManyCharsToRetrieve = 0)
{
	$start--;
	if ($howManyCharsToRetrieve == 0)
	$howManyCharsToRetrieve = strlen ($str) - $start;
	return substr ($str, $start, $howManyCharsToRetrieve);
}

function getDateForMysqlDateField() {
}

?>