<?php
/**
  * utilities for blog posts.
  * Article sources must be in Markdown (https://daringfireball.net/projects/markdown/syntax). In addition, they can have MultiMarkdown metadata (http://fletcher.github.io/MultiMarkdown-5/metadata.html) with the keys
  * title and date. Time must be specified as YYYYmmDD. 
  */
class Article{
	public $title;
	public $author;
	public $date;
	public $content;

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
		if (!$a->read($_GET['url']))
			return FALSE;
		return $a;		
	}

	/**
	  * Parse an article whose source will be retrieved at the specified URL.
	  * @return TRUE if success, FALSE otherwise
	  */ 
	function read($url){
		$md=file_get_contents($url);
		if ($md==FALSE) 
			return FALSE;
		$mdContents=$this->extractMetadata($md);
		$parser = new \Michelf\Markdown();
		$html = $parser->transform($mdContents);
		if (!$html)
			return FALSE;
		$this->content=$html;
		return TRUE;
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
				$rowParts=explode(':',$row);
				if (count($rowParts)==2){
					$key=trim($rowParts[0]);
					if ($key==='title')
						$this->title=trim($rowParts[1]);
					if ($key==='date'){
						$dateStr=trim($rowParts[1]);
						echo "<!-- date found $dateStr -->";
						$this->date=DateTimeImmutable::createFromFormat ('Ymd', trim($rowParts[1]));
					}
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
}
?>
	