<?php
require_once(__DIR__ . '/../../models/Drink.php');
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

if ($_SERVER['REQUEST_URI'] == '/admin/boissons') {
	$firstDrinkType = Drink::firstDrinkType();
	$typesOfDrinks = Drink::drinkTypes() + $firstDrinkType;

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbDrinks.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                    FILTRE DE RECHERCHE DES BOISSONS                     ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/boissons/search') {
	$search = trim(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

	$firstDrinkType = Drink::firstDrinkType();
	$typesOfDrinks = Drink::drinkTypes() + $firstDrinkType;

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbDrinks.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                          AJOUT D'UNE BOISSON                            ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/boissons/ajout') {
	$firstDrinkType = Drink::firstDrinkType();
	$typesOfDrinks = Drink::drinkTypes() + $firstDrinkType;

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
		$type = intval(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT));
		if (empty($type)) {
			$errors['type'] = 'Veuillez entrer un type de plat';
		}
		// Vérifie que le type de plat est valide
		$validType = [];
		for ($i = $firstDrinkType; $i < $typesOfDrinks; $i++) {
			$validType[] += $i;
		}
		if (in_array($type, $validType) == false) {
			$errors['type'] = 'Veuillez entrer un type de plat valide';
		}

		// Nettoie la provenance
		$provenance = filter_input(INPUT_POST, 'provenance', FILTER_SANITIZE_SPECIAL_CHARS);
		// Nettoie l'appellation
		$appellation = filter_input(INPUT_POST, 'appellation', FILTER_SANITIZE_SPECIAL_CHARS);
		// Nettoie le prix de la boisson
		$price = floatval(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		// Nettoie le prix de la bouteille
		$prix_bouteille = floatval(filter_input(INPUT_POST, 'prix_bouteille', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		// Nettoie le prix de la demi-bouteille
		$prix_demibouteille = floatval(filter_input(INPUT_POST, 'prix_demibouteille', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		// Nettoie le prix du verre
		$prix_verre = floatval(filter_input(INPUT_POST, 'prix_verre', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		// Nettoie le prix de la carafe
		$prix_carafe = floatval(filter_input(INPUT_POST, 'prix_carafe', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		// Nettoie le prix de la demi_carafe
		$prix_demicarafe = floatval(filter_input(INPUT_POST, 'prix_demicarafe', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));


		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/drinks/";

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
				$drink = new Drink($title, $description, $provenance, $appellation, $type, $price, $prix_bouteille, $prix_demibouteille, $prix_verre, $prix_carafe, $prix_demicarafe, 0, $image);
				if ($drink->create() == true) {
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
						move_uploaded_file($_SERVER['DOCUMENT_ROOT'] . '/public/assets/baseImg/drink.jpg', $target_path);
					}
					
					SessionFlash::set('message', 'Le plat a été ajouté.');
					header('Location: /admin/boissons#drink' . $pdo->lastInsertId());
					exit();
				}
			}
		}
	}
	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbDrinkAdd.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                          SUPPRESSION D'UN PLAT                          ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/boissons/delete/' . $id) {
	$id = intval($id);
	$drink = Drink::get($id);
	if (Drink::delete($id) == true) {
		unlink($_SERVER['DOCUMENT_ROOT'] . "/public/assets/drinks/" . htmlspecialchars_decode(strtolower(str_replace(' ', '', $drink->id))) . '.jpg');
		SessionFlash::set('message', 'Le plat a bien été supprimé.');
		header('location: /admin/boissons');
		exit();
	}
	SessionFlash::set('error', 'Le plat n\'a pas pu être supprimé.');
	header('location: /admin/boissons');
	exit();
}

// ###############################################################################
// ###                          MISE À JOUR D'UN PLAT                          ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/boissons/edit/' . $id) {
	$id = intval($id);
	$drink = Drink::get($id);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = [];

		// Nettoie le titre et vérifie qu'il n'est pas vide
		$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
		if (empty($title)) {
			$errors['title'] = 'Veuillez entrer un titre';
		}
		// Nettoie le prix et vérifie qu'il n'est pas vide
		$price = floatval(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		if (empty($price) && $price != 0) {
			$errors['price'] = 'Veuillez entrer un prix';
		}

		// Nettoie la description
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

		if (empty($errors)) {
			// Met à jour le plat
			$drinkUpdated = new Drink($title, $description, $provenance, $appellation, $type, $prix, $prix_bouteille, $prix_demibouteille, $prix_verre, $prix_carafe, $prix_demicarafe, $alacarte, $drink->image);
			$drinkUpdated->update($id);

			// Redirige vers la page des plats
			SessionFlash::set('message', 'Le plat a bien été modifié.');
			header('location: /admin/boissons');
			exit();
		}
	}

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbSpecialModify.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                 AFFICHAGE DU PLAT OU NON SUR L'ACCUEIL                  ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/boissons/edit/active/' . $id) {
	$id = intval($id);
	$drink = Drink::get($id);

	$errors = [];

	$active = intval(filter_input(INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT));

	if (($active < 1 && $active > 2)) {
		SessionFlash::set('error', 'Impossible de modifier l\'état du plat.');
		header('Location: /admin/boissons');
		exit();
	}

	$drinkUpdate = new Drink($title, $description, $provenance, $appellation, $type, $prix, $prix_bouteille, $prix_demibouteille, $prix_verre, $prix_carafe, $prix_demicarafe, $alacarte, $drink->image);
	$drinkUpdate->update($id);

	if ($active == 1) {
		SessionFlash::set('message', 'Le plat n\'est désormais plus visible sur l\'accueil.');
	} else {
		SessionFlash::set('message', 'Le plat est désormais visible sur l\'accueil.');
	}

	header('location: /admin/boissons#drink' . $drink->id);
	exit();
}

// ###############################################################################
// ###                    MISE À JOUR DE L'IMAGE D'UN PLAT                     ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/boissons/edit/img/' . $id) {
	$id = intval($id);
	$drink = Drink::get($id);

	$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/drinks/";
	if(empty($_FILES["img"]["name"])) {
		if (move_uploaded_file('/public/assets/baseImg/drink.jpg', $target_path)) {
			SessionFlash::set('message', 'L\'image a bien été modifiée.');
		} else {
			SessionFlash::set('error', 'L\'image n\'a pas pu être modifiée.');
		}
	} else {
		$drinkUpdated = new Special($drink->title, $drink->description, $drink->price, $drink->type,  $drink->datetime, 2, $drink->active);
		$drinkUpdated->update($id);
		$target_file = strtolower(str_replace(' ', '', $drink->id)) . '.' . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
		$target_path = $target_dir . $target_file;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));

		// Vérifie la taille du fichier
		if ($_FILES["img"]["size"] > 5000000) {
			SessionFlash::set('error', 'Le fichier est trop volumineux.');
			header('location: /admin/boissons');
			exit();
		}

		// Filtre les extensions du fichier
		if ($_FILES["img"]["type"] != 'image/jpeg') {
			SessionFlash::set('error', 'Le fichier doit avoir l\'extension JPG, JPEG');
			header('location: /admin/boissons');
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

	header('Location: /admin/boissons');
	exit();
}