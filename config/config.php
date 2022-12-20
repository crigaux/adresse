<?php

define('DSN', 'mysql:host=ladressedbase.mysql.db;dbname=ladressedbase;charset=utf8');
define('USER', 'ladressedbase');
define('PWD', 'qsBRPlDA');


	// Gestion des dates et heures en français

	$formatHour = new IntlDateFormatter(
		locale: 'fr_FR',
		pattern: "HH'h'mm"
	);

	$formatDate = new IntlDateFormatter(
		locale: 'fr_FR',
		pattern: 'EEEE d MMMM yyyy'
	);

	// Définition de 'secret'

	define('SECRET', 'adresse_Restaurant753951');

	// Horaires réservations

	$slots = [
		1 => '12:00:00',
		2 => '12:30:00',
		3 => '13:00:00',
		4 => '13:30:00',
		5 => '19:00:00',
		6 => '19:30:00',
		7 => '20:00:00',
		8 => '20:30:00'
	];