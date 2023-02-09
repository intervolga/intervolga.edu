<?php

namespace PHP_CodeSniffer\Standards\OldOrmClass\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class CheckMethodSniff implements Sniff
{
	public function register()
	{
		return [T_FUNCTION];
	}

	private function checkAdd(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$openScope = $tokens[$stackPtr]['scope_opener'];
		$closeScope = $tokens[$stackPtr]['scope_closer'];
		$current = $openScope;
		
		$methodProps = $phpcsFile->getMethodProperties($stackPtr);
		if ($methodProps['is_static']) {
			$phpcsFile->addWarning('Method Add should not be static', $stackPtr, 'MethodError');
		}

		$hasDB = false;	
		$hasAdd = false;

		while ($current < $closeScope && $current >= $openScope) {
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
			$phpcsFile->addWarning('Method Add should use $DB->Add()', $stackPtr, 'MethodError');
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
			$phpcsFile->addWarning('Method Update should not be static', $stackPtr, 'MethodError');
		}

		$hasDB = false;
		$hasPrepareUpdate = false;
		$hasQuery = false;

		while ($current < $closeScope && $current >= $openScope) {
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
			$phpcsFile->addWarning('Method Update should use $DB->PrepareUpdate() and $DB->Query()', $stackPtr, 'MethodError');
		}
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
}
?>