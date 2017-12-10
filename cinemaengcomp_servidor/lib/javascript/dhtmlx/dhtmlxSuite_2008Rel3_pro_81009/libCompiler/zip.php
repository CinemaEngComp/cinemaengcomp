<?php
	header("Content-type:application/zip");
	header("Content-Disposition: attachment; filename=dhtmlx.zip");
	include("./ziplib.php");
	
	function zipImgsFiles($source,$zip)
	{ 
		
		$folder = opendir($source==""?"./":$source);
		while($file = readdir($folder))
		{
		if ($file == '.' || $file == '..') {
		           continue;
		       }
		       
		       if(is_dir($source.$file))
		       {
	                zipImgsFiles($source.$file."/",$zip);
		       }
		       else 
		       {
		        $zip->zl_add_file(file_get_contents($source.$file),$source.$file,"g0");
		       }
		}
		closedir($folder);
		return 1;
	}

	
	chdir($_GET['location']);	
	$zip = new Ziplib;
	$zip->zl_add_file(file_get_contents("dhtmlx.js"),'dhtmlx.js',"g9");
	$zip->zl_add_file(file_get_contents("dhtmlx.css"),'dhtmlx.css',"g9");
	$zip->zl_add_file(file_get_contents("manifest.txt"),'manifest.txt',"g9");
	zipImgsFiles("imgs/",$zip);
	$outZip = $zip->zl_pack("");
	
	echo $outZip;
?>