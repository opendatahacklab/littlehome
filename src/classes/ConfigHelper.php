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
}
?>