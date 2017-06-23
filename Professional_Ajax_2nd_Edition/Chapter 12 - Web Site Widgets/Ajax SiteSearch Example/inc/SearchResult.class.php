<?php
class SearchResult {
/*************************************
Represents a result from the database search
*************************************/
	var $id;
	var $title;
    
    function SearchResult($id, $title) {
		$this->id = $id;
		$this->title = $title;
    
    }
}

?>