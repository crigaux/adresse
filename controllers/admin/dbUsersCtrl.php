<?php

require_once(__DIR__ . '/../../models/User.php');
require_once(__DIR__ . '/../../helpers/SessionFlash.php');
require_once(__DIR__ . '/../../helpers/testInputs.php');
require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../../config/regex.php');

// ###############################################################################
// ###                    TEST SI L'UTILISATEUR EST UN ADMIN                   ###	
// ###############################################################################

if ((isset($_SESSION) && $_SESSION['user']->admin != 1) || !isset($_SESSION)) {
	header('Location: /');
	exit;
}

// ###############################################################################
// ###                       AFFICHAGE DES UTILISATEURS                        ###	
// ###############################################################################

if ($_SERVER['REQUEST_URI'] == '/admin/membres') {
	$users = User::getAll();

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbUsers.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                  FILTRE DE RECHERCHE DES UTILISATEURS                   ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/membres/search') {
	$search = trim(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS));
	$users = User::getAll($search);

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbUsers.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                     MODIFICATION DES UTILISATEURS                       ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/membre/edit/' . $id) {
	$id = intval($id);
	if(User::idExist($id) == false){
		SessionFlash::set('error', 'L\'utilisateur n\'existe pas');
		header('Location: /admin/membres');
		exit;
	}

	$user = User::get($id);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
		if (testInput($lastname, NAME_REGEX) != 'true') {
			$errors['name'] = testInput($lastname, NAME_REGEX);
		}

		$firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
		if (testInput($firstname, NAME_REGEX) != 'true') {
			$errors['firstname'] = testInput($firstname, NAME_REGEX);
		}

		$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
		if (testInput($email, MAIL_REGEX) != 'true') {
			$errors['email'] = testInput($email, MAIL_REGEX);
		} else if (User::isExist($email) == true && $email != $user->email) {
			$errors['email'] = 'Cet email est déjà utilisé';
		}

		$phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
		if (testInput($phone, PHONE_REGEX) != 'true') {
			$errors['phone'] = testInput($phone, PHONE_REGEX);
		}

		$role = intval(filter_input(INPUT_POST, 'role', FILTER_SANITIZE_NUMBER_INT));
		if ($role != 1 && $role != 2) {
			$errors['role'] = 'Valeur invalide';
		} else if ($role == 1) {
			$role = 1;
		} else {
			$role = 0;
		}

		if(empty($errors)) {
			$userUpdated = new User($lastname, $firstname, $email, $phone, $role, $user->newsletter);

			if($userUpdated->update($id)){
				SessionFlash::set('message', 'L\'utilisateur a bien été modifié');
				header('Location: /admin/membres');
				exit;
			} else {
				SessionFlash::set('error', 'Une erreur est survenue');
				header('Location: /admin/membres');
				exit;
			}

		}
	}

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbUserModify.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                        SUPPRIME UN UTILISATEUR                          ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/membre/delete/'.$id) {
	$id = intval($id);

	if(User::delete($id)){
		SessionFlash::set('message', 'L\'utilisateur a bien été supprimé');
		header('Location: /admin/membres');
		exit;
	} else {
		SessionFlash::set('error', 'Une erreur est survenue');
		header('Location: /admin/membres');
		exit;
	}
}