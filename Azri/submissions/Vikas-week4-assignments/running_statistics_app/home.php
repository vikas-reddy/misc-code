<?php
session_start();

// Redirect to login page
if(!isset($_SESSION['user_name']) or !$_SESSION['user_name'])
{
	header("Location: login.php");
}
if(isset($_POST['view_comments']))
{
	header("Location: view_comments.php");
}

$user_name = $_SESSION['user_name'];
$name      = $_SESSION['name'];

if(isset($_POST['logout']))
{
	session_destroy();
	$_SESSION = array();
	header("Location: login.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Running Statistics: Home of <?php echo $_SESSION['name'];?></title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Running Statistics: Home of <?php echo $_SESSION['name'];?>
			</div>
			<div class="main">
				<!-- Logout Form -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>

<?php
// Fetching information from session
$user_name = $_SESSION['user_name'];
$name      = $_SESSION['name'];

mysql_connect("localhost", "vikas");
mysql_select_db("RunningStatistics");

// Formatting date
$today = getdate();
$date  = sprintf("%04d%02d%02d\n", $today['year'], $today['mon'], $today['mday']);

// Displaying Today's Speed
if(!isset($_POST['update']))
{

	$query = "SELECT rdist,rtime FROM {$user_name}_stat WHERE
				rundate={$date};";
	$result= mysql_query($query);

	if(mysql_num_rows($result) == 0)
	{
		// Speed not yet set
		$rdist = "";
		$rtime = "";
	}
	else
	{
		$row = mysql_fetch_array($result);
		$rdist = $row['rdist'];
		$rtime = $row['rtime'];
		$latest_speed = sprintf("%.2f", $rdist/(60*$rtime));
	}
}
else
{
	$rdist = $_POST['rdist'];
	$rtime = $_POST['rtime'];
	$latest_speed = sprintf("%.2f", $rdist/(60*$rtime));

	$query = "UPDATE UserInformation SET latest_speed={$latest_speed} WHERE user_name=\"{$user_name}\";";
	mysql_query($query);

	$query = "SELECT * FROM {$user_name}_stat WHERE rundate={$date};";
	$result= mysql_query($query);

	if(mysql_num_rows($result) == 0)
	{
		// New entry
		$query = "INSERT INTO {$user_name}_stat VALUES ({$date},{$rdist},{$rtime});";
	}
	else
	{
		// Update today's speed
		$query = "UPDATE {$user_name}_stat SET rdist={$rdist}, rtime={$rtime} WHERE rundate={$date};";
	}
	mysql_query($query);
}
?>

					<div style="border:1px outset black;width:50%;padding:10px;">
							<p style="font-size:12pt;text-decoration:underline;">Today's Speed</p>
							<input type="text" name="rdist" size="4" value="<?php echo $rdist;?>" /> meters per
							<input type="text" name="rtime" size="4" value="<?php echo $rtime;?>" /> minutes.
							<br /> i.e.,
							<span style="font-weight:bold"><?php echo $latest_speed;?> mts/sec</span>
							<p> <input type="submit" name="update" value="Update Speed" /> </p>
					</div>
					
<?php
// Calculating rank of the user
$query = "SELECT latest_speed from UserInformation ORDER BY latest_speed DESC;";
$result= mysql_query($query);

$rank = 0;
$total= mysql_num_rows($result);
while($row = mysql_fetch_array($result))
{
	$rank++;
	if($row['latest_speed'] == $latest_speed)
		break;
}
?>

					<p style="text-align:center;font-size:12pt;font-family:arial;margin:40px">
						Your rank among <?php echo "{$total} users is <b>{$rank}</b>"?>.
					</p>
					<p style="font-size:12pt;text-decoration:underline;">Analyze Progress</p>
<?php
if(!isset($_POST['view_stats']))
{
	$num = 10;
	$units = "Months";
}
else
{
	$num   = $_POST['num'];
	$units = $_POST['units'];
}
?>
					<p>
						Last <input type="text" name="num" value="<?php echo $num;?>" />
						<select name="units">
							<option selected="selected">Days</option>
							<option>Weeks</option>
							<option>Months</option>
						</select>
					</p>
					<p><input type="submit" name="view_stats" value="View Stats" /></p>

<?php

if($num >= 0 and $units)
{
	// *********** NEED TO RELOOK ***********
	switch ($units)
	{
		case "Days"   : $from_date = $date -    $num; break;
		case "Weeks"  : $from_date = $date -  7*$num; break;
		case "Months" : $from_date = $date - 30*$num; break;
	}

	$query  = "SELECT * FROM {$user_name}_stat WHERE rundate > {$from_date} ORDER BY rundate DESC;";
	$result = mysql_query($query);

	//Printing table
	echo "<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">";
	echo "<tr> <th>Date</th> <th>Speed</th> </tr>";
	while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>{$row['rundate']}</td>";
		echo "<td>" . $row['rdist']/(60*$row['rtime']) . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}

mysql_free_result($result);
mysql_close();
?>
				</form>
			</div>
		</div>
	</body>
</html>
