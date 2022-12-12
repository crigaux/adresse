<?php
	require_once(__DIR__ . '/../config/Database.php');

	class Review {
		private int $id;
		private string $title;
		private string $content;
		private string|NULL $moderated_at;
		private int $id_users;
		private object $pdo;

		public function __construct(string $title, string $content, int $id_users, string|NULL $moderated_at = NULL) {
			$this->pdo = Database::getInstance();

			$this->title = $title;
			$this->content = $content;
			$this->id_users = $id_users;
			$this->moderated_at = $moderated_at;
		}

		public function setId(int $id) {
			$this->id = $id;
		}
		public function setContent(string $content) {
			$this->content = $content;
		}
		public function setModerated_at(string $moderated_at) {
			$this->moderated_at = $moderated_at;
		}
		public function setId_users(int $id_users) {
			$this->id_users = $id_users;
		}

		public function getId():int {
			return $this->id;
		}
		public function getContent():string {
			return $this->content;
		}
		public function getModerated_at():string {
			return $this->moderated_at;
		}
		public function getId_users():int {
			return $this->id_users;
		}

		/**
		 * Méthode permettant de créer un nouvel avis
		 * 
		 * @return true si l'avis a été créé, @return false sinon
		 */
		public function create():bool {
			$query = 
			"INSERT INTO `reviews` (`title`, `content`, `id_users`) 
			VALUES (:title, :content, :id_users);";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':title', $this->title, PDO::PARAM_STR);
			$sth->bindValue(':content', $this->content, PDO::PARAM_STR);
			$sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de récupérer tous les avis et les trier par date de validation
		 * 
		 * @return array si les avis ont été récupérés, @return false sinon
		 */
		public static function getAll():mixed {
			$query = 
			"SELECT `reviews`.`id`, `reviews`.`title`, `reviews`.`content`, `reviews`.`moderated_at`, `users`.`firstname`, `users`.`lastname`, `users`.`email` FROM `reviews` 
			INNER JOIN `users` ON `reviews`.`id_users` = `users`.`id`
			ORDER BY `reviews`.`moderated_at`;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

				/**
		 * Méthode permettant de récupérer tous les avis et les trier par date de validation
		 * 
		 * @return array si les avis ont été récupérés, @return false sinon
		 */
		public static function getAllModerated():mixed {
			$query = 
			"SELECT `reviews`.`id`, `reviews`.`title`, `reviews`.`content`, `reviews`.`moderated_at`, `users`.`firstname`, `users`.`lastname`, `users`.`email` FROM `reviews` 
			INNER JOIN `users` ON `reviews`.`id_users` = `users`.`id`
			WHERE `reviews`.`moderated_at` IS NOT NULL
			ORDER BY `reviews`.`moderated_at`;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

		/**
		 * Méthode permettant de récupérer un avis en fonction de son id
		 * 
		 * @param $id identifiant de l'avis
		 * 
		 * @return object si l'avis a été récupéré, @return false sinon
		 */
		public static function get(int $id):mixed {
			$query = 
			"SELECT `reviews`.`id`, `reviews`.`title`, `reviews`.`content`, `reviews`.`id_users`, `reviews`.`moderated_at`, `users`.`firstname`, `users`.`lastname`, `users`.`email` FROM `reviews` 
			INNER JOIN `users` ON `reviews`.`id_users` = `users`.`id`
			WHERE `reviews`.`id` = :id;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetch();
			}
			return false;
		}

		/**
		 * Récupère les 3 derniers avis
		 * 
		 * @return array
		 */
		public static function getLast():array|bool {
			$query =
			"SELECT `reviews`.`id`, `reviews`.`title`, `reviews`.`content`, `users`.`firstname` FROM `reviews`
			INNER JOIN `users` ON `reviews`.`id_users` = `users`.`id`
			WHERE `reviews`.`moderated_at` IS NOT NULL
			ORDER BY `reviews`.`moderated_at` DESC
			LIMIT 3;";

			$pdo = Database::getInstance();

			$sth = $pdo->prepare($query);

			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

		/**
		 * Méthode permettant de modifier un avis
		 * 
		 * @return true si l'avis a été modifié, @return false sinon
		 */
		public function update($id):bool {
			$query = 
			"UPDATE `reviews` 
			SET `title` = :title, `content` = :content, `moderated_at` = :moderated_at, `id_users` = :id_users 
			WHERE `reviews`.`id` = :id;";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':title', $this->title, PDO::PARAM_STR);
			$sth->bindValue(':content', $this->content, PDO::PARAM_STR);
			$sth->bindValue(':moderated_at', $this->moderated_at, PDO::PARAM_STR);
			$sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de supprimer un avis
		 * 
		 * @return true si l'avis a été supprimé, @return false sinon
		 */
		public static function delete(int $id):bool {
			$query = 
			"DELETE FROM `reviews` 
			WHERE `reviews`.`id` = :id;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de modérer un avis
		 * 
		 * @return true si l'avis a été modéré, @return false sinon
		 */
		public static function moderate(int $id):bool {
			$query = 
			"UPDATE `reviews` 
			SET `moderated_at` = NOW() 
			WHERE `reviews`.`id` = :id;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de récupérer tous les avis d'un utilisateur
		 * 
		 * @param $id_users identifiant de l'utilisateur
		 * 
		 * @return array si les avis ont été récupérés, @return false sinon
		 */
		public static function getByUser(int $id_users):array|bool {
			$query = 
			"SELECT `reviews`.`title`, `reviews`.`content`, `reviews`.`id`, `reviews`.`moderated_at` FROM `reviews`
			INNER JOIN `users` ON `reviews`.`id_users` = `users`.`id`
			WHERE `reviews`.`id_users` = :id_users
			ORDER BY `reviews`.`moderated_at` DESC;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id_users', $id_users, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}
	}