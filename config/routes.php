<?php
return array (
    'product/([0-9]+)' => 'product/view/$1', //actionView v ProductController
    'catalog'          => 'catalog/index', // actionIndex v CatalogController
	'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory v CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', //actionCategory v CatalogController
	    'user/register' => 'user/register',
		'user/login' => 'user/login',
		'cabinet' => 'cabinet/index',
                    '' => 'site/index', // actionIndex v SiteControleller
   // 'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2', //actionView v NewsController
  //  'news' => 'news/index', //actionIndex v NewsController
  //  'products' => 'product/list', //actionList v ProductController
);