<?
function url_to_link($text){
	return preg_replace("@((https?|ftp)://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@", '<a href="$1">$1</a>', $text);
}
?>
