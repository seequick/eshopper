<?php

class UserController {
	public function actionRegister(){
		$name = false;
		$email = false;
		$password = false;
		$result = false;
		
		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$errors = false;
			
			if (!User::checkName($name)) {
				$errors[] = 'Имя не должно быть короче 3 символов';
			}
			if (!User::checkEmail($email)) {
				$errors[] = 'Неправильный email'; 
			}
			if (!User::checkPassword($password)) {
				$errors[] = 'Пароль не должен быть короче 6 символов'; 
			}
			if (User::checkEmailExists($email)) {
				$errors[] = 'Этот email уже зарегистрирован'; 
			}
			if ($errors == false){
				$result = User::Register($name, $password, $email);
			}
		}
		
		require_once (ROOT. '/views/user/register.php');
		
		return true;
	}
	
	
	
}