<?php
	require_once(__DIR__ . '/../models/Dish.php');
    require_once(__DIR__ . '/../models/Special.php');
    require_once(__DIR__ . '/../models/Drink.php');

    $isOnMenu = true;
    
    $firstDishType = Dish::firstDishType();
    $typesOfDishes = Dish::dishTypes() + $firstDishType;
    $firstDrinkType = Drink::firstDrinkType();
    $typesOfDrinks = Drink::drinkTypes();
    $ardoiseDishes = Special::getAllActive();
    
    include(__DIR__ . '/../views/templates/headerTablette.php');
    include(__DIR__ . '/../views/tablet.php');
    include(__DIR__ . '/../views/templates/footerTablette.php');