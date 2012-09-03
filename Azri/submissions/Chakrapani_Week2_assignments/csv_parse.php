<?
function csv_parse_store($inputfile_csv,$host_db,$user_db,$paswd_db){ 
/*********INPUT**********/
//$inputfile_csv = "employee_data.csv";
$output_log = "logfile_csv.txt";

/*
$hostname = "localhost";
$username = "root";
$password = "iiit123";
*/
$hostname = $host_db;
$username = $user_db;
$password = $paswd_db ;

$dbname = "asnmt2_azri";
$table_name = "employee";
/*********INPUT**********/

$fp_input = fopen ($inputfile_csv,"r");

$fp_output = fopen ($output_log,"a");

/*
   Connecting to the database..
   */
$connection = mysql_connect($hostname,$username,$password);
if (!$connection)
	die ("Error in conecting database\n<BR>");
if(!mysql_select_db($dbname,$connection))
	die(mysql_error()."\n<BR>");
/*
   Parsing csv file using fgetcsv()
   */
while ($data = fgetcsv ($fp_input, 1000, ",")) {
	$values="";
	foreach($data as $row_entry)
	{
		if($values)
			$values = $values.",'".$row_entry."'";
		else
			$values = "'".$row_entry."'";
	}
	/*
	   Query to insert rows from the csv file to the database..
	   */
	$insert_query =	"insert into ".$table_name." values(".$values.");";
	//echo $insert_query."\n<BR>";
	$result = mysql_query($insert_query,$connection)
		or die (mysql_error()."\n<BR>");
	/*
	   Writing to the Log File...
	   */
	fputs($fp_output,$insert_query."\n");
}
/*
   Closing Opened Files and db connection..
   */
fclose ($fp_input);
fclose ($fp_output);
mysql_close();
}

?>
