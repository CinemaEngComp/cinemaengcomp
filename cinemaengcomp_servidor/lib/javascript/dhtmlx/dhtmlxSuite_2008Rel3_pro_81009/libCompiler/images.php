<?php
function copyImgsFiles($source,$dest,$skin)
{ 
if (!is_dir($source)) return;
$folder = opendir($source);
while($file = readdir($folder))
{
if ($file == '.' || $file == '..') {
           continue;
       }
       
       if(is_dir($source.$file))
       {
       		if ($file!=".svn" && (strpos($file,"dhx")===false || strpos($file,$skin)!==false)){
       			@mkdir($dest.$file);
       			copyImgsFiles($source.$file."/",$dest.$file."/",$skin);
   			}
       			
       }
       else 
       {
       //echo $source.$file;
        copy($source.$file,$dest.$file);
       }
}
closedir($folder);
return 1;
}

function export_images($component,$skin){
	$name=time();
	while (file_exists("./export/".$name)){
		$name+=1;
	}

	$name="./export/".$name;
	
	mkdir($name);
	mkdir($name."/imgs");
	
	for ($i=0; $i < sizeof($component); $i++) { 
		copyImgsFiles("../".$component[$i]."/codebase/imgs/",$name."/imgs/",$skin);
	}
	return $name;
};

//export_images(array("dhtmlxwindows","dhtmlxgrid"),"glassy_blue");

?>