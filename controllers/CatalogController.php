<?php

class CatalogController{
    public function actionIndex(){
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(18);

        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }
    public function actionCategory ($categoryid, $page = 1) {
        $categories = [];
        $categories = Category::getCategoriesList();

        $categoryProducts = [];
        $categoryProducts = Product::getProductsListByCategory($categoryid, $page);
		
		$total = Product::getTotalProductsInCategory($categoryid);
		
		$pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-' );

        require_once(ROOT . '/views/catalog/category.php');

        return true;
    }
}
