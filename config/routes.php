<?php
return array (
    // Товар:
    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
    // Каталог:
    'shop'          => 'shop/index', // actionIndex в ShopController
    // Категории товаров:
	'category/([0-9]+)/page-([0-9]+)' => 'shop/category/$1/$2', // actionCategory в ShopController
    'category/([0-9]+)' => 'shop/category/$1', // actionCategory в ShopController
    // Корзина:
    'cart/checkout' => 'cart/checkout', // actionCheckout в CartController
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController
	//'cart/addAjax/(0-9]+)' => 'cart/addAjax/$1', не работает :(
	'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController
	'cart' => 'cart/index', // actionIndex в CartController
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
	// Админпанель
    'admin' => 'admin/index',
	// О магазине:
	'contacts' => 'site/contact',
    'about' => 'site/about',
    // Главная страница:
    '' => 'site/index', // actionIndex в SiteController
);