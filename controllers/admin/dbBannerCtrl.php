<?php
	require_once(__DIR__ . '/../../models/User.php');
	require_once(__DIR__ . '/../../config/regex.php');
	require_once(__DIR__ . '/../../helpers/testInputs.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');

	if ($_SERVER['REQUEST_URI'] == '/admin/banner/edit') {

		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/banner/";

		if (!empty($_FILES["img"]["name"])) {
			$target_file = 'banner.jpg';
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
		}
	
		$from = $_FILES['img']['tmp_name'];
		$extension = 'jpg';
		
		$dst_x = 0;
		$dst_y = 0;
		$src_x = 0;
		$src_y = 0;
		$dst_width = 1600;
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
	
		header('Location: /admin/banner');
		exit();
	}

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbBanner.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');