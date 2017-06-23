<?php
include ("JSON.php");
include ("SearchResult.class.php");

class SiteSearch {
/************************************
Static class that searches the database for a given criteria.
************************************/

	function search($searchString) {
		$DB_DATASOURCE = "";
		$DB_CATALOG    = "BlogDatabase";
		$DB_USERNAME   = "";
		$DB_PASSWORD   = "";
		
		$searchResults = array();

		$connection = mssql_connect($DB_DATASOURCE, $DB_USERNAME, $DB_PASSWORD);
		
		mssql_select_db($DB_CATALOG);
		
		
        //Build the query.
        $query = "SELECT TOP 10 BlogId, Title FROM BlogPosts WHERE Post LIKE '%". $searchString ."%' OR Title LIKE '%". $searchString ."%' ORDER BY Date DESC";
        

		$result = mssql_query($query);

		while ($row = mssql_fetch_array($result)) {
		   //This will call the above function.
		   //array_walk($row, 'modify_field');
		   
		   array_push($searchResults, new SearchResult($row["BlogId"], $row["Title"]));
		}
		
		$json = new Services_JSON();
		
		return $json->encode($searchResults);
	}
}


?>