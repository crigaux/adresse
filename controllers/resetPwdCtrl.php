<?php

require_once(__DIR__ . '/../helpers/JWT.php');
require_once(__DIR__ . '/../helpers/SessionFlash.php');
require_once(__DIR__ . '/../helpers/testInputs.php');
require_once(__DIR__ . '/../config/regex.php');
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

	if (JWT::check($token) == true && JWT::isValid($token) == true) {
		$id = JWT::getPayload($token)['user_id'];
		$password = $_POST['password'];
		if (testInput($password, PWD_REGEX) != 'true') {
			$errors['password'] = testInput($password, PWD_REGEX);
		}
		
		$confirmPassword = $_POST['password2'];
		if ($password != $confirmPassword) {
			$errors['password'] = 'Les deux mots de passes doivent correspondre';
		}

		if(empty($errors)) {
			User::resetPassword($id, password_hash($password, PASSWORD_DEFAULT));
			SessionFlash::set('message', 'Mot de passe modifié');
			header('Location: /connexion');
			exit();
		}
	} else {
		SessionFlash::set('message', 'Erreur lors de la modification du mot de passe');
		header('Location: /accueil');
		exit();
	}
}

include(__DIR__ . '/../views/templates/nav.php');
include(__DIR__ . '/../views/resetPwd.php');