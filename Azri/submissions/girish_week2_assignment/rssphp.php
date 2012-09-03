<?
/*
   channel
   channel_id  title link description language 
   item
   iid title link description pubDate author source  guid cid
   
   */
$RSS_Content = array();

function RSS_Tags($item, $type)
{
	$y = array();
	$tnl = $item->getElementsByTagName("title");
	$tnl = $tnl->item(0);
	$title = $tnl->firstChild->data;

	$tnl = $item->getElementsByTagName("link");
	$tnl = $tnl->item(0);
	$link = $tnl->firstChild->data;

	$tnl = $item->getElementsByTagName("description");
	$tnl = $tnl->item(0);
	$description = $tnl->firstChild->data;
	
	$tnl = $item->getElementsByTagName("author");
	$tnl = $tnl->item(0);
	if($tnl)
	$author = $tnl->firstChild->data;
	else 
	$author="";
	
	$tnl = $item->getElementsByTagName("pubDate");
	$tnl = $tnl->item(0);
	if($tnl)
	$pubDate = $tnl->firstChild->data;
	else 
	$pubDate="";
	
	$tnl = $item->getElementsByTagName("language");
	$tnl = $tnl->item(0);
	if($tnl)
	$language = $tnl->firstChild->data;
	else 
	$language="";
	
	$tnl = $item->getElementsByTagName("guid");
	$tnl = $tnl->item(0);
	if($tnl)
	$guid = $tnl->firstChild->data;
	else 
	$guid="";

	$y["title"] = $title;
	$y["link"] = $link;
	$y["description"] = $description;
	$y["author"] = $author;
	$y["pubDate"] = $pubDate;
	$y["language"] = $language;
	$y["guid"] = $guid;
	$y["type"]=$type;

	return $y;
}


function RSS_Channel($channel)
{
	global $RSS_Content;

	$items = $channel->getElementsByTagName("item");

	// Processing channel

	$y = RSS_Tags($channel, 0);		// get description of channel, type 0
	array_push($RSS_Content, $y);

	// Processing articles

	foreach($items as $item)
	{
		$y = RSS_Tags($item, 1);// get description of article, type 1
		array_push($RSS_Content, $y);
	}
}

function RSS_Retrieve($url)
{
	global $RSS_Content;

	$doc  = new DOMDocument();
	$doc->load($url);

	$channels = $doc->getElementsByTagName("channel");

	$RSS_Content = array();

	foreach($channels as $channel)
	{
		RSS_Channel($channel);
	}

}


function RSS_SQL($url, $size)
{
	global $RSS_Content;

	$opened = false;
	$page = "";
	$id=0;
	$iid=0;
	$con=mysql_connect("localhost", "root", "") or die ("ERROR: " . mysql_error() . "\n");
	mysql_select_db("NewsRSS") or die("ERROR: " . mysql_error() . "\n");

	RSS_Retrieve($url);
	if($size > 0)
		$recents = array_slice($RSS_Content, 0, $size);

	foreach($recents as $article)
	{
		$type = $article["type"];
		if($type == 0)
		{
			$id++;
			$title = $article["title"];
			$link = $article["link"];
			$description = $article["description"];
			$language= $article["language"];
			$query = "INSERT INTO channel VALUES (
						\"{$id}\", \"{$title}\",\"{$link}\", {$language}\",\"{$description}\")";
			mysql_query( $sql, $con );

		}
		else
		{
			$title = $article["title"];
			$link = $article["link"];
			$description = $article["description"];
			$author= $article["author"];
			$pubDate= $article["pubDate"] ;
			$guid= $article["guid"] ;
			$query = "INSERT INTO items VALUES (
				\"{$iid}\", \"{$title}\",\"{$link}\", \"{$guid}\", \"{$pubDate}\",\"{$description}\",\"{$id}\")";
			mysql_query( $sql, $con );

		}

	}


}
RSS_SQL("rss.xml", 25);


?>

