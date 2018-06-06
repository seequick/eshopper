<?php

/**
 * Класс Product - модель для работы с товарами
 */
class Product{
    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;
    /**
     * Возвращает массив последних товаров
     * @param int $count [optional] Количество отображаемых товаров
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
     * @param int $id - id товара
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
                $products[$i]['price'] = $row['price'];
                $products[$i]['code'] = $row['code'];
                $i++;
            } 
			return $products;
	}
    /**
     * Возвращаем количество товаров в указанной категории
     * @param int $categoryId
     * @return int
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
     * Возвращает список товаров, поля id, name, price code.
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
    /**
     * Возвращает список товаров ДЛЯ АДМИНКИ, больше полей
     * @return array - Массив с товарами
     */
    public static function getAdminProductsList($amount){
        // Соединение с БД
        $db = Db::getConnection();
        // Получение и возврат результатов
        $result = $db->query("SELECT id, name, category_id, price, code, availability, brand, is_new, is_recommended, status FROM product ORDER BY id ASC LIMIT {$amount}");
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['category_id'] = $row['category_id'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['availability'] = $row['availability'];
            $productsList[$i]['brand'] = $row['brand'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $productsList[$i]['is_recommended'] = $row['is_recommended'];
            $productsList[$i]['status'] = $row['status'];
            $i++;
        }
        return $productsList;
    }

    public static function getAdminTotalAmountOfProducts(){
        $db = Db::getConnection();

        $sql = 'SELECT count(id) as count FROM product';

        // Возвращаем значение count - количество ВСЕХ товаров
        $row = $db->query($sql)->fetchColumn();
        return $row;
    }
    /**
     * Удаляет товар с указанным id
     * @param int $id - id товара
     * @return boolean Результат выполнения метода
     */
    public static function deleteProductById($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM product WHERE id = :id';

        // Получение и возврат результатов. Используем подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    /**
     * Добавляет новый товар
     * @param array $options Массив с информацией о товаре
     * @return int id добавленной в таблицу записи, или 0 если неудача
     */
    public static function createProduct($options)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO product '
            . '(name, code, price, category_id, brand, availability,'
            . 'description, is_new, is_recommended, status)'
            . 'VALUES '
            . '(:name, :code, :price, :category_id, :brand, :availability,'
            . ':description, :is_new, :is_recommended, :status)';

        // Получение и возврат результатов. Подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Редактирует товар с заданным id
     * @param integer $id - id товара
     * @param array $options Массив с информацей о товаре
     * @return boolean Результат выполнения метода
     */
    public static function updateProductById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов.
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }
}