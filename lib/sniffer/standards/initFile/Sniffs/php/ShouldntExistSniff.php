<?php
namespace PHP_CodeSniffer\Standards\InitFile\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileMessage;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ShouldntExistSniff implements Sniff
{
	private const INIT_CONSTANTS = [
		'IBLOCK_NEWS_ID',
		'IBLOCK_CATALOG_PROPERTY_PRICE_ID',
		'IBLOCK_CATALOG_PROPERTY_ARTNUMBER_ID',
		'IS_DEV_SERVER'
	];
	private const EVENTHANDLERS = [
		'OnAfterIblockElementAdd',
		'redirectFromTestPage',
	];
	private const CLASSES = [
		'IblockHandler'
	];

	private const FUNCTIONS = [
		'redirectFromTestPage',
		'checkNewsCountAgent',
		'is404Page',
	];

	public function register()
	{
		return [
			T_CONSTANT_ENCAPSED_STRING,
			T_STRING
		];
	}

	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];
		$token['content'] = preg_replace("/'|\"/", '', $token['content']);

		if (in_array($token['content'], static::INIT_CONSTANTS)) {
			$file = new \Bitrix\Main\IO\File($phpcsFile->getFilename());
			$error = Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.INIT_CONSTANTS', [
				'#FILE#' => FileMessage::get($file),
				'#NAME#' => $token['content'],
			]);
			$phpcsFile->addError($error, $stackPtr, 'ShouldntExistSniff_INIT_CONSTANTS');
		} elseif (in_array($token['content'], static::EVENTHANDLERS)) {
			$file = new \Bitrix\Main\IO\File($phpcsFile->getFilename());
			$error = Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.EVENTHANDLERS', [
				'#FILE#' => FileMessage::get($file),
				'#NAME#' => $token['content'],
			]);
			$phpcsFile->addError($error, $stackPtr, 'ShouldntExistSniff_EVENTHANDLERS');
		} elseif (in_array($token['content'], static::CLASSES)) {
			$file = new \Bitrix\Main\IO\File($phpcsFile->getFilename());
			$error = Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.CLASSES', [
				'#FILE#' => FileMessage::get($file),
				'#NAME#' => $token['content'],
			]);
			$phpcsFile->addError($error, $stackPtr, 'ShouldntExistSniff_CLASSES');
		} elseif (in_array($token['content'], static::FUNCTIONS)) {
			$file = new \Bitrix\Main\IO\File($phpcsFile->getFilename());
			$error = Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.FUNCTIONS', [
				'#FILE#' => FileMessage::get($file),
				'#NAME#' => $token['content'],
			]);
			$phpcsFile->addError($error, $stackPtr, 'ShouldntExistSniff_FUNCTIONS');
		}
	}
}