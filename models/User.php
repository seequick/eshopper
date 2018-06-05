<?php
/**
 * Класс User - модель для работы с пользователями
 */
class User {
	 /**
     * Регистрация пользователя
     * @param string $name имя
     * @param string $email е-mail
     * @param string $password пароль
     * @return boolean Результат выполнения метода
     */
    public static function register($name, $email, $password){
        $db = Db::getConnection();
        $sql = 'INSERT INTO user (name, email, password) '
                . 'VALUES (:name, :email, :password)';

        // Получение и возврат результатов. Используем подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }
    /**
     * Проверяет имя: не меньше, чем 2 символа
     * @param string $name Имя
     * @return boolean Результат выполнения метода
     */
    public static function checkName($name){
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет пароль: не меньше, чем 6 символов
     * @param string $phone Телефон
     * @return boolean Результат выполнения метода
     */
    public static function checkPassword($password){
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет телефон: не меньше, чем 9 символов
     * @param string $password Пароль
     * @return boolean Результат выполнения метода
     */
    public static function checkPhone($phone){
        if (strlen($phone) >= 9) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет email
     * @param string $email E-mail
     * @return boolean Результат выполнения метода
     */
    public static function checkEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет не занят ли email другим пользователем
     * @param string $email E-mail
     * @return boolean Результат выполнения метода
     */
	public static function checkEmailExists($email){  
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn())
            return true;
        return false;
    }
    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email E-mail
     * @param string $password Пароль
     * @return mixed : integer user id or false
     */
    public static function checkUserData($email, $password){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        $result = $db->prepare($sql);

        // Получение результатов. Использум подготовленный запрос
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        // Обращаемся к записи
        $user = $result->fetch();
        if ($user) {
            // Если запись существует, возвращаем id пользователя
            return $user['id'];
        }
        return false;
    }
    /**
     * Запоминаем пользователя
     * @param integer $userId id пользователя
     */
    public static function auth($id){
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $id;
    }
    /**
     * Возвращает идентификатор пользователя, если он авторизирован.
     * Иначе перенаправляет на страницу входа
     * @return string Идентификатор пользователя
     */
    public static function checkLogged(){
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }

    /**
     * Проверяет является ли пользователь гостем
     * @return boolean Результат выполнения метода
     */
    public static function isGuest(){
        if (isset($_SESSION['user']))
            return false;
        return true;
    }
    /**
     * Возвращает пользователя с указанным id
     * @param integer $id id пользователя
     * @return array Массив с информацией о пользователе
     */
    public static function getUserById($id){

            $db = Db::getConnection();

            $sql = 'SELECT * FROM user WHERE id =  :id';
            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }

    /**
     * Редактирование данных пользователя
     * @param integer $id id пользователя
     * @param string $name Имя
     * @param string $password Пароль
     * @return boolean Результат выполнения метода
     */
    public static function edit($id, $name, $password){
        $db = Db::getConnection();
        $sql = "UPDATE user SET name = :name, password = :password WHERE user.id = :id";

        // Получение и возврат результатов. Используем подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }
    }