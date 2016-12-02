<?php
require_once("BasicHTMLObject.php");

class AttrObject extends BasicHTMLObject
{
	private $name;
	private $value;

	function __construct($name, $value, $strict = NULL, HTMLSpec &$spec = NULL)
	{
	    parent::__construct();
		if($strict) $this->spec = $spec;
		if($spec) $this->strict = $strict;
		$this->name = ($this->strict ? self::validateAttrName($name, $this->spec) : $name);
		$this->value = ($this->strict ? self::ValidateAttrValue($this->name, $value, $this->spec) : $value);
	}
	
	private static function validateAttrName($name, HTMLSpec &$spec)
	{
		return $name;
	}

	private static function validateAttrValue($name, $value, HTMLSpec &$spec)
	{
		return $value;
	}
	
	public function validate(HTMLSpec &$spec = NULL)
	{
	    if(!$spec) $spec = $this->spec;
		return self::validateAttrName($this->name, $spec) &&  self::validateAttrValue($this->name, $this->value, $spec);
	}
	
	public function printHTML(HTMLSpec &$spec = NULL)
	{
	    if(!$spec) $spec = $this->spec;
		echo $this->name . '="' . $this->value . '"';
	}
}
?>