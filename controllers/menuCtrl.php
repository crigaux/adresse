<?php
	require_once(__DIR__ . '/../models/Dish.php');

    $isOnMenu = true;
    
    $firstDishType = Dish::firstDishType();
    $typesOfDishes = Dish::dishTypes() + $firstDishType;
    
    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/menu.php');
    include(__DIR__ . '/../views/templates/footer.php');