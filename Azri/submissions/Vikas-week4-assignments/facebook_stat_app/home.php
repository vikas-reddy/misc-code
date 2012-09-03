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
		<title>Facebook: Home of <?php echo $_SESSION['name'];?></title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Facebook: Home of <?php echo $_SESSION['name'];?>
			</div>
			<div class="main">
				<!-- Logout Form -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>

<?php
$user_name = $_SESSION['user_name'];
$name = $_SESSION['name'];

mysql_connect("localhost", "vikas");
mysql_select_db("Facebook_StatMsg");

// Listing Invitations
$query  = "SELECT * FROM {$user_name}_invitations;";
$result = mysql_query($query);

if(mysql_num_rows($result) != 0)
{
	// Printing all the invitations
	echo "<p style=\"font-size:12pt;text-decoration:underline;\">Friend Requests</p>";
	echo "<table border=\"0\" class=\"center\">";
	while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td> {$row['frnd_uname']} wants to add you as a friend! 
				<a href=\"accept.php?frnd_uname={$row['frnd_uname']}&accept=yes\">Accept</a>
				<a href=\"accept.php?frnd_uname={$row['frnd_uname']}&accept=no\">Reject</a> </td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br /><br />";
}


// Displaying Status Message
if(!isset($_POST['update']))
{
	$query = "SELECT stat_msg FROM UserInformation WHERE user_name=\"{$user_name}\";";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$stat_msg = $row['stat_msg'];
}
else
{
	$stat_msg = htmlspecialchars($_POST['stat_msg']);
	$query = "UPDATE UserInformation SET stat_msg=\"" . mysql_escape_string($stat_msg) . 
		"\" WHERE user_name=\"{$user_name}\";";
	mysql_query($query);
}
?>
				
					<p class="center">
						Your Status Message:
						<input type="text" name="stat_msg" size="40" value="<?php echo $stat_msg;?>" />
					</p>
					<p class="center">
						<input type="submit" name="update" value="update" /><br />
						View Comments for your status message? <input type="submit" name="view_comments" value="View Comments" />
					</p>
					<br /><br />
					<p style="font-size:12pt;text-decoration:underline;">Status Messages of Friends</p>

<?php
// Listing friends' status messages
$query  = "SELECT name,frnd_uname,stat_msg FROM UserInformation, {$user_name}_flist WHERE user_name=frnd_uname;";
$result = mysql_query($query);

echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"5\">";
echo "<tr> <th>Friend Name</th> <th>Stat</th> <th>Rate/Comment</th></tr>";
while ($row = mysql_fetch_array($result))
{
	echo "<tr>";

	echo "<td>";
	echo $row['name'];
	echo "</td>";

	echo "<td>";
	echo $row['stat_msg'];
	echo "</td>";

	echo "<td>";
	echo "<a href=\"comment.php?frnd_uname={$row['frnd_uname']}\">[RATE/COMMENT]</a>";
	echo "</td>";

	echo "</tr>";
}
echo "</table>";


mysql_free_result($result);
mysql_close();
?>
				</form>

			<div style="margin-top:1cm;border:1px outset black;padding:0px 0px 0px 5px;">
				<p>Wanna invite your friend(s)?</p>
				<form action="invite_friends.php" method="post">
					<p>Email Address: <input type="text" name="email" /></p>
					<p><input type="submit" name="send" value="Send Invitation" /></p>
				</form>
			</div>
			</div>
		</div>
	</body>
</html>
