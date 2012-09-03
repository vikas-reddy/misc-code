<?php
session_start();

if(!isset($_SESSION['user_name']) or !$_SESSION['user_name'])
{
	header("Location: login.php");
}
if(isset($_POST['logout']))
{
	session_destroy();
	$_SESSION = array();
	header("Location: login.php");
}

// Fetching session details
$user_name = $_SESSION['user_name'];
$name      = $_SESSION['name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Adding new entry to <?php echo $name;?>'s Friends List</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Addign new entry to <?php echo $name;?>'s Friends List
			</div>
			<div class="main">
				<!-- Logout Form -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>
				</form>

<?php
if(!isset($_POST['add']))
{
?>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<table border="1" cellspacing="0" cellpadding="4">
						<tr>
							<td>Name</td>
							<td><input type="text" size="40" name="Name" /></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="text" size="40" name="Email" /></td>
						</tr>
						<tr>
							<td>Website_Url</td>
							<td><input type="text" size="40" name="Website_Url" /></td>
						</tr>
						<tr>
							<td>Contact_No</td>
							<td><input type="text" size="15" name="Contact_No" /></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><input type="text" size="60" name="Address" /></td>
						</tr>
					</table>
					<p style="text-align:center;">
						<input type="submit" name="add" value="Add" />
						<input type="reset" value="Reset" />
					</p>
				</form>

				<!-- Back to Inbox button -->
				<form action="inbox.php" method="post">
					<p style="text-align:center;">
						<input type="submit" value="Back to Inbox" />
					</p>
				</form>
	
<?php
}
else
{
	mysql_connect("localhost", "root", "vikky123");
	mysql_select_db("Contacts");

	$query  = "INSERT INTO " . $user_name . "_flist (Name, Email, Website_Url, Contact_No, Address) VALUES (";
	$query .= "\"" . $_POST['Name'] . "\", ";
	$query .= "\"" . $_POST['Email'] . "\", ";
	$query .= "\"" . $_POST['Website_Url'] . "\", ";
	$query .= "\"" . $_POST['Contact_No'] . "\", ";
	$query .= "\"" . $_POST['Address'] . "\");";

	mysql_query($query);
	mysql_close();
?>
				<p style="text-align:center;">Successfully added new friend <?php echo $_POST['Name'];?>!</p>
				<form action="inbox.php" method="post">
					<p style="text-align:center;">
						<input type="submit" value="Back to Inbox" />
					</p>
				</form>
<?php
}
?>
		</div>
	</body>
</html>
