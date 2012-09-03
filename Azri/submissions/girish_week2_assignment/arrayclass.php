<?
class arrayclass
{
	var $arry=array();
	function __set($d,$v)
	{
		$this->arry[$d]=$v;
	}
	function __get($d)
	{
		return $this->arry[$d];
	}

}
function arraytoclass($arr)
{
	$ar=new arrayclass();
	foreach($arr as $key => $val)
	{
		$ar->$key=$val;
	}
	return $ar;

}
$arr=array('a' => 'one', 2 => 'two', 3 => 'three');
$ex=new arrayclass();
$ex= arraytoclass($arr);
print $ex->{2};

?>
