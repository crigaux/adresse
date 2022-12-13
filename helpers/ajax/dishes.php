<?php

	require_once(__DIR__.'/../../models/Dish.php');

	$dishes = Dish::getTakeAway();

	echo json_encode($dishes);