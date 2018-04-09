<?php
class CartController {
	public function actionIndex(){
	 $categories = [];
      $categories = Category::getCategoriesList();
	
	$productsInCart = false;
	
	$productsInCart = Cart::getProducts();
	
	if ($productsInCart) {
		$productsIds = array_keys($productsInCart);
		//$productQuantity = array_shift(array_values($productsInCart));
		//print_r ($productsIds);
		$products = Product::getProductByIds($productsIds);
		//print_r ($products);
		$totalPrice = Cart::getTotalPrice($products);
	}
		
	 require_once(ROOT . '/views/cart/index.php');
	 return true;
	 }
public function actionAdd($id){
	Cart::addProduct($id);
	$referrer = $_SERVER['HTTP_REFERER'];
	header ("Location: $referrer");
}

public function actionAddAjax($id){
echo Cart::addProduct($id);
return true;
//fix this
}
}