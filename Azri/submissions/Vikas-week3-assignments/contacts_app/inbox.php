<?php
session_start();

// Redirect to login page
if(!isset($_SESSION['user_name']) or !$_SESSION['user_name'])
{
	header("Location: login.php");
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
		<title>Inbox of <?php echo $_SESSION['name'];?></title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Inbox of <?php echo $_SESSION['name'];?>
			</div>
			<div class="main">
				<!-- Logout Form -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>
				</form>

					<table border="1" cellpadding="5">
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Website URL</th>
							<th>Address</th>
							<th>Contact Number</th>
							<th>Modify</th>
						</tr>

<?php

mysql_connect("localhost", "root", "vikky123");
mysql_select_db("Contacts");

$query  = "SELECT * FROM " . $user_name . "_flist;";
$result = mysql_query($query);

echo "<p>Number of friends = " . mysql_num_rows($result) . "</p>";

while($row = mysql_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['Name'] . "</td>";
	echo "<td>" . $row['Email'] . "</td>";
	echo "<td>" . $row['Website_Url'] . "</td>";
	echo "<td>" . $row['Address'] . "</td>";
	echo "<td>" . $row['Contact_No'] . "</td>";
	echo "<td> <a href=\"edit.php?FID=" . $row['FID'] . "\">Edit</a> <br />";
	echo "     <a href=\"delete.php?FID=" . $row['FID'] . "\">Delete</a>";
	echo "</tr>";
}

mysql_free_result($result);
mysql_close();
?>
					</table>
					<p style="text-align:center;">
						<a href="add.php">Add New Friend</a>
					</p>
			</div>
		</div>
	</body>
</html>
