<?php 
	
	


	function limpiaEspacios($string){
		$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ().;,'.!¿¡".'"°!$';
		$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn__________".'____';
		$string = utf8_decode($string);
		$string = strtr($string,$tofind,$replac);
		$string = explode(" ", strtolower($string));
		$string = join("-", $string);
	
		return ($string);	
	}
	function utf8_urldecode($str) {
		$str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
		return html_entity_decode($str,null,'UTF-8');;
	}
	
?>
