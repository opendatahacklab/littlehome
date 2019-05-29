<?php

/**
  * Some helper method to deal with JSON-LD
  *
  */
class LDUtils{
	function addObjectTripleIfNotEmpty($subject, $property, $objecturl){
		if (!isset($objecturl)===0) return;
		$subject->$property=new stdClass();
		$subject->$property->{'@id'}=$objecturl;
	}
	
	function addDataTripleIfNotEmpty($subject, $property, $value){
		if (strlen($value)===0) return;
		$subject->$property=$value;
	}
}
?>