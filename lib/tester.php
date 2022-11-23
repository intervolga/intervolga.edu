<?php
namespace Intervolga\Edu;

class Tester
{
	public static function getErrors()
	{
		$errors = [];
		$errors = array_merge($errors, \Intervolga\Edu\Tests\CourseOne\LessonOne\TestEdition::runAndGetErrors());
		$errors = array_merge($errors, \Intervolga\Edu\Tests\CourseOne\LessonOne\TestSiteCorporate::runAndGetErrors());
		$errors = array_merge($errors, \Intervolga\Edu\Tests\CourseOne\LessonOne\TestUpdates::runAndGetErrors());
		$errors = array_merge($errors, \Intervolga\Edu\Tests\CourseOne\LessonOne\TestSiteChecker::runAndGetErrors());

		return $errors;
	}
}
