<?php

	require_once(__DIR__.'/../../models/Dish.php');

	$dishes = Dish::getAll();
	echo json_encode($dishes);