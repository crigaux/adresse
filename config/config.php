<?php

	define('DSN', 'mysql:host=localhost;dbname=adresse;charset=utf8');
	define('USER', 'annexe_admin');
	define('PWD', ']QbMEVFWOFDcVfQA');

	// define('DSN', 'mysql:host=127.0.0.1:3306;dbname=u993442228_adresse;charset=utf8');
	// define('USER', 'u993442228_admin');
	// define('PWD', 'Luckydube76260,;:!');

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