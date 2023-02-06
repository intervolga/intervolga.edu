<?php

namespace Intervolga\Edu\Sniffer;

use Bitrix\Main\IO\File;

class Message
{
	protected File $file;
	protected int $line = 0;
	protected int $column = 0;
	protected string $message = '';
	protected string $code = '';

	public function __construct($file, $line, $column, $message, $code)
	{
		$this->file = new File($file);
		$this->line = $line;
		$this->column = $column;
		$this->message = $message;
		$this->code = $code;
	}

	public function getFile(): File
	{
		return $this->file;
	}

	public function getLine(): int
	{
		return $this->line;
	}

	public function getColumn(): int
	{
		return $this->column;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	public function getCode(): int
	{
		return $this->code;
	}
}
