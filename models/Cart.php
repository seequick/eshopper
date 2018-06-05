<?php
/** Класс Cart
 * Компонент для работы с корзиной
 */
Class Cart {
    /** Добавление товара в корзину (сессию)
     * @param int $id - id товара
     * @return integer количество товаров корзине
     */
	public static function addProduct($id){
    // Приводим $id к типу int
	$id = intval($id);

	// Пустой миссив для товаров в корзине
	$productsInCart = [];

	// Если в корзине уже есть товары они хранятся в сессии
	if (isset($_SESSION['products'])) {
		$productsInCart = $_SESSION['products'];
	}

	// Проверяем есть ли уже такой товар в корзине
	if (array_key_exists($id, $productsInCart)) {
	    // Если такой товар есть в корзине, он был добавлен еще раз, увеличим кол-во на 1
		$productsInCart[$id] ++;
	} else {
	    // Если нет, добавляем id нового товара в корзину с количеством 1
		$productsInCart[$id] = 1;
	}

	// Записываем массив с товарами в сессию
	$_SESSION['products'] = $productsInCart;

	// Возращаем кол-во товаров в корзине
	return self::countItems();
	}
	/**
     * Удаляет товар с указанным id из корзины
       @param integer $id id товара
     */
	public static function deleteProduct($id){
	    // Получаем массив с идентификаторами и количеством товаров в корзине
	    $ProductInCart = self::getProducts();
        // Удаляем из массива элемент с указанным id
	   unset ($ProductInCart[$id]);
	   // Записываем массив товаров с удаленным элементом в сессию
        $_SESSION['products'] = $ProductInCart;
    }

    /** Подсчет количества товаров к корзине (сессии)
     * @return int количество товаров в корзине
     */
	public static function countItems(){
	    // Проверка наличия товаров в корзине
		if (isset($_SESSION['products'])) {
		$count = 0;
		// Если массив с товарами есть подсчитываем и вернем их кол-во
		foreach ($_SESSION['products'] as $id => $quantity) {
		$count += $quantity;	
		}
		return $count;
		} else
		    // Если товаров нет вернем 0
		return 0;
	}
	/** Возвращает массив с индентификаторами и количеством товаров в корзине
     * Если товаров нет возращает false
     * @retun mixed: boolean or array
     */
	public static function getProducts(){
		if (isset($_SESSION['products']))
            return $_SESSION['products'];
        return false;
	}
	/** Получаем общую стоимость переданных товаров
     * @param array $products Массив с информацией о товарах
     * @return integer общая стоимость */

	public static function getTotalPrice($products){
	    // Массив с индентификаторами и количеством товаров корзине
		$productsInCart = self::getProducts();
		// Подсчитываем общую стоимость
		$total = 0;
		if ($productsInCart) {
		    // Если в корзине не пусто проходим
            // Проходим по переданному в метод массиву товаров
			foreach ($products as $item) {
			    // Общая стоимость: цена товара * кол-во товара
				$total += $item['price'] * $productsInCart[$item['id']];
			}
		}
		return $total;
	}

    /**
     * Очищает корзину
     */
	public static function clear(){
        unset ($_SESSION['products']);
    }
}