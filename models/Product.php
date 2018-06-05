<?php

/**
 * Класс Product - модель для работы с товарами
 */
class Product{
    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;
    /**
     * Возвращает массив последних товаров
     * @param type $count [optional] Количество отображаемых товаров
     * @param type $page [optional] Номер текущей страницы
     * @return array Массив с товарами
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT){
        // Соединение с БД
        $db = Db::getConnection();

        $productsList = [];

        // Текст запроса к БД
        $sql = 'SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1"'
            . ' ORDER BY id DESC '
            . 'LIMIT ' . $count;

        // Используем подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }
    /**
     * Возвращает список рекомендуемых товаров
     * @return array <p>Массив с товарами</p>
     */
    public  static function getRecommendedProducts(){

        $db = Db::getConnection();

        $recommendedList = [];

        $sql = 'SELECT id, name, price, is_new FROM product '
            .  'WHERE status = 1 AND is_recommended = 1 '
            .  'ORDER BY id DESC ';
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()) {
            $recommendedList[$i]['id'] = $row['id'];
            $recommendedList[$i]['name'] = $row['name'];
            $recommendedList[$i]['price'] = $row['price'];
            $recommendedList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $recommendedList;
        }

    /**
     * Возвращает список товаров в указанной категории
     * @param int $categoryId - id категории
     * @param int $page [optional] - Номер страницы
     * @return array Массив с товарами
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1){
            $limit = Product::SHOW_BY_DEFAULT;
             $page = intval($page);

            // Смещение (для запроса)
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            // Соединение с БД
            $db = Db::getConnection();

            $products = [];

            // Текст запроса к БД
        $sql = 'SELECT id, name, price, is_new FROM product '
            . 'WHERE status = 1 AND category_id = :category_id '
            . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';

        // Используем подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                //$products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }
            return $products;
        }

    /**
     * Возвращает продукт с указанным id
     * @param integer $id - id товара
     * @return array - Массив с информацией о товаре
     */
    public static function getProductById($id) {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM product WHERE id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполнение коменды
        $result->execute();
        // Получение и возврат результатов
        return $result->fetch();
    }
    /**
     * Возвращает список товаров с указанными индентификторами
     * @param array $idsArray Массив с идентификаторами
     * @return array Массив со списком товаров
     */
	public static function getProductByIds($idsArray){
		$products = [];
		$db = Db::getConnection();
        // Превращаем массив в строку для формирования условия в запросе
		$idsString = implode(',', $idsArray); 
		$sql = "SELECT * FROM product WHERE status = 1 AND id IN ({$idsString})";

		$result = $db->query($sql);

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
		while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                //$products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['code'] = $row['code'];
                $i++;
            } 
			return $products;
	}
    /**
     * Возвращаем количество товаров в указанной категории
     * @param integer $categoryId
     * @return integer
     */
	public static function getTotalProductsInCategory($categoryId){
        $db = Db::getConnection();

        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';

        // Используем подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
    /**
     * Возвращает список товаров
     * @return array - Массив с товарами
     */
    public static function getProductsList(){
        // Соединение с БД
        $db = Db::getConnection();
        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }
}