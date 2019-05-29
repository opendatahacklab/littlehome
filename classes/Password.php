<?php
class Password{
	private $passwordMD5;

	/**
	  * Read the md5 sum of the expected password from a file
	  *
	  * @return true if the file exists, false otherwise
	  */
	public function readFromFile($path){
		if (!file_exists($path)) return false;
		$p=file_get_contents($path);
		if (!$p) return false;
		$this->passwordMD5=$p;	
		return true;
	}

	/**
	  * Write the md5 sum of the passowr  to a file
	  *
	  */
	public function writeToFile($password, $path){
		$p=md5($password);
		file_put_contents($path,$p);
	}

	/**
	  * check if password matches the expected one
	 */
	public function check($password){
		return isset($this->passwordMD5) && strcmp(md5($password),$this->passwordMD5)===0;
	}
}
?>