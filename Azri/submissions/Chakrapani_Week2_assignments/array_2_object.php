<?
/*
$first_array = array('first value', 'second value', 3, 4);
$second_array= array('me' => 'Sebastian','you' => 'Anonymous','he' => 'Bill');
*/
function array_to_object($first_array){
	$obj_array = (object) $first_array;

	echo "TYPE I :: Array\n";
	echo "INPUT(array with intiger indexes) :: array('first value', 'second value', 3, 4) \n";
	echo "OUTPUT:: This is converted to object \$obj_array \n";
	echo "variable type of \$obj_array = ".gettype($obj_array)."\n";
	echo "class of \$obj_array = ".get_class($obj_array)."\n";
	echo "contents of obj \$obj_array ::\n";

	foreach($obj_array as $key => $val)
	{
		echo "\$obj_array->".$key."=".$obj_array->$key.",";  
		/*
		   THIS DOES NOT WORK OR PRINT BECAUSE VARIABLES CANNOT BEGIN WITH NUMBERS 
		   SO IN OBJECTS WE CANNOT USE \$OBJECT->NUMBER
		 */
	}

	echo "\nTHIS DOES NOT WORK OR PRINT BECAUSE VARIABLES CANNOT BEGIN WITH NUMBERS
		SO IN OBJECTS WE CANNOT USE \$OBJECT->NUMBER \n HENCE CONTENTS OF OBJECT ARE PRINTED AS BELOW...[key]=>[value]\n<BR>";

	foreach($obj_array as $key => $val)
		echo $key."=>".$val."," ; /*THIS PRINTS...*/
	echo "\n";
	return $obj_array;
}
function hash_to_object($second_array){
	$obj_hash = (object) $second_array;

	echo "TYPE II :: HASH\n";
	echo "INPUT(array with string indexes) :: array('me' => 'Sebastian','you' => 'Anonymous','he' => 'Bill') \n";
	echo "OUTPUT:: This is converted to object \$obj_hash \n";
	echo "variable type of \$obj_hash = ".gettype($obj_hash)."\n";
	echo "class of \$obj_hash = ".get_class($obj_hash)."\n";
	echo "contents of obj \$obj_hash :: Printed using \$object->variable\n";

	foreach($obj_hash as $key => $val)
		echo "\$obj_hash->".$key."=".$obj_hash->$key.",";
	echo "\n";
	return $obj_hash;
}
?>
