<?php
    require_once(__DIR__ . '/../helpers/SessionFlash.php');
    require_once(__DIR__ . '/../models/Review.php');

    $isOnReview = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
        $review = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS));

        $errors = [];

        if(empty($title)) {
            $errors['title'] = 'Veuillez renseigner un titre.';
        }
        if(empty($review)) {
            $errors['review'] = 'Veuillez renseigner un avis.';
        }

        if(empty($errors)) {
            $review = new Review($title, $review, $_SESSION['user']->id, NULL);
            $review->create();
            SessionFlash::set('message', 'Votre avis a bien été ajouté.');
            header('Location: /commentaires');
            exit;
        } else {
            SessionFlash::set('error', 'Votre avis n\'a pas pu être ajouté.');
            header('Location: /commentaires');
            exit;
        }
    }

    $reviews = Review::getAllModerated();

    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/review.php');
    include(__DIR__ . '/../views/templates/footer.php');