<?php
/**
 * Контроллер ProductController
 * Товар
 */
class ProductController{
    /**
     * Action для страницы просмотра товара
     * @param integer $productId id товара
     */
    public static function actionView($productId){

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Получаем инфомрацию о товаре
        $products = Product::getProductById($productId);

        // Подключаем вид
        require_once (ROOT. '/views/product/view.php');
        return true;
    }
}