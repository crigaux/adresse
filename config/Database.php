<?php
	require_once(__DIR__ . '/config.php');

	class Database {
		private static $pdo;

		public static function getInstance(){
			if(is_null(self::$pdo)) {
				try{
					self::$pdo = new PDO(DSN, USER, PWD);
					self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				}catch (Exception $error) {
					return ('Erreur : ' . $error->getMessage());
				}
			}
			return self::$pdo;
		}
	}