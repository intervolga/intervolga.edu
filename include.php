<?php
B_PROLOG_INCLUDED === true || die();

use Bitrix\Main\Localization\Loc;

require_once(__DIR__ . '/vendor/autoload.php');

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
		'REVIEWS_CAROUSEL' => [
			'review.carousel',
			'review_carousel',
			'reviews_carousel',
			'carousel',
		],
		'RANDOM_REVIEWS' => [
			'rand_reviews',
			'rand_review',
			'random_review',
			'random_reviews',
		],
	],
	'MODULES' => [
		'main',
		'fileman',
		'iblock',
		'form',
		'perfmon',
		'translate',
		'search',
		'seo',
		'security',
		'photogallery',
	],
	'PATHS' => [
		'DESKTOP' => [
			'/desktop.php'
		]
	],
];

$current = getLocalPath('modules/intervolga.edu');
define('IV_EDU_MODULE_DIR', $current);