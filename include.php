<?php
B_PROLOG_INCLUDED === true || die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

const INTERVOLGA_EDU_GUESS_VARIANTS = [
	'TEMPLATES' => [
		'LAST_PROMO' => [
			'last_promo',
			'last.promo',
		],
		'REVIEWS_LIST' => [
			'reviews_list',
			'reviews.list',
			'list_review',
			'list_reviews',
		],
	],
];