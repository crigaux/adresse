<?php
    require_once(__DIR__ . '/../models/User.php');
    require_once(__DIR__ . '/../config/regex.php');
    require_once(__DIR__ . '/../helpers/testInputs.php');
    require_once(__DIR__ . '/../helpers/SessionFlash.php');

    if(isset($_SESSION['user'])) {
        header('Location: /');
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        if(testInput($email, MAIL_REGEX) != 'true') {
            $errors['email'] = testInput($email, MAIL_REGEX);
        }

        $password = $_POST['password'];

        if(User::isExist($email) == true) {
            if(User::get(NULL, $email)->validated_at == NULL) {
                $errors['email'] = 'Votre compte n\'a pas été validé';
            } else {
                if(User::passwordVerification($email) != false){
                    $hash = User::passwordVerification($email);
        
                    if(password_verify($password, $hash) == true) {
                        $user = User::get(email: $email);
                        $user->password = NULL;
                        $_SESSION['user'] = $user;
                        header('Location: /');
                        exit();
                    } else {
                        $errors['password'] = 'Mot de passe incorrect';
                    }
                } else {
                    $errors['email'] = 'Email ou mot de passe incorrect';
                }
            }
        } else {
            $errors['email'] = 'Cet email n\'existe pas';
        }
    }

    include(__DIR__ . '/../views/templates/nav.php');
    include(__DIR__ . '/../views/connection.php');