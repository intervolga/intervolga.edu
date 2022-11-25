<?php
namespace Intervolga\Edu\Courses;

class BaseCourse
{
	public static function getTitle()
	{
		return 'Курс 1';
	}

	public static function getLessons()
	{
		return [
			'lesson1' => 'Урок 1. Установка платформы',
			'lesson2' => 'Урок 2. Структура Bitrix Framework',
			'lesson3' => 'Урок 3. Интеграция HTML шаблона',
		];
	}
}
