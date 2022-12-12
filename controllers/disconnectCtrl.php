<?php

	if(isset($_SESSION['user'])){
		unset($_SESSION['user']);
		header('Location: /');
		exit();
	} else {
		header('Location: /');
		exit();
	}