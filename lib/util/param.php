<?php
namespace Intervolga\Edu\Util;

class Param
{
	protected $value = '';
	protected $assertValue;
	protected $paramName = '';

	public function __construct(string $paramName, string $value, string $assertValue)
	{
		$this->paramName = $paramName;
		$this->value = $value;
		$this->assertValue = $assertValue;
	}

	public function getValue(): string
	{
		return $this->value;
	}

	public function getAssertValue()
	{
		return $this->assertValue;
	}

	public function getName(): string
	{
		return $this->paramName;
	}
}
