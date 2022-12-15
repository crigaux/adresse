<?php
	require_once(__DIR__ . '/../models/Dish.php');

    $isOnMenu = true;
    
    $firstDishType = Dish::firstDishType();
    $typesOfDishes = Dish::dishTypes() + $firstDishType;
    
    include(__DIR__ . '/../views/templates/headerTablette.php');
    include(__DIR__ . '/../views/tablet.php');
    include(__DIR__ . '/../views/templates/footerTablette.php');