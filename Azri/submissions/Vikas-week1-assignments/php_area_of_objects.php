<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Area of objects</title>
		<link rel="stylesheet" type="text/css" href="Azri_First_Assignment.css" />
	</head>

	<body>
		<span class="heading">Area of objects</span>
		<br /> <br />

		<?php
			if($_GET['Type'] == NULL)
			{
		?>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
			<table cellspacing="4" cellpadding="5">
				<tr>
					<td>Object Type: </td>
					<td>
						<input type="radio" name="Type" value="Circle" checked="checked" /> Circle <br />
						<input type="radio" name="Type" value="Square" /> Square <br />
						<input type="radio" name="Type" value="Triangle" /> Triangle <br />
					</td>
				</tr>
				<tr>
					<td>Dimensions: </td>
					<td>
						1 <input type="text" name="dimen1" value="0" /> <br />
						2 <input type="text" name="dimen2" value="0" />
					</td>
				</tr>
			</table>
			<br /><br />
			<input type="submit" value="Calculate area" />
		</form>

<?php
			}
			else
			{
				class figure
				{
					public $area = 0;
					protected $dimensions = NULL;

					public function set_dimensions($dimen)
					{
						$this->dimensions = $dimen;
					}
				}

				class Triangle extends figure
				{
					public function area()
					{
						$this->area =  0.5 * $this->dimensions[0] * $this->dimensions[1];
					}
				}

				class Circle extends figure
				{
					public function area()
					{
						$this->area =  3.14 * $this->dimensions[0] * $this->dimensions[0];
					}
				}

				class Square extends figure
				{
					public function area()
					{
						$this->area =  $this->dimensions[0] * $this->dimensions[0];
					}
				}


				// Creating the object of type "Type"
				$obj = new $_GET['Type'];

				// Giving dimensions to the object
				$obj->set_dimensions(array($_GET['dimen1'], $_GET['dimen2']));

				// Compute area
				$obj->area();


				// Print the output
				echo "Area of this " . $_GET['Type'] . " is <b>" . $obj->area . "</b> units <br />";

			}
?>

	</body>
</html>
