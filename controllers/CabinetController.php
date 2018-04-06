<?php
class CabinetController{
     public function actionIndex(){
        $userId = User::checkLogged();
		//var_dump ($userId);
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }
    public function actionEdit(){
        //require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }
}