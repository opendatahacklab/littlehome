<?php
/**
  * Helper class for site configurations.
  */

class ConfigHelper{
	public $organization;
	public $styles;

	public function __construct($organizationFilePath, $stylesFilePath){
		$this->organization=new Organization();
		$this->organization->readFromFile($organizationFilePath);
		$this->styles=new Styles();
		$this->styles->readFromFile($stylesFilePath);
	}

	/**
	  * @param $currentToRootPath path to go from the directory where the invoking script is placed to the root directory of the project. For example, if the script which call this method
	  * is placed in the src dir, then $currentToRootPath must be set to '../'. If null it is assumed that the script is running in the root directory
	  */	
	function getCss($currentToRootPath=''){
		$utils=new LDUtils();
		$selected=$this->styles->json->selected;
		if ($utils->isAbsoluteUrl($selected))
			return $selected;
		return $currentToRootPath.$selected;
	}

	/**
	  * Get the organization name, with html entities.
	  */
	function getName(){
		return htmlentities($this->organization->json->{'foaf:name'});
	}
}
?>