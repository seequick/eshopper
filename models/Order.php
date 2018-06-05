<?php
/**
 * Класс Order - модель для работы с заказами
 */
class Order{

    /**
     * Сохранение заказа
     * @param string $userName Имя
     * @param string $userPhone Телефон
     * @param string $userComment Комментарий
     * @param integer $userId id пользователя
     * @param array $products Массив с товарами
     * @return boolean Результат выполнения метода
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products){
        $products = json_encode($products);

        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }
}
