<?php
/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{
    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        $userId = User::checkLogged();
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }
  
    public function actionEdit(){
       
        //require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }
}