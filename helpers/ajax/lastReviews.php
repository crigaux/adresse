<?php

	require_once(__DIR__.'/../../models/Review.php');

	$reviews = Review::getLast();
	echo json_encode($reviews);