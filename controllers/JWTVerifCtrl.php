<?php

require_once(__DIR__ . '/../helpers/JWT.php');
require_once(__DIR__ . '/../helpers/SessionFlash.php');
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/User.php');

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

if(JWT::check($token) == true) {
	$id = JWT::getPayload($token)['user_id'];
	User::validate($id);
	SessionFlash::set('message', 'Votre compte a bien été validé');
	header('Location: /connexion');
	exit();
} else {
	SessionFlash::set('error', 'Erreur de validation de votre compte');
	header('Location: /accueil');
	exit();
}
