<?php
	require_once(__DIR__ . '/../models/Dish.php');

    $isOnMenu = true;
    
    $typesOfDishes = Dish::dishTypes();
    $allDishes = Dish::getAll();


    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/menu.php');
    include(__DIR__ . '/../views/templates/footer.php');