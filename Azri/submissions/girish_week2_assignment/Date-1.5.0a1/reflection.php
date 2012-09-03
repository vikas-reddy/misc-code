<?
include('Date.php');

$classes = get_declared_classes();
foreach($classes as $class){
	$rclass = new ReflectionClass($class);
	if(!$rclass->isInternal())
	{
		print $class."\n";
		$funcs=$rclass->getMethods();
		foreach($funcs as $fun)
			echo "------- {$fun->getName()} \n";
	}
}
?>
