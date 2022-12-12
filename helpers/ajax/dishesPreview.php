<?php

	require_once(__DIR__.'/../../models/Dish.php');

	$dishes = Dish::getLast('dishes');
	echo json_encode($dishes);