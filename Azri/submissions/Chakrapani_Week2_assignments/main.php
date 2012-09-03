<?
include('regexp.php');
include('utf8_length.php');
include('array_2_object.php');
include('csv_parse.php');

/**********INPUT****************/
$string_url = "... http://php.net is an url like https://web.iiit.ac.in still testing ftp://web.iiit.ac.in";

$string_utf = "Š sÃ¥ ¥";

$input_array = array('first value', 'second value', 3, 4);
$input_hash = array('me' => 'Sebastian','you' => 'Anonymous','he' => 'Bill');

$input_csv = "employee_data.csv" ; /*If u change this file,give input to it according to sql file*/
$host_db = "localhost" ;
$user_db = "root" ;
$paswd_db = "iiit123" ;
/**********INPUT****************/

/**********Function Calls****************/
/**Uncomment required Function call  to run *****/

//$string_link = url_to_link($string_url);
$utf_length = utf8_length($string_utf);
//$array_obj = array_to_object($input_array);
//$hash_obj = hash_to_object($input_hash);

/***Run sql file before running the below function***/
//csv_parse_store($input_csv,$host_db,$user_db,$paswd_db);


/**********OUTPUT****************/
//echo "Url string converted to links ::\n".$string_link . "\n" ;
echo "UTF8-String length : ".$utf_length . "\n";
?>
