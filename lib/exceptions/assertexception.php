<?php
namespace Intervolga\Edu\Exceptions;

class AssertException extends TestException
{
	/**
	 * @var array|static[]
	 */
	protected $exceptions = [];

	/**
	 * @param array|static[] $exceptions
	 */
	public static function createMultiple(array $exceptions)
	{
		$messages = [];
		foreach ($exceptions as $exception) {
			$messages[] = $exception->getMessage();
		}
		$exception = new static(implode(';', $messages));
		$exception->exceptions = $exceptions;

		return $exception;
	}

	/**
	 * @return static[]|array
	 */
	public function getExceptions(): array
	{
		return $this->exceptions;
	}
}