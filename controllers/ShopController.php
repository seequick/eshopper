<?php
/**
 * Контроллер ShopController
 * Каталог товаров
 */
class ShopController{
    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex(){
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список последних товаров
        $latestProducts = Product::getLatestProducts(9);

        // Подключаем вид
        require_once(ROOT . '/views/shop/index.php');
        return true;
    }
    /**
     * Action для страницы "Категория товаров"
     */
    public function actionCategory ($categoryid, $page = 1) {

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список товаров в категории
        $categoryProducts = Product::getProductsListByCategory($categoryid, $page);

        // Общее количетсво товаров (для постраничной навигации)
		$total = Product::getTotalProductsInCategory($categoryid);

        // Создаем объект Pagination - постраничная навигация
		$pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-' );

        // Подключаем вид
        require_once(ROOT . '/views/shop/category.php');
        return true;
    }
}
