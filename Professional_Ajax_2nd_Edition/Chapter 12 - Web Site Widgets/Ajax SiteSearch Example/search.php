<?php

header("Content-Type: text/plain; charset=UTF-8");
header("Cache-Control: no-cache");

include("./inc/SiteSearch.class.php");


if ( isset( $_GET["search"] ) ) {
	$searchTerm = $_GET["search"];

	$json = SiteSearch::search($searchTerm);
	
	echo $json;
}

?>