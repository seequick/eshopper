<?php
/**
 * Класс Category - модель для работы с категориями товаров
 */
class Category{
    /**
     * Возвращает массив категорий для списка на сайте
     * @return array Массив с категориями
     */
    public static function getCategoriesList(){
        // Соединение с БД
        $db = Db::getConnection();

        $categoryList = array();
        // Запрос к БД
        $result = $db->query('SELECT id, name FROM category '
            . 'ORDER BY sort_order ASC');
        // Получение и возврат результатов
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }
}