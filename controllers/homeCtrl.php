<?php
    require_once(__DIR__ . '/../config/regex.php');
    require_once(__DIR__ . '/../config/Database.php');
    require_once(__DIR__ . '/../helpers/testInputs.php');
    require_once(__DIR__ . '/../models/Reservation.php');
    require_once(__DIR__ . '/../models/Order.php');
    require_once(__DIR__ . '/../helpers/SessionFlash.php');

    $isOnHome = true;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(!isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }
        
        $errors =[];

        $form = trim(filter_input(INPUT_POST, 'form', FILTER_SANITIZE_NUMBER_INT));
        
        if($form == 1) {
            $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
            $phoneNb = trim(filter_input(INPUT_POST, 'phoneNb', FILTER_SANITIZE_NUMBER_INT));
            $nbOfClients = intval(filter_input(INPUT_POST, 'nbOfClients', FILTER_SANITIZE_NUMBER_INT));
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
            $time = intval(filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT));
            
            if(testInput($name, NAME_REGEX) != 'true') {
                $errors['name'] = testInput($name, NAME_REGEX);
            }
            if(testInput($phoneNb, PHONE_REGEX) != 'true') {
                $errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
            }
            if(testInput($nbOfClients, NB_REGEX) != 'true') {
                $errors['nbOfClients'] = testInput($nbOfClients, NB_REGEX);
            }
            if(testInput($date, DATE_REGEX) != 'true') {
                $errors['date'] = testInput($date, DATE_REGEX);
            }
            if(testInput($time, TIME_REGEX) != 'true') {
                $errors['time'] = testInput($time, TIME_REGEX);
            }

            if($time == 1) {
                $datetime = $date . ' 12:00:00';
            } else {
                $datetime = $date . ' 19:00:00';
            }

            if(empty($errors)) {
                $reservation = new Reservation($nbOfClients, $datetime, $_SESSION['user']->id);
                $reservation->create();
                SessionFlash::set('added', 'Votre réservation a bien été prise en compte.');
                header('Location: /');
                exit;
            }

        } else if($form == 2) {
            $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
            $phoneNb = trim(filter_input(INPUT_POST, 'phoneNb', FILTER_SANITIZE_NUMBER_INT));
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
            $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT);
            $dishId = filter_input(INPUT_POST, 'dishList', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

            if(testInput($name, NAME_REGEX) != 'true') {
                $errors['name'] = testInput($name, NAME_REGEX);
            }
            if(testInput($phoneNb, PHONE_REGEX) != 'true') {
                $errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
            }
            if(testInput($date, DATE_REGEX) != 'true') {
                $errors['date'] = testInput($date, DATE_REGEX);
            }
            if(testInput($time, TIME_REGEX) != 'true') {
                $errors['time'] = testInput($time, TIME_REGEX);
            }

            if($time == 1) {
                $datetime = $date . ' 12:00:00';
            } else {
                $datetime = $date . ' 19:00:00';
            }

            if(empty($errors)) {
                try {
                    $pdo = Database::getInstance();
                    $pdo->beginTransaction();
                    $reservation = new Reservation(0, $datetime, $_SESSION['user']->id);
                    
                    $reservation->create();
                    $lastId = $pdo->lastInsertId();
                    
                    for ($i=0; $i < count($dishId); $i++) { 
                        $order = new Order($quantity[$i], $dishId[$i], $lastId);
                        $order->create();
                    }
                    $pdo->commit();
                    SessionFlash::set('added', 'Votre commande a bien été prise en compte.');
                    header('Location: /');
                    exit;
                } catch (\Throwable $th) {
                    $pdo->rollBack();
                    SessionFlash::set('error', 'Votre commande n\'a pas été prise en compte.');
                    echo $th->getMessage();
                    header('Location: /');
                    exit;
                }
            }
        }
    }

    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/home.php');
    include(__DIR__ . '/../views/templates/footer.php');