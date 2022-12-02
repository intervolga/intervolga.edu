<?php
namespace Intervolga\Edu\Util;

class Regex
{
	protected $regex = '';
	protected $regexExplanation = '';

	public function __construct($regex, $regexExplanation)
	{
		$this->regex = $regex;
		$this->regexExplanation = $regexExplanation;
	}

	public function getRegex()
	{
		return $this->regex;
	}

	public function getRegexExplanation()
	{
		return $this->regexExplanation;
	}
}
