<?php
namespace Intervolga\Edu\Exceptions;

use Bitrix\Main\Localization\Loc;

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
	 * @param \Throwable $throwable
	 * @return static
	 */
	public static function createThrowable(\Throwable $throwable)
	{
		$exception = new static(Loc::getMessage('INTERVOLGA_EDU.UNKNOWN_ERROR', [
			'#CLASS#' => get_class($throwable),
			'#MESSAGE#' => $throwable->getMessage(),
			'#TRACE#' => nl2br($throwable->getTraceAsString()),
		]));

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