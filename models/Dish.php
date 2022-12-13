<?php
	require_once(__DIR__ . '/../config/Database.php');

	class Dish {
		private int $id;
		private string $title;
		private string $price;
		private string $description;
		private int $active;
		private int $id_users;
		private int $id_dishes_types;
		private int $image;
		private int $togo;

		private PDO $pdo;

		public function __construct($title, $price, $description, $id_users, $id_dishes_types, $image, $active = 1, $togo = 0) {

			$this->pdo = Database::getInstance();

			$this->title = $title;
			$this->price = $price;
			$this->description = $description;
			$this->active = $active;
			$this->image = $image;
			$this->togo = $togo;
			$this->id_users = $id_users;
			$this->id_dishes_types = $id_dishes_types;
		}

		public function setTitle(string $title) {
			$this->title = $title;
		}
		public function setPrice(float $price) {
			$this->price = $price;
		}
		public function setDescription(string $description) {
			$this->description = $description;
		}
		public function setActive(bool $active) {
			$this->active = $active;
		}
		public function setId_users(int $id_users) {
			$this->id_users = $id_users;
		}
		public function setId_dishes_types(int $id_dishes_types) {
			$this->id_dishes_types = $id_dishes_types;
		}

		public function getTitle():string {
			return $this->title;
		}
		public function getPrice():float {
			return $this->price;
		}
		public function getDescription():string {
			return $this->description;
		}
		public function getActive():bool {
			return $this->active;
		}
		public function getId_users():int {
			return $this->id_users;
		}
		public function getId_dishes_types():int {
			return $this->id_dishes_types;
		}

		/**
		 * Méthode permettant de créer un nouveau plat
		 * 
		 * @return true si l'avis a été créé, @return false sinon
		 */
		public function create() {
			$query = 
			"INSERT INTO `dishes` (`title`, `price`, `description`, `active`, `id_users`, `id_dishes_types`, `image`, `togo`) 
			VALUES (:title, :price, :description, :active, :id_users, :id_dishes_types, :image, :togo);";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':title', $this->title);
			$sth->bindValue(':price', $this->price);
			$sth->bindValue(':description', $this->description);
			$sth->bindValue(':active', $this->active, PDO::PARAM_BOOL);
			$sth->bindValue(':image', $this->image, PDO::PARAM_INT);
			$sth->bindValue(':togo', $this->togo, PDO::PARAM_BOOL);
			$sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
			$sth->bindValue(':id_dishes_types', $this->id_dishes_types, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() >= 0) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de récupérer tous les plats
		 * 
		 * @return array ou @return false si aucun plat n'a été trouvé
		 */
		public static function getAll(int $type = NULL):array|false {
			$pdo = Database::getInstance();
			if($type == NULL) {
				$query = "SELECT * FROM `dishes`";
				$sth = $pdo->prepare($query);
			} else {
				$query = "SELECT * FROM `dishes` WHERE `id_dishes_types` = :id_dishes_types ORDER BY `id_dishes_types`;";
				$sth = $pdo->prepare($query);
				$sth->bindValue(':id_dishes_types', $type, PDO::PARAM_INT);
			}
			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

		// Méthode permettant de récupérer les plats à emporter
		public static function getTakeAway():array|false {
			$pdo = Database::getInstance();
			$query = "SELECT * FROM `dishes` WHERE `togo` = 1 ORDER BY `id_dishes_types`;";
			$sth = $pdo->prepare($query);
			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

		/**
		 * Récupère les 3 derniers plats en fonction du type
		 * 
		 * @param string $type
		 * 
		 * @return array
		 */
		public static function getLast(string $type):array|false {
			$pdo = Database::getInstance();
			if($type == 'starters') {
				$query = "SELECT * FROM `dishes` WHERE `id_dishes_types` = 6 AND `active` = 2 ORDER BY `id` DESC LIMIT 3;";
				$sth = $pdo->prepare($query);
			} else if($type == 'dishes') {
				$query = "SELECT * FROM `dishes` WHERE `id_dishes_types` = 12 AND `active` = 2 ORDER BY `id` DESC LIMIT 3;";
				$sth = $pdo->prepare($query);
			} else if($type == 'desserts') {
				$query = "SELECT * FROM `dishes` WHERE `id_dishes_types` = 15 AND `active` = 2 ORDER BY `id` DESC LIMIT 3;";
				$sth = $pdo->prepare($query);
			}
			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

		/**
		 * Méthode permettant de récupérer un plat avec son id
		 * 
		 * @return object si le plat existe, @return false sinon
		 */
		public static function getById(int $id):object|false {
			$pdo = Database::getInstance();

			$query = "SELECT * FROM `dishes` WHERE `id` = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetch();
			}
			return false;
		}

		/**
		 * Méthode permettant de modifier un plat
		 * 
		 * @return true si le plat a été modifié, @return false sinon
		 */
		public function update($id):bool {
			$query = 
			"UPDATE `dishes` 
			SET `title` = :title, `price` = :price, `description` = :description, `active` = :active, `id_users` = :id_users, `id_dishes_types` = :id_dishes_types, `image` = :image 
			WHERE `id` = :id;";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':title', $this->title);
			$sth->bindValue(':price', $this->price);
			$sth->bindValue(':description', $this->description);
			$sth->bindValue(':active', $this->active, PDO::PARAM_INT);
			$sth->bindValue(':image', $this->image, PDO::PARAM_INT);
			$sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
			$sth->bindValue(':id_dishes_types', $this->id_dishes_types, PDO::PARAM_INT);
			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}

		/**
		 * Méthode permettant de supprimer un plat
		 * 
		 * @return true si le plat a été supprimé, @return false sinon
		 */
		public static function delete(int $id):bool {
			$pdo = Database::getInstance();

			$query = "DELETE FROM `dishes` WHERE `id` = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}

		/**
		 * Méthode pour récupérer tous les types de plats
		 * @return int
		 */
		public static function dishTypes():int {
			$pdo = Database::getInstance();

			$query = "SELECT COUNT(*) AS typesNb FROM `dishes_types`;";

			if($sth = $pdo->query($query)) {
				return $sth->fetch()->typesNb;
			}
			return false;
		}

		/**
		 * Méthode pour récupérer le nom d'un type de plat
		 * 
		 * @param int $id
		 * 
		 * @return string
		 */
		public static function dishTypeName(int $id):string|false {
			$pdo = Database::getInstance();

			$query = "SELECT `type` FROM `dishes_types` WHERE `id` = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetch()->type ?? false;
			}
			return false;
		}

		/**
		 * Méthode pour récupérer l'id du premier type de plat
		 * 
		 * @return int
		 */
		public static function firstDishType():int|false {
			$pdo = Database::getInstance();

			$query = "SELECT `id` FROM `dishes_types` ORDER BY `id` ASC LIMIT 1;";

			if($sth = $pdo->query($query)) {
				return $sth->fetch()->id ?? false;
			}
			return false;
		}
	}