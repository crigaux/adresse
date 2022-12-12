<?php

	// define('DSN', 'mysql:host=localhost;dbname=annexe;charset=utf8');
	// define('USER', 'annexe_user');
	// define('PWD', 'UIeO.E73q60e8C(W');

	define('DSN', 'mysql:host=127.0.0.1:3306;dbname=u993442228_annexe;charset=utf8');
	define('USER', 'u993442228_admin');
	define('PWD', 'Luckydube76260,;:!');

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

	define('SECRET', 'Annexe_Restaurant753951');