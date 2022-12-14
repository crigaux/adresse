<?php

	require_once(__DIR__.'/../../models/Dish.php');

	$starters = Dish::getLast('starters');
	
	echo json_encode($starters);