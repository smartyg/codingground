<?php
require_once("BasicHTMLObject.php");

class TagObject extends BasicHTMLObject
{
	private $name;
	private $attr;
	private $subs;
  
	function __construct($name, array $attrs = NULL, array $subs = NULL, $strict = NULL, HTMLSpec &$spec = NULL)
	{
		if($strict) $this->strict = $strict;
		if($spec) $this->spec = $spec;
  		$this->name = ($this->strict ? self::validateTagName($name, $this->spec) : $name);
		foreach($attrs as $attr)
		{
			if($this->strict)
				$attr = self::validateAttr($this->name, $attr, $this->spec);
			if($attr) $this->attrs[] = $attr;
		}
		foreach($subs as $sub)
		{
			if($this->strict)
				$sub = self::validateSub($this->name, $sub, $this->spec);
			if($sub) $this->subs[] = $sub;
		}
	}
	
	public static function validateTagName($tag, HTMLSpec &$spec)
	{
		return $name;
	}
	
	private static function validateAttr($tag, AttrObject $attr, HTMLSpec &$spec)
	{
		if($attr->validate($spec))
			return $attr;
	}
	private static function validateSub($tag, TagObject $sub, HTMLSpec &$spec)
	{
		if($sub->validate($spec))
			return $sub;
	}
	
	public function validate(HTMLSpec &$spec)	
	{
		if(!self::validateTagName($this->name, $spec)) return FALSE;
		foreach($this->attrs as $attr)
			if(!self::validateAttr($this->name, $attr, $spec)) return FALSE;
		foreach($this->subs as $sub)
			if(!self::validateSub($this->name, $sub, $spec)) return FALSE;
		return TRUE;
	}
	
	public function printHTML($strict = NULL, HTMLSpec &$spec = NULL)
	{
	    if(!$spec) $spec = $this->spec;
	    if(!$strict) $strict = $this->strict;
		echo '<' . $this->name;
		if($this->attr)
			foreach($this->attrs as $attr)
				$attr->printHTML($strict, $spec);
		if($this->subs || self::expliciteClose($this->name))
		{
			echo '>';
			if($this->subs)
			{
				foreach($this->subs as $sub)
					$sub->printHTML($strict, $spec);
			}
			echo '</' . $this->name . '>';
		}
		else
			echo ' />';
	}
}
?>