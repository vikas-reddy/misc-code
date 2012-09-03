<?
/*
$input_string = "string";
echo $input_string . strlen($input_string)."\n";
$string_utf8 = utf8_encode($input_string);
echo "{$string_utf8} ". strlen($string_utf8)."\n";
$output_string = utf8_decode("ÃŠ sÃ¥ Ã¥");
echo $output_string. strlen($output_string)."\n";
echo strlen("ÃŠ sÃ¥ Ã¥")."\n";
*/
function utf8_length($input){
	return strlen(utf8_decode($input))."\n";
}
?>
