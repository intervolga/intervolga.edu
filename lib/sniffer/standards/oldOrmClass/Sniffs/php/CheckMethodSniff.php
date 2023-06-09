<?php
namespace PHP_CodeSniffer\Standards\OldOrmClass\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class CheckMethodSniff implements Sniff
{
	public function register()
	{
		return [T_FUNCTION];
	}

	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$method = $phpcsFile->findNext(T_STRING, $stackPtr);
		$methodName = $tokens[$method]['content'];

		switch ($methodName) {
			case 'Add':
				$this->checkAdd($phpcsFile, $stackPtr);
				break;
			case 'Update':
				$this->checkUpdate($phpcsFile, $stackPtr);
				break;
			default:
				return;
		}
	}

	private function checkAdd(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$openScope = $tokens[$stackPtr]['scope_opener'];
		$closeScope = $tokens[$stackPtr]['scope_closer'];
		$current = $openScope;

		$methodProps = $phpcsFile->getMethodProperties($stackPtr);
		if ($methodProps['is_static']) {
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_METHOD_ADD');
			$phpcsFile->addError($error, $stackPtr, 'MethodAddError(CheckMethodSniff)');
		}

		$hasDB = false;
		$hasAdd = false;

		while ($current<$closeScope && $current>=$openScope) {
			$current = $phpcsFile->findNext(T_VARIABLE, $current + 1, $closeScope);
			if ($tokens[$current]['content'] == '$DB') {
				$hasDB = true;
				$next = $phpcsFile->findNext(T_WHITESPACE, $current + 1, $closeScope, true);
				if ($tokens[$next]['content'] == '->') {
					$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, $closeScope, true);
					if ($tokens[$next]['content'] == 'Add') {
						$hasAdd = true;
						break;
					}
				}
			}
		}

		if (!$hasDB || !$hasAdd) {
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_METHOD_ADD_DB');
			$phpcsFile->addError($error, $stackPtr, 'MethodAddDbError(CheckMethodSniff)');
		}
	}

	private function checkUpdate(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$openScope = $tokens[$stackPtr]['scope_opener'];
		$closeScope = $tokens[$stackPtr]['scope_closer'];
		$current = $openScope;

		$methodProps = $phpcsFile->getMethodProperties($stackPtr);
		if ($methodProps['is_static']) {
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_METHOD_UPDATE');
			$phpcsFile->addError($error, $stackPtr, 'MethodUpdateError(CheckMethodSniff)');
		}

		$hasDB = false;
		$hasPrepareUpdate = false;
		$hasQuery = false;

		while ($current<$closeScope && $current>=$openScope) {
			$current = $phpcsFile->findNext(T_VARIABLE, $current + 1, $closeScope);
			if ($tokens[$current]['content'] == '$DB') {
				$hasDB = true;
				$next = $phpcsFile->findNext(T_WHITESPACE, $current + 1, $closeScope, true);
				if ($tokens[$next]['content'] == '->') {
					$next = $phpcsFile->findNext(T_WHITESPACE, $next + 1, $closeScope, true);
					if ($tokens[$next]['content'] == 'PrepareUpdate') {
						$hasPrepareUpdate = true;
					}
					if ($tokens[$next]['content'] == 'Query') {
						$hasQuery = true;
					}
				}
			}
		}

		if (!$hasDB || !$hasPrepareUpdate || !$hasQuery) {
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_METHOD_UPDATE_DB');
			$phpcsFile->addError($error, $stackPtr, 'MethodUpdateDbError(CheckMethodSniff)');
		}
	}
}