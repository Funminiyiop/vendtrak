<?php namespace App\SalesRobot;


class FormMan {
	
	public function CleanInput($input)
	{
		# strip all html tags
	   $wc = strip_tags($input);
	   # remove 'words' that don't consist of alphanumerical characters or punctuation
	   $pattern = "#[^(\w|\d|\'|\"|\.|\!|\?|;|,|\\|\/|\-|:|\&|@)]+#";
	   $wc = trim(preg_replace($pattern, "", $wc));
	   # remove one-letter 'words' that consist only of punctuation
	   $wc = trim(preg_replace("#\s*[(\'|\"|\.|\_|\!|\?|;|,|\\|\/|\-|:|\&|@)]\s*#", "", $wc));
	   # remove superfluous whitespace
	   $wc = preg_replace("/\s\s+/", "", $wc);
	   # split string into an array of words
	   // $wc = explode(" ", $wc);
	   # remove empty elements
	   // $wc = array_filter($wc);
	   # return the number of words

	   
	   # split string into an array of words
	   $wc = explode(" ", $wc);
	   # remove empty elements
	   $wc = array_filter($wc);
	   # return the number of words
	   
	   return $wc;	
	}
	
	public function FormInput($input)
	{
		$forminput = htmlentities(trim($input));
		$forminput = stripslashes(trim($forminput));
	   	# remove one-letter 'words' that consist only of punctuation
	   	$forminput = trim(preg_replace("#\s*[(\'|\"|\.|\_|\!|\?|;|,|\\|\/|\-|:|\&|@)]\s*#", "", $forminput));
		return $forminput;
	}
	public function FormInputDot($input)
	{
		$forminput = htmlentities(trim($input));
		$forminput = stripslashes(trim($forminput));
	   	# remove one-letter 'words' that consist only of punctuation
	   	$forminput = trim(preg_replace("#\s*[(\'|\"|\_|\!|\?|;|,|\\|\/|\-|:|\&)]\s*#", "", $forminput));
		return $forminput;
	}
	
	public function NameField($input){
		$nf = $this->FormInput($input);
		return $nf;
	}
}
 
 
?>