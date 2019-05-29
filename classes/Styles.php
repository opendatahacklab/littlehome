<?php
require_once('JsonHelper.php');
/**
  * Helper class to manage CSS selection
  */
class Styles extends JsonHelper{

	public function  __construct(){
		parent::__construct('styles.json');
	}

	/**
	 * Set the selected field from the POST request 
 	 * 
	 * @param $vars array of variables submitted by the form
	 *
	 * @return true if the json object has been created from the post request, false otherwise
	 */
	public function readSelectedFromForm($vars){
		if (!isset($_POST['style'])) 
			return false;
		$this->json->selected=$_POST['style'];
	}
}
?>