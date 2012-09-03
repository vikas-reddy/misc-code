<?
/*
employee
eno fname intial dob salary address
ex.csv conatins the data in csv format

   */
$host='localhost';
$user='root';
$pass='';
$con=mysql_connect($host,$user,$pass);
if(!$con)
	echo "connection failed\n";
else
	echo "succesfully coneected";
$file=fopen("ex.csv","r");
$logfile=fopen("logfile","a");
fseek($logfile,0,SEEK_END);
$line=fgetcsv($file);
while($line){
echo $line[0];
echo $line[1];
echo $line[2];
echo $line[3];
echo $line[4];
echo $line[5];
echo $line[6];


$sql = "INSERT INTO employee ".
       "(eno,fname, intial,lname, dob,salary,address) ".
              "VALUES('$line[0]','$line[1]','$line[2]', '$line[3]','$line[4]','$line[5]','$line[6]')";
	      mysql_select_db('EmployeeDatabase');
	      $retval = mysql_query( $sql, $con );
if(! $retval )
{
	  fwrite($logfile, date("d/m/y G:m:s").':Could not enter data: ' . mysql_error()."\n");
}
echo "Entered data successfully\n";
$line=fgetcsv($file);
}
mysql_close($conn);
echo date();

?>
