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
    /**
    * Возвращает список заказов ДЛЯ АДМИНКИ
    * @return array - Массив с заказами
    */
    public static function getOrdersList(){
        $db = Db::getConnection();

        $result = $db->query("SELECT id, user_name, user_phone, date, products, status FROM product_order ORDER BY id ASC");
        $ordersList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }
    /**
     * Возвращает текстое пояснение статуса для заказа :<br/>
     * 1 - Новый заказ,
     * 2 - В обработке,
     * 3 - Доставляется,
     * 4 - Закрыт
     * @param integer $status Статус
     * @return string Текстовое пояснение
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
        }
    }

    /**
     * Удаляет заказ с заданным id
     * @param integer $id id заказа
     * @return boolean Результат выполнения метода
     */
    public static function deleteOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'DELETE FROM product_order WHERE id = :id';
        // Получение и возврат результатов через подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает заказ с указанным id
     * @param integer $id id
     * @return array Массив с информацией о заказе
     */
    public static function getOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM product_order WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполняем запрос
        $result->execute();
        // Возвращаем данные
        return $result->fetch();
    }
    public static function getAdminTotalAmountOfOrders(){
        $db = Db::getConnection();
        $sql = 'SELECT count(id) as count FROM product_order';
        // Возвращаем значение count - количество ВСЕХ заказов на сайте
        $row = $db->query($sql)->fetchColumn();
        return $row;
    }
    /**
     * Редактирует заказ с заданным id
     * @param int $id id товара
     * @param string $userName Имя клиента
     * @param string $userPhone Телефон клиента
     * @param string $userComment Комментарий клиента>
     * @param string $date Дата оформления
     * @param int $status Статус (включено "1", выключено "0")
     * @return boolean Результат выполнения метода
     */
    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
}
