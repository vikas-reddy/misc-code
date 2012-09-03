<?
/*All user defined and system defined classes are printed...*/

/********INPUT********/
$input_file = "Date.php";
$temp_file= "/home/chakri/Desktop/date_edited_file";
/********INPUT********/
/*Getting Non existing temporary file name*/
while(file_exists ($temp_file))
	$temp_file=$temp_file."_1";
$temp_file = $temp_file.".php";

/*creating a temporary file to copy edited input file*/
$fp_output = fopen ($temp_file,"a");

/*Reading contents of inputfile */

$file_contents = file($input_file);
foreach($file_contents as $line)
{
	/*Editing input file contents by commenting including files TO GET CLASSES OF ONLY INPUT FILE*/
	$text_edited = preg_replace("@((include_once)|(require_once))+ ((\".*\")|('.*'))+(;)+@",'/*$0*/',$line);

	/*Writing edited contents to a Temporary file*/
	fputs($fp_output,$text_edited);
}
fclose($fp_output);
/*
   Uncomment the below line of code to get all the classes including the incuding_once and required_once file classes
 */
/*$temp_file = $input_file;*/

/*Including the edited Temporary File*/
include $temp_file;

/*Get classes of the script..*/
$declared_classes = get_declared_classes();
foreach($declared_classes as  $row)
{
	/*Getting Functions of each Class*/
	echo "Functions of class :: ".$row."\n";
	$fns_classes = get_class_methods($row);
	foreach($fns_classes as $function)
		echo "\t".$function."\n";
}
/*Getting and printing User Defined Functions Outside all the classes*/
$defined_fns = get_defined_functions();
echo "User Defined Functions Outside Classes :: \n";
foreach ($defined_fns[user] as $val)
	echo "\t".$val."\n";

/*Deleting the Temporary file*/	
if(file_exists ($temp_file))
	unlink($temp_file);

?>
