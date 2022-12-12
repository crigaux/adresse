<?php

	class SessionFlash {

		/**
		 * Méthode pour initialiser un message flash
		 * 
		 * @param string $key
		 * @param string $value
		 * 
		 * @return void
		 */
		public static function set(string $key, string $value):void {
			$_SESSION[$key] = $value;
		}

		/**
		 * Méthode pour récupérer un message flash
		 * 
		 * @param string $key
		 * 
		 * @return string
		 */
		public static function get(string $key):string {
			if(self::exist($key)){
				$value = $_SESSION[$key];
				self::delete($key);
				return $value;
			}
			return '';
		}

		/**
		 * Méthode pour supprimer un message flash
		 * 
		 * @param string $key
		 * 
		 * @return void
		 */
		public static function delete(string $key):void {
			unset($_SESSION[$key]);
		}

		/**
		 * Méthode pour vérifier si un message flash existe
		 * 
		 * @param string $key
		 * 
		 * @return bool
		 */
		public static function exist(string $key):bool {
			return isset($_SESSION[$key]);
		}
	}