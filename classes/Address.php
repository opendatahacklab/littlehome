<?php

/**
  * Object representing a location, usually referred to Organization sites address
  */ 

class Address{

	/**
	 * Return this address in a single line human readable form, following the italian notation of addresses
	 */
	public static function jsonToString($j){
		$preceeding=false;
		$s='';
		if (isset($j->{'locn:thoroughfare'})){
			$s=$j->{'locn:thoroughfare'};
			$preceeding=true; 
			if (isset($j->{'locn:locatorDesignator'}))
				$s.=' '.$j->{'locn:locatorDesignator'};
		}
		if (isset($j->{'locn:poBox'})){
			if ($preceeding) $s.=', '; 
				else $preceeding=true; 
			$s.=$j->{'locn:poBox'};
		}
		if (isset($j->{'locn:postName'})){
			if ($preceeding) $s.=', '; 
			$s.=$j->{'locn:postName'};
		}
		return $s;
	}
}
?>