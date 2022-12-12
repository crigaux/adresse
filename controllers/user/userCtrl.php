<?php
require_once(__DIR__ . '/../../models/User.php');
require_once(__DIR__ . '/../../models/Reservation.php');
require_once(__DIR__ . '/../../models/Order.php');
require_once(__DIR__ . '/../../models/Dish.php');
require_once(__DIR__ . '/../../models/Review.php');
require_once(__DIR__ . '/../../config/regex.php');
require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../../helpers/testInputs.php');
require_once(__DIR__ . '/../../helpers/SessionFlash.php');

// ###############################################################################
// ###                    TEST SI L'UTILISATEUR EST CONNECTÉ                   ###
// ###############################################################################

if (!isset($_SESSION['user'])) {
	header('Location: /');
	exit;
}

// ###############################################################################
// ###                            AFFICHE LE PROFIL                            ###
// ###############################################################################

if ($_SERVER['REQUEST_URI'] == '/profil') {
	$user = User::get(id: $_SESSION['user']->id);

	include(__DIR__ . '/../../views/user/userHeader.php');
	include(__DIR__ . '/../../views/user/userProfil.php');
}

// ###############################################################################
// ###                    MODIFIE LE PROFIL DE L'UTILISATEUR                   ###
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/edit') {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$lastname = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
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
		} else if (User::isExist($email) == true && $email != $_SESSION['user']->email) {
			$errors['email'] = 'Cet email est déjà utilisé';
		}

		$phoneNb = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
		if (testInput($phoneNb, PHONE_REGEX) != 'true') {
			$errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
		}

		$newsletter = intval(filter_input(INPUT_POST, 'newsletter', FILTER_SANITIZE_NUMBER_INT));
		if ($newsletter != 1 && $newsletter != NULL) {
			$errors['newsletter'] = 'format non reconnu';
		}

		$password = User::passwordVerification($_SESSION['user']->email);

		if (empty($errors)) {
			$user = new User($lastname, $firstname, $email, $phoneNb, 0, $newsletter);

			if ($user->update($_SESSION['user']->id) == true) {
				$_SESSION['user'] = User::get(id: $_SESSION['user']->id);
				header('Location: /profil');
				exit();
			} else {
				SessionFlash::set('error', 'Une erreur est survenue lors de l\'enregistrement de votre compte');
				header('Location: /profil');
				exit();
			}
		}
	}
}

// ###############################################################################
// ###               AFFICHE LES RÉSERVATIONS DE L'UTILISATEUR                 ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/reservations') {
	$id = intval($_SESSION['user']->id);

	$reservations = Reservation::getByUser($id);

	include(__DIR__ . '/../../views/user/userHeader.php');
	include(__DIR__ . '/../../views/user/reservations.php');
}

// ###############################################################################
// ###                         AFFICHE LES COMMANDES                           ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/commandes') {
	$id = intval($_SESSION['user']->id);

	$reservations = Reservation::getOrders($id);

	include(__DIR__ . '/../../views/user/userHeader.php');
	include(__DIR__ . '/../../views/user/orders.php');
}

// ###############################################################################
// ###                        AFFICHE LES COMMENTAIRES                         ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/commentaires') {

	$reviews = Review::getByUser($_SESSION['user']->id);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
		$review = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS));
	}

	include(__DIR__ . '/../../views/user/userHeader.php');
	include(__DIR__ . '/../../views/user/reviews.php');
}

// ###############################################################################
// ###                     SUPPRIME LE COMPTE UTILISATEUR                      ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/user/delete') {
	if(User::delete($_SESSION['user']->id)) {
		unset($_SESSION['user']);
		SessionFlash::set('message', 'Votre compte a bien été supprimée.');
		header('Location: /accueil');
		exit;
	} else {
		SessionFlash::set('error', 'Une erreur est survenue lors de la suppression de votre compte.');
		header('Location: /accueil');
		exit;
	}
}

// ###############################################################################
// ###                        MODIFIE UNE RÉSERVATION                          ###
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/reservation/edit/' . $id) {
	
	$idUser = intval($_SESSION['user']->id);
	$id = intval($id);

	$reservations = Reservation::getByUser($_SESSION['user']->id);

	foreach ($reservations as $reservation) {
		if ($reservation->id == $id) {
			$reservation = Reservation::get($id);

			$date = date('Y-m-d', strtotime($reservation->reservation_date));
			$time = date('H:i', strtotime($reservation->reservation_date));

			if ($time == '12:00') {
				$time = 1;
			} else {
				$time = 2;
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$persons = intval(filter_input(INPUT_POST, 'nbOfClients', FILTER_SANITIZE_NUMBER_INT));
				if (testInput($persons, NB_REGEX) != 'true') {
					$errors['persons'] = testInput($persons, NB_REGEX);
				}

				$date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS));
				if (testInput($date, DATE_REGEX) != 'true') {
					$errors['date'] = testInput($date, DATE_REGEX);
				}

				$time = intval(filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT));
				if ($time != 1 && $time != 2) {
					$errors['time'] = 'format non reconnu';
				}

				$datetime = $date . ' ' . ($time == 1 ? '12:00:00' : '19:00:00');

				if (empty($errors)) {
					$reservation = new Reservation($persons, $datetime, $idUser, NULL);

					if ($reservation->update($id) == true) {
						SessionFlash::set('message', 'Votre réservation a bien été modifiée');
						header('Location: /profil/reservations');
						exit();
					} else {
						SessionFlash::set('error', 'Une erreur est survenue lors de la modification de votre réservation');
						header('Location: /profil/reservations');
						exit();
					}
				}
			}
		} else {
			SessionFlash::set('error', 'Vous ne pouvez pas modifier cette réservation');
			header('Location: /profil/reservations');
			exit();
		}
	}

	include(__DIR__ . '/../../views/user/userHeader.php');
	include(__DIR__ . '/../../views/user/reservationsModify.php');
} 

// ###############################################################################
// ###                        MODIFIE UN COMMENTAIRE                           ###
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/commentaire/edit/' . $id) {
	$id = intval($id);

	$reviews = Review::getByUser($_SESSION['user']->id);
	foreach ($reviews as $review) {
		if ($review->id == $id) {
			$review = Review::get($id);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
				$content = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS));

				if (empty($errors)) {
					$review = new Review($title, $content, $review->id_users, NULL);

					if ($review->update($id) == true) {
						SessionFlash::set('message', 'Votre commentaire a bien été modifiée');
						header('Location: /profil/commentaires');
						exit();
					} else {
						SessionFlash::set('error', 'Une erreur est survenue lors de la modification de votre commentaire');
						header('Location: /profil/commentaires');
						exit();
					}
				}
			}
		} else {
			SessionFlash::set('error', 'Vous ne pouvez pas modifier ce commentaire');
			header('Location: /profil/commentaires');
			exit();
		}
	}

	include(__DIR__ . '/../../views/user/userHeader.php');
	include(__DIR__ . '/../../views/user/reviewModify.php');
} 

// ###############################################################################
// ###                         MODIFIE UNE COMMANDE                            ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/commande/edit/' . $id) {
	$idUser = intval($_SESSION['user']->id);
	$id = intval($id);

	$orders = Reservation::getOrders($_SESSION['user']->id);

	foreach ($orders as $order) {
		if ($order->id == $id) {
			$reservation = Reservation::get($id);
			$dishes = Dish::getAll();

			$date = date('Y-m-d', strtotime($reservation->reservation_date));
			$time = date('H:i', strtotime($reservation->reservation_date));

			if ($time == '12:00') {
				$time = 1;
			} else {
				$time = 2;
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS));
				if (testInput($date, DATE_REGEX) != 'true') {
					$errors['date'] = testInput($date, DATE_REGEX);
				}

				$time = intval(filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT));
				if ($time != 1 && $time != 2) {
					$errors['time'] = 'format non reconnu';
				}

				$datetime = $date . ' ' . ($time == 1 ? '12:00:00' : '19:00:00');

				$dishId = filter_input(INPUT_POST, 'dishes', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
				$quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

				if(empty($dishId)) {
					$errors['dishes'] = 'Vous devez choisir au moins un plat';
				}
				
				if (testInput($date, DATE_REGEX) != 'true') {
					$errors['date'] = testInput($date, DATE_REGEX);
				}

				if (empty($errors)) {
					$orders = Order::getByReservation($reservation->id);
					for ($i = 0; $i < count($orders)-1; $i++) {
						$orderUpdated = new Order($quantity[$i], $dishId[$i], $reservation->id);
						$orderUpdated->update($orders[$i]->id);
					}
					for ($i = count($orders); $i < count($dishId); $i++) {
						$orderUpdated = new Order($quantity[$i], $dishId[$i], $reservation->id);
						$orderUpdated->create();
					}
					SessionFlash::set('message', 'Votre commande a bien été modifiée.');
					header('Location: /profil/commandes');
					exit;
				}
			}
		} else {
			SessionFlash::set('error', 'Vous ne pouvez pas modifier cette commande');
			header('Location: /profil/commandes');
			exit;
		}
	}

	include(__DIR__ . '/../../views/user/userHeader.php');
	include(__DIR__ . '/../../views/user/orderModify.php');
}

// ###############################################################################
// ###                        SUPPRIME UNE COMMANDE                         ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/commande/delete/' . $id) {
	$id = intval($id);
	$reservation = Order::get($id);
	if($reservation->id_users == $_SESSION['user']->id) {
		if(Reservation::delete($id) == true) {
			SessionFlash::set('message', 'Votre commande a bien été supprimée.');
			header('Location: /profil/commandes');
			exit;
		} else {
			SessionFlash::set('error', 'Une erreur est survenue lors de la suppression de votre commande.');
			header('Location: /profil/commandes');
			exit;
		}
	} else {
		SessionFlash::set('error', 'Vous ne pouvez pas supprimer cette commande');
		header('Location: /profil/commandes');
		exit;
	}
}

// ###############################################################################
// ###                        SUPPRIME UNE RÉSERVATION                         ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/reservation/delete/' . $id) {
	$id = intval($id);
	$reservation = Reservation::get($id);
	if($reservation->id_users == $_SESSION['user']->id) {
		if(Reservation::delete($id) == true) {
			SessionFlash::set('message', 'Votre commande a bien été supprimée.');
			header('Location: /profil/reservations');
			exit;
		} else {
			SessionFlash::set('error', 'Une erreur est survenue lors de la suppression de votre commande.');
			header('Location: /profil/reservations');
			exit;
		}
	} else {
		SessionFlash::set('error', 'Vous ne pouvez pas supprimer cette commande');
		header('Location: /profil/reservations');
		exit;
	}
}
		
// ###############################################################################
// ###                     SUPPRIME UN PLAT D'UNE COMMANDE                     ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/commande/plat/delete/' . $id) {
	$orders = Order::getByUser($_SESSION['user']->id);
	$id_reservation = Reservation::getByOrder($id);
	if($id_reservation == false) {
		SessionFlash::set('error', 'Une erreur est survenue lors de la suppression du plat.');
		header('Location: /profil/commandes');
		exit;
	}
	$id_reservation = $id_reservation->id;
	foreach ($orders as $order) {
		if ($order->id == $id) {
			if(Order::delete($id)) {
				if((Reservation::getOrdersByReservation($id_reservation)) == false) {
					Reservation::delete($id_reservation);
				}
				SessionFlash::set('message', 'Votre plat a bien été supprimée.');
				header('Location: /profil/commandes');
				exit;
			} else {
				SessionFlash::set('error', 'Une erreur est survenue lors de la suppression de votre plat.');
				header('Location: /profil/commandes');
				exit;
			}
			header('Location: /profil/commandes');
			exit;
		}
	}
}

// ###############################################################################
// ###                        SUPPRIME UN COMMENTAIRE                          ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/profil/commentaire/delete/' . $id) {

	$reviews = Review::getByUser($_SESSION['user']->id);
	foreach ($reviews as $review) {
		if ($review->id == $id) {
			if(Review::delete($id) == true) {
				SessionFlash::set('message', 'Votre commentaire a bien été supprimé.');
				header('Location: /profil/commentaires');
				exit;
			} else {
				SessionFlash::set('error', 'Une erreur est survenue lors de la suppression de votre commentaire.');
				header('Location: /profil/commentaires');
				exit;
			}
		} else {
			SessionFlash::set('error', 'Vous ne pouvez pas supprimer ce commentaire');
			header('Location: /profil/commentaires');
			exit;
		}
	}
}
