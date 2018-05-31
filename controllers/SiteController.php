<?php
class SiteController{
    public function actionIndex(){
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(6);

        $recommended = [];
        $recommended = Product::getRecommendedProducts();

        require_once(ROOT . '/views/site/index.php');
        return true;
    }
	    public function actionContact(){
        $userEmail = false;
        $userText = false;
        $result = false;
        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            $errors = false;
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            if ($errors == false) {
                $adminEmail = 'whatever@whatever.loc';
                $message = "{$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
				//var_dump ($result);
            }
        }
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }
}
