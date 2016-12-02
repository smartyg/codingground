<?php
require_once("XHTMLSpec.php");

class BasicHTMLObject
{
	protected $strict = true;
	protected HTMLSpec $spec = new XHTMLSpec;
	
	abstract public function validate(HTMLSpec &$spec = NULL);
	abstract public function printHTML(HTMLSpec &$spec = NULL);
	
	public function setSpec(HTMLSpec &$spec)
	{
		$this->spec = $spec;
	}
	
	public function setStrict($strict)
	{
		$this->strict = $strict;
	}	
}
?>
