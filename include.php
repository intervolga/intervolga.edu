<?php
B_PROLOG_INCLUDED === true || die();

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\NewsIblock;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Locator\Iblock\PromoIblock;
use Intervolga\Edu\Locator\Iblock\ReviewsIblock;

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
		'SLIDER' => [
			'slider',
			'promo_slider',
			'slider_promo',
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

const INTERVOLGA_EDU_USES_BLOCKS = [
    NewsIblock::class,
    ProductsIblock::class,
    PromoIblock::class,
    ReviewsIblock::class
];

$current = getLocalPath('modules/intervolga.edu');
define('IV_EDU_MODULE_DIR', $current);