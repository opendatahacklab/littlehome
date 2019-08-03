<?php
/**
  * Manage the articles list.
  */
class Articles extends JsonHelper{

	public function __construct(){
        	parent::__construct('articles.json'); 
	}

	/**
	  * Setup the json object with no articles.
	  */
	public function createEmpty(){
		$this->json=json_decode(file_get_contents('articles_base.json'));
	}

	/**
	  * Add an article to this list. Articles are ordered by date.
	  * 
	  * @param $a an instance of Article
	  */
	public function add($uri, $a){
		$item=new stdClass();
		$item->{'rss:title'}=$a->title;
		$item->{'@id'}=$uri;
		$item->{'dc:date'}=$a->date->format(DateTimeInterface::ISO8601);

		$items=$this->json->{'rss:items'};
		if (!isset($items->{'rdf:li'})){
			$items->{'rdf:li'}=array();
			$items->{'rdf:li'}[0]=$item;
			return;
		}
	}
}
?>