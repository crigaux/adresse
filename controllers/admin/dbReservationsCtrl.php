<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once(__DIR__ . '/../../vendor/autoload.php');

	require_once(__DIR__ . '/../../models/Reservation.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');
	require_once(__DIR__ . '/../../helpers/testInputs.php');
	require_once(__DIR__ . '/../../config/config.php');
	require_once(__DIR__ . '/../../config/regex.php');
	
	// ###############################################################################
	// ###                    TEST SI L'UTILISATEUR EST UN ADMIN                   ###	
	// ###############################################################################

	if((isset($_SESSION) && $_SESSION['user']->admin != 1) || !isset($_SESSION)){
		header('Location: /');
		exit;
	}

	// ###############################################################################
	// ###                         AFFICHAGE DU DASHBOARD                          ###	
	// ###############################################################################

	if($_SERVER['REQUEST_URI'] == '/admin/reservations'){
		$reservations = Reservation::getAll();

		include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
		include(__DIR__ . '/../../views/admin/dbReservations.php');
		include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
	}

	// ###############################################################################
	// ###                      VALIDATION DE LA RÉSERVATION                       ###	
	// ###############################################################################

	else if($_SERVER['REQUEST_URI'] == '/admin/reservation/edit/validate/'.$id){
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$id = intval($id);
			$errors =[];

			$validate = filter_input(INPUT_POST, 'validate', FILTER_SANITIZE_EMAIL);

			if(testInput($validate, MAIL_REGEX) == 'true'){
				if(Reservation::validate($id) == true) {
					$reservation = Reservation::get($id);
					$mail = new PHPMailer(true);

					try {
						//Server settings
						$mail->CharSet = 'UTF-8';
						$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
						$mail->isSMTP();                                            //Send using SMTP
						$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
						$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
						$mail->Username   = 'contact.annexe.restaurant@gmail.com';                     //SMTP username
						$mail->Password   = 'fldfoxotvybsynuo';                               //SMTP password
						$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
						$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
				
						//Recipients
						$mail->setFrom('contact.annexe.restaurant@gmail.com', 'Restaurant l\'Annexe');
						$mail->addAddress($validate);     //Add a recipient
						// $mail->addAddress('ellen@example.com');               //Name is optional
						// $mail->addReplyTo('info@example.com', 'Information');
						// $mail->addCC('cc@example.com');
						// $mail->addBCC('bcc@example.com');
				
						//Attachments
						// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
						// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
				
						//Content
						$mail->isHTML(true);                                  //Set email format to HTML
						$mail->Subject = 'Votre réservation a été validée';
						$mail->Body    = 'Bonjour,<br> votre réservation au nom de ' . $reservation->lastname . ', pour le ' . $formatDate->format(strtotime($reservation->reservation_date)) . ' a été validée. <br> Nous vous attendons avec impatience !';
						// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
						$mail->send();
						echo 'Message has been sent';
					} catch (Exception $e) {
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}

					SessionFlash::set('message', 'La réservation a bien été validée');
					header('Location: /admin/reservations');
					exit;
				} else {
					SessionFlash::set('error', 'La réservation n\'a pas pu être validée');
					header('Location: /admin/reservations');
					exit;
				}
			} else {
				SessionFlash::set('error', 'La réservation n\'a pas pu être validée');
				header('Location: /admin/reservations');
				exit;
			}
		}
	}

	// ###############################################################################
	// ###                        SUPPRIME UNE RÉSERVATION                         ###	
	// ###############################################################################

	else if($_SERVER['REQUEST_URI'] == '/admin/reservation/delete/'.$id){
		$id = intval($id);

		if(Reservation::delete($id) == true) {
			SessionFlash::set('message', 'La réservation a bien été supprimée');
			header('Location: /admin/reservations');
			exit;
		} else {
			SessionFlash::set('error', 'La réservation n\'a pas pu être supprimée');
			header('Location: /admin/reservations');
			exit;
		}
	}