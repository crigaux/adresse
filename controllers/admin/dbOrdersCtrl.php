<?php
	require_once(__DIR__ . '/../../models/Order.php');
	require_once(__DIR__ . '/../../models/Reservation.php');
	require_once(__DIR__ . '/../../config/regex.php');
	require_once(__DIR__ . '/../../config/config.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');

	// ###############################################################################
	// ###                    TEST SI L'UTILISATEUR EST UN ADMIN                   ###	
	// ###############################################################################

	if((isset($_SESSION) && $_SESSION['user']->admin != 1) || !isset($_SESSION)){
		header('Location: /');
		exit;
	}
	
	
	// ###############################################################################
	// ###                           AFFICHE LES COMMANDES                         ###	
	// ###############################################################################
	
	if($_SERVER['REQUEST_URI'] == '/admin/commandes') {
		$reservations = Reservation::getAll('orders');
		
		include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
		include(__DIR__ . '/../../views/admin/dbOrders.php');
		include(__DIR__ . '/../../views/admin/templates/dbFooter.php');

	// ###############################################################################
	// ###                           VALIDE UNE COMMANDES                          ###	
	// ###############################################################################

	} else if($_SERVER['REQUEST_URI'] == '/admin/commandes/validate') {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$validate = intval(filter_input(INPUT_POST, 'validate', FILTER_SANITIZE_NUMBER_INT));
			$reservation = Reservation::get($validate);
	
			if(empty($validate)) {
				$errors['validate'] = 'Veuillez sélectionner une commande';
			}
	
			if(empty($errors) && $reservation->validated_at == NULL){
				Reservation::validate($validate);
				SessionFlash::set('message', 'Validation effectuée');
				header('Location: /admin/commandes');
				exit;
			}
		}

	// ###############################################################################
	// ###                           SUPPRIME UNE COMMANDES                        ###	
	// ###############################################################################

	} else if($_SERVER['REQUEST_URI'] == '/admin/commande/delete/'.$id) {
		
		$id = intval($id);
		if(Reservation::delete($id) == true) {
			SessionFlash::set('message', 'Suppression effectuée');
			header('Location: /admin/commandes');
			exit;
		} else {
			SessionFlash::set('message', 'Erreur lors de la suppression');
			header('Location: /admin/commandes');
			exit;
		}
	}