<?php
/**
 * Контроллер AdminProductController
 * Управление товарами в админпанели
 */
class AdminProductController extends AdminBase{
    public function actionIndex(/*$page = 1*/)
    {
        // Проверка доступа
        self::checkAdmin();
        $amount = 25; // Количество отображаемых товаров по умолчанию

        // Если изменилось количество отображаемых товаров получаем новый $amount
        if (isset($_POST['peer-id'])){$amount =$_POST['peer-id']; }

        // Получаем список товаров
        $productsList = Product::getAdminProductsList($amount);

        // Для удобства получим кол-во ВСЕХ товаров товаров,
        // для выпадающего списка -> Отобразить всё
        $total = Product::getAdminTotalAmountOfProducts();

        // Получаем список ВСЕХ категорий (даже скрытых)
        $categoriesList = Category::getAdminCategoriesList();

        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }
    // Action для создания товаров
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();
        // Получаем список ВСЕХ категорий (даже скрытых)
        $categoriesList = Category::getAdminCategoriesList();
        if (isset($_POST['submit'])) {
            // Если форма отправлена получаем данные из формы
            $options['name'] =  $_POST['name'];
            $options['code'] =  $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            //$options['image'] = $_POST['image'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['availability'] = $_POST['availability'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];


            // Флаг ошибок в форме
            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = "Заполните Название товара";
            }
            if ($errors == false) {
                $id = Product::createProduct($options);

                if ($id)
                {
                    // Проверим загрузилось ли через форму изображение
                }
            }
        header ("Location: /admin/product");
        }

        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }
    /**
     * Action для редактирования товара
     * @param $id int - id товара
     */
    public function actionUpdate($id){
        // Проверка доступа
        self::checkAdmin();
        // Получаем список ВСЕХ категорий (даже скрытых)
        $categoriesList = Category::getAdminCategoriesList();

        // Получаем всю информацию о конкретном товаре
        $product = Product::getProductById($id);
        if (isset($_POST['submit'])) {
            // Если форма отправлена получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            //$options['image'] = $_POST['image'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['availability'] = $_POST['availability'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            if (Product::updateProductById($id, $options)) {
                // image check

            }
            header ("Location: /admin/product");

        }

        require_once(ROOT . '/views/admin_product/update.php');
        return true;

    }

    /**
     * Action для страницы удалить товар
     * @param $id int - id товара
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, удаляем товар
            Product::deleteProductById($id);
            // Отправляем пользователя на страницу выше (управление товаров)
            header ("Location: /admin/product");
        }
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }
}