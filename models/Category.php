<?php
/**
 * Класс Category - модель для работы с категориями товаров
 */
class Category{
    /**
     * Возвращает массив включенных категорий для списка на сайте
     * @return array Массив с категориями
     */
    public static function getCategoriesList(){
        // Соединение с БД
        $db = Db::getConnection();

        $categoryList = array();
        // Запрос к БД
        $result = $db->query('SELECT id, name FROM category '
            . 'WHERE status = 1 '
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
    /**
     * Возвращает массив ВСЕХ категорий для админки (даже скрытых)
     * @return array Массив с категориями
     */
    public static function getAdminTotalAmountOfCategories()
    {
        $db = Db::getConnection();

        $sql = 'SELECT count(id) as count FROM category';

        // Возвращаем значение count - количество ВСЕХ категорий
        $row = $db->query($sql)->fetchColumn();
        return $row;
    }
    public static function getAdminCategoriesList(){
        // Соединение с БД
        $db = Db::getConnection();

        $categoryList = array();
        // Запрос к БД
        $result = $db->query('SELECT * FROM category '
            . 'ORDER BY sort_order ASC');
        // Получение и возврат результатов
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }
    /**
     * Возвращает текстое пояснение статуса для категории :<br/>
     * 0 - Скрыта, 1 - Отображается
     * @param integer $status Статус
     * @return string Текстовое пояснение
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }
    /**
     * Удаляет категорию с заданным id
     * @param integer $id
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'DELETE FROM category WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    /**
     * Добавляет новую категорию
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат добавления записи в таблицу</p>
     */
    public static function createCategory($name, $sortOrder, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO category (name, sort_order, status) '
            . 'VALUES (:name, :sort_order, :status)';
        // Получение и возврат результатов. Используем подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
    /**
     * Возвращает категорию с указанным id
     * @param integer $id id категории
     * @return array Массив с информацией о категории
     */
    public static function getCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM category WHERE id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполняем запрос
        $result->execute();
        // Возвращаем данные
        return $result->fetch();
    }
    /**
     * Редактирование категории с заданным id
     * @param int $id id категории
     * @param string $name Название
     * @param int $sortOrder Порядковый номер
     * @param int $status Статус <i>(включено "1", выключено "0")
     * @return boolean Результат выполнения метода
     */
    public static function updateCategoryById($id, $name, $sortOrder, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";
        // Получение и возврат результатов. Используем подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
}