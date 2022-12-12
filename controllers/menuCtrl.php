<?php
	require_once(__DIR__ . '/../models/Dish.php');

    $isOnMenu = true;
    
    $starters = Dish::getAll(1);
	$dishes = Dish::getAll(2);
	$desserts = Dish::getAll(3);

    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/menu.php');
    include(__DIR__ . '/../views/templates/footer.php');