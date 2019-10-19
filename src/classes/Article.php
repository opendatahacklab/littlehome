<?php
/**
  * utilities for blog posts.
  * Article sources must be in Markdown (https://daringfireball.net/projects/markdown/syntax). In addition, they can have MultiMarkdown metadata (http://fletcher.github.io/MultiMarkdown-5/metadata.html) with the keys
  * title and date. Time must be specified as YYYYmmDD. 
  */
class Article{
	public $fieldsPrefix;
	public $title;
	public $date;
	public $content;

	function __construct($fieldsPrefix=""){
		$this->fieldsPrefix=$fieldsPrefix;
		$this->title='';
		$this->date=new DateTimeImmutable();
		$this->content='';
	}

	/**
	  * Get an article instance by reading it from the Markdown file retrievable
	  * at the URL passed via the GET parameter URL.
	  *
	  * @return FALSE if retrieving failed, an instance of Article otherwise
	  */
	static function readFromGETParameterURL(){
		if (!isset($_GET['url']))
			return FALSE;
		$a=new Article();
		if (!$a->readFromFile($_GET['url']))
			return FALSE;
		return $a;		
	}

	/**
	  * Parse an article contained a string
	  * @return TRUE if success, FALSE otherwise
	  */ 
	function read($md){
		if ($md==FALSE) 
			return FALSE;
		$this->content=$this->extractMetadata($md);
		return TRUE;
	}

	/**
	  * Parse an article whose source will be retrieved at the specified URL.
	  * @return TRUE if success, FALSE otherwise
	  */ 
	function readFromFile($url){
		$md=file_get_contents($url);
		return $this->read($md);	
	}

	/**
	  * Helper function to get the content as an html file.
	  */
	public function getContentAsHTML(){
		if (!isset($this->content))
			return '';
		$parser = new \Michelf\Markdown();
		return $parser->transform($this->content);
	}
	/**
	  * Write the article as a MultiMarkdown file
	  *
	  * @return FALSE if failure, TRUE otherwise 
	  */
	public function writeToFile($path){
		$s="---\ntitle:".$this->title."\ndate:".$this->date->format('Ymd')."\n---\n".$this->content;		
		return file_put_contents($path,$s)!=FALSE;
	}

	/**
	  * Extract title and date (specified as Multimarkdown Metadata) if any.  
	  *
 	  * @return the md file but with metadata removed
	  */ 
	function extractMetadata($md){
		if (substr($md,0,3)!=='---')
			return $md;
		$headerSize=strlen(strtok($md,"\n"));
		while($row=strtok("\n")){
			$headerSize+=strlen($row)+1;
			if ($row==='---')
				return substr($md, $headerSize, strlen($md));
			else{
				$colonPos=strpos($row,":");
				if ($colonPos!=FALSE){
					$key=trim(substr($row, 0, $colonPos));
					$value=trim(substr($row, $colonPos+1));
					if ($key==='title')
						$this->title=$value;
					if ($key==='date')
						$this->date=DateTimeImmutable::createFromFormat ('Ymd', $value);
				}
			}
		}
		return 'Invalid Content';
	}

	/**
	  * Get the date formatted in human readable format.
	  *	
	  * @return the date as string, null if no date is specified.
	  */
	function getDateFormatted(){
		if (!isset($this->date))
			return null;
		return $this->date->format('d-m-Y');
	}

	/**
	  * Read the article from a fields array, may be entered by an user by filling a form
	  */
	private function readFromFields($vars){
		$this->title=$vars[$this->fieldsPrefix.'title'];
		$this->date=DateTimeImmutable::createFromFormat ('Y-m-d', $vars[$this->fieldsPrefix.'date']);
		$this->content=$vars[$this->fieldsPrefix.'content'];
	}

	/**
	  * Read the article from a user entered form
	  */
	public function readFromForm(){
		$this->readFromFields($_POST);
	}

	/**
	  * Set properties by retrieving them from session variables
	  *
	  */
	public function readFromSession(){
		if (!isset($_SESSION[$this->fieldsPrefix.'title']))
			return FALSE;
		$this->readFromFields($_SESSION);
		return TRUE;
	}

	/**
	  * Store property value as session variables
	  */
	public function storeInSession(){
		$_SESSION[$this->fieldsPrefix.'title']=$this->title;
		$_SESSION[$this->fieldsPrefix.'date']=$this->date->format('Y-m-d');
		$_SESSION[$this->fieldsPrefix.'content']=$this->content;
	}


}
?>
	
