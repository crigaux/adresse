<?php
require_once(__DIR__ . '/../../models/Dish.php');
require_once(__DIR__ . '/../../helpers/SessionFlash.php');

// ###############################################################################
// ###                    TEST SI L'UTILISATEUR EST UN ADMIN                   ###	
// ###############################################################################

if ((isset($_SESSION) && $_SESSION['user']->admin != 1) || !isset($_SESSION)) {
	header('Location: /');
	exit;
}

// ###############################################################################
// ###                         AFFICHAGE DU DASHBOARD                          ###	
// ###############################################################################

if ($_SERVER['REQUEST_URI'] == '/admin/menu') {
	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbDishes.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                            AJOUT D'UN PLAT                              ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/menu/ajout') {
	$dishTypes = Dish::dishTypes();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = [];

		// Nettoie le titre et vérifie qu'il n'est pas vide
		$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
		if (empty($title)) {
			$errors['title'] = 'Veuillez entrer un titre';
		}
		// Nettoie le prix et vérifie qu'il n'est pas vide
		$price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		if (empty($price)) {
			$errors['price'] = 'Veuillez entrer un prix';
		}
		// Nettoie la description
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

		// Nettoie le type de plat et vérifie qu'il n'est pas vide
		$dish_type = intval(filter_input(INPUT_POST, 'dish_type', FILTER_SANITIZE_NUMBER_INT));
		if (empty($dish_type)) {
			$errors['dish_type'] = 'Veuillez entrer un type de plat';
		}
		// Vérifie que le type de plat est valide
		$validType = [];
		for ($i = Dish::firstDishType() ; $i < Dish::firstDishType() + Dish::dishTypes(); $i++) {
			$validType[] += $i;
		}
		if (in_array($dish_type, $validType) == false) {
			$errors['dish_type'] = 'Veuillez entrer un type de plat valide';
		}

		$togo = intval(filter_input(INPUT_POST, 'toGo', FILTER_SANITIZE_NUMBER_INT));
		if ($togo != 0 && $togo != 1) {
			$errors['toGoCheckbox'] = 'Veuillez choisir une option';
		}
		
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/";

		if (!empty($_FILES["img"]["name"]) && $_FILES["img"]["type"] != 'image/jpeg') {
			$errors['img'] =  "Le fichier doit avoir l'extension JPG ou JPEG";
		} else {
			// Vérifie la taille du fichier (max 5Mo)
			if ($_FILES["img"]["size"] > 5 * 1024 * 1024) {
				$errors['img'] =  "Le fichier est trop volumineux.";
			}
			// Vérifie si il y a eu une erreur
			if (empty($errors)) {
				$pdo = Database::getInstance();
				if(empty($_FILES["img"]["name"])) {
					$image = 1;
				} else {
					$image = 2;
				}
				$dish = new Dish($title, $price, $description, $_SESSION['user']->id, $dish_type, $image, 1, $togo);
				if ($dish->create() == true) {
					if(!empty($_FILES["img"]["name"])) {
						$target_file = strtolower(str_replace(' ', '', $pdo->lastInsertId())) . '.' . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
						$target_path = $target_dir . $target_file;
						$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
						move_uploaded_file($_FILES["img"]["tmp_name"], $target_path);

						$from = $_FILES['img']['tmp_name'];
						$extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
						
						$dst_x = 0;
						$dst_y = 0;
						$src_x = 0;
						$src_y = 0;
						$dst_width = 500;
						$src_width = getimagesize($target_path)[0];
						$src_height = getimagesize($target_path)[1];
						$dst_height = round(($dst_width * $src_height) / $src_width);
						$dst_image = imagecreatetruecolor($dst_width, $dst_height);
						$src_image = imagecreatefromjpeg($target_path);
					
						// Redimensionne
						imagecopyresampled(
							$dst_image,
							$src_image,
							$dst_x,
							$dst_y,
							$src_x,
							$src_y,
							$dst_width,
							$dst_height,
							$src_width,
							$src_height
						);
					
						// redimensionne l'image
						$resampledDestination = $target_dir . $target_file;
						imagejpeg($dst_image, $resampledDestination, 75);
					} else {
						move_uploaded_file($_SERVER['DOCUMENT_ROOT'] . '/public/assets/baseImg/dish.jpg', $target_path);
					}
					
					SessionFlash::set('message', 'Le plat a été ajouté.');
					header('Location: /admin/menu#dish' . $pdo->lastInsertId());
					exit();
				}
			}
		}
	}
	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dishAdd.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                 AFFICHAGE DU PLAT OU NON SUR L'ACCUEIL                  ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/menu/edit/active/' . $id) {
	$id = intval($id);
	$dish = Dish::getById($id);

	$errors = [];

	$active = intval(filter_input(INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT));

	if (($active < 1 && $active > 2)) {
		SessionFlash::set('error', 'Impossible de modifier l\'état du plat.');
		header('Location: /admin/menu');
		exit();
	}

	$dishUpdate = new Dish($dish->title, $dish->price, $dish->description, $dish->id_users, $dish->id_dishes_types, $dish->image, $active, $dish->togo);
	$dishUpdate->update($id);

	if ($active == 1) {
		SessionFlash::set('message', 'Le plat n\'est désormais plus visible sur l\'accueil.');
	} else {
		SessionFlash::set('message', 'Le plat est désormais visible sur l\'accueil.');
	}

	header('location: /admin/menu#dish' . $dish->id);
	exit();
}

// ###############################################################################
// ###                          MISE À JOUR D'UN PLAT                          ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/menu/edit/' . $id) {
	$id = intval($id);
	$dish = Dish::getById($id);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = [];

		// Nettoie le titre et vérifie qu'il n'est pas vide
		$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
		if (empty($title)) {
			$errors['title'] = 'Veuillez entrer un titre';
		}
		// Nettoie le prix et vérifie qu'il n'est pas vide
		$price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		if (empty($price)) {
			$errors['price'] = 'Veuillez entrer un prix';
		}
		// Nettoie la description
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

		$toGo = intval(filter_input(INPUT_POST, 'toGo', FILTER_SANITIZE_NUMBER_INT));
		if ($toGo != 0 && $toGo != 1) {
			$errors['toGoCheckbox'] = 'Veuillez choisir une option';
		}

		if (empty($errors)) {
			// Met à jour le plat
			$dishUpdated = new Dish($title, $price, $description, $dish->id_users,  $dish->id_dishes_types, $dish->image, $dish->active, $toGo);
			$dishUpdated->update($id);

			// Redirige vers la page des plats
			SessionFlash::set('message', 'Le plat a bien été modifié.');
			header('location: /admin/menu');
			exit();
		}
	}

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dishModify.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                          SUPPRESSION D'UN PLAT                          ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/menu/delete/' . $id) {
	$id = intval($id);
	$dish = Dish::getById($id);
	if (Dish::delete($id) == true) {
		unlink($_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/" . htmlspecialchars_decode(strtolower(str_replace(' ', '', $dish->id))) . '.jpg');
		SessionFlash::set('message', 'Le plat a bien été supprimé.');
		header('location: /admin/menu');
		exit();
	}
	SessionFlash::set('error', 'Le plat n\'a pas pu être supprimé.');
	header('location: /admin/menu');
	exit();
}

// ###############################################################################
// ###                    MISE À JOUR DE L'IMAGE D'UN PLAT                     ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/menu/edit/img/' . $id) {
	$id = intval($id);
	$dish = Dish::getById($id);

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/";
	if(empty($_FILES["img"]["name"])) {
		if (move_uploaded_file('/public/assets/baseImg/dish.jpg', $target_path)) {
			SessionFlash::set('message', 'L\'image a bien été modifiée.');
		} else {
			SessionFlash::set('error', 'L\'image n\'a pas pu être modifiée.');
		}
	} else {
		$dishUpdated = new Dish($dish->title, $dish->price, $dish->description, $dish->id_users,  $dish->id_dishes_types, 2, $dish->active, $dish->togo);
		$dishUpdated->update($id);
		$target_file = strtolower(str_replace(' ', '', $dish->id)) . '.' . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
		$target_path = $target_dir . $target_file;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));

		// Vérifie la taille du fichier
		if ($_FILES["img"]["size"] > 5000000) {
			SessionFlash::set('error', 'Le fichier est trop volumineux.');
			header('location: /admin/menu');
			exit();
		}

		// Filtre les extensions du fichier
		if ($_FILES["img"]["type"] != 'image/jpeg') {
			SessionFlash::set('error', 'Le fichier doit avoir l\'extension JPG, JPEG');
			header('location: /admin/menu');
			exit();
		}

		// Vérifie si $uploadOk est mis à 0 suite à une erreur
		if ($uploadOk != 0) {
			if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_path)) {
				SessionFlash::set('message', 'L\'image a bien été modifiée.');
			} else {
				SessionFlash::set('error', 'L\'image n\'a pas pu être modifiée.');
			}
		} else {
			SessionFlash::set('error', 'L\'image n\'a pas pu être modifiée.');
		}

		$from = $_FILES['img']['tmp_name'];
		$extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
		
		$dst_x = 0;
		$dst_y = 0;
		$src_x = 0;
		$src_y = 0;
		$dst_width = 500;
		$src_width = getimagesize($target_path)[0];
		$src_height = getimagesize($target_path)[1];
		$dst_height = round(($dst_width * $src_height) / $src_width);
		$dst_image = imagecreatetruecolor($dst_width, $dst_height);
		$src_image = imagecreatefromjpeg($target_path);
	
		// Redimensionne
		imagecopyresampled(
			$dst_image,
			$src_image,
			$dst_x,
			$dst_y,
			$src_x,
			$src_y,
			$dst_width,
			$dst_height,
			$src_width,
			$src_height
		);
	
		// redimensionne l'image
		$resampledDestination = $target_dir . $target_file;
		imagejpeg($dst_image, $resampledDestination, 75);
	}

	header('Location: /admin/menu');
	exit();
}
