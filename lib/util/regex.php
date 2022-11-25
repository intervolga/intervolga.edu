<?php
namespace Intervolga\Edu\Util;

class Regex
{
	protected $regex = '';
	protected $regexExplanation = '';
	protected $tipToReplace = '';

	public function __construct($regex, $regexExplanation, $tipToReplace = '')
	{
		$this->regex = $regex;
		$this->regexExplanation = $regexExplanation;
		$this->tipToReplace = $tipToReplace;
	}

	public function getRegex()
	{
		return $this->regex;
	}

	public function getRegexExplanation()
	{
		return $this->regexExplanation;
	}

	public function getTipToReplace()
	{
		return $this->tipToReplace;
	}
}
