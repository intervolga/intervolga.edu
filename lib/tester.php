<?php
namespace Intervolga\Edu;

class Tester
{
	public static function getErrors()
	{
		$errors = [];
		$errors = array_merge($errors, \Intervolga\Edu\Tests\CourseOne\LessonOne\TestEdition::getErrorsPrefixed());
		$errors = array_merge($errors, \Intervolga\Edu\Tests\CourseOne\LessonOne\TestSiteCorporate::getErrorsPrefixed());
		$errors = array_merge($errors, \Intervolga\Edu\Tests\CourseOne\LessonOne\TestUpdates::getErrorsPrefixed());
		$errors = array_merge($errors, \Intervolga\Edu\Tests\CourseOne\LessonOne\TestSiteChecker::getErrorsPrefixed());

		return $errors;
	}
}
