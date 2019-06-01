<?php
/**
  * Helper class to manage logo. Assume that logo file is stored locally.
  *
  * Note: the organization json stored in the php session contains the new logo.
  */
class Logo{
	private $logoDir;
	private $oldlogo; //old logo filename
	private $newlogo; //new logo filename

	
	/**
	  * Check if a the old logo file name was passed as post variable.
	  *	
	  * @param $logoFileFieldName name of the input field containing the logo file
	  * @param $dir path of the directory where logo file is stored
	  *
	  * @return new logo file name
	  */
	function upload($logoFileFieldName, $dir){
		$filename=basename($_FILES[$logoFileFieldName]['name']); //todo avoid collisions
		if (!isset($_SESSION['oldlogo']))
			$_SESSION['oldlogo']=$_FILES[$logoFileFieldName];
		move_uploaded_file($_FILES[$logoFileFieldName]['tmp_name'], $dir.'/'.$filename);
		return $filename;
	}

	/**
	  * remove the temporary logo file if the case
	  * 	
	  * @param $filename
	  * @param $dir path of the directory where logo file is stored
	  */
	function clearTmpLogo($filename,$dir){
		//don't remove if it is the old logo (i.e. the logo actually used in the web site)
		if (isset($this->oldlogo))
			if (strcmp($this->oldlogo, $filename)===0)
				return;
		unlink($dir.'/'.$filename);
	}
}
?>