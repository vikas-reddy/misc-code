<?php
error_reporting(E_ALL);
ini_set("display_errors", TRUE);

/*
 * Array to Objects conversion
 *
 */

// Array object not working
$array1 = Array("first entry", "second entry", "Third Entry", "FOURTH ENTRY");
$array2 = Array(0 => "first entry", 1 => "second entry", 2 => "Third Entry", 3 => "FOURTH ENTRY", 4 => 5, 5 => 6, 6 => 7.0);


$array_obj = (object) $array2;
echo $array_obj;
//echo "\$array_obj->0 = {$array2->0}\n";



// MAP object working
$hash = Array( "one" => "first entry",
				"two" => "second entry",
				"three" => "Third Entry",
				"four" => "FOURTH ENTRY");
$hash_obj = (object) $hash;
echo "\$hash_obj->one = {$hash_obj->one}\n";
?>
