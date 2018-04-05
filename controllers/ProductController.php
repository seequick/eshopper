<?php

class ProductController{
    public static function actionView($productId){
        $categories = [];
        $categories = Category::getCategoriesList();

        $products = [];
        $products = Product::getProductById($productId);

        require_once (ROOT. '/views/product/view.php');
        return true;
    }
}