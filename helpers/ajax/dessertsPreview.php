<?php

	require_once(__DIR__.'/../../models/Dish.php');

	$desserts = Dish::getLast('desserts');
	echo json_encode($desserts);