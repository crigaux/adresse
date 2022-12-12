<?php
	require_once(__DIR__ . '/../config/Database.php');

	class Order {
		private int $id;
		private int $quantity;
		private int $id_dishes;
		private int $id_reservations;
		private object $pdo;

		public function __construct(int $quantity, int $id_dishes, int $id_reservations) {

			$this->pdo = Database::getInstance();

			$this->quantity = $quantity;
			$this->id_dishes = $id_dishes;
			$this->id_reservations = $id_reservations;
		}

		public function setQuantity(int $quantity) {
			$this->quantity = $quantity;
		}

		public function setId_dishes(int $id_dishes) {
			$this->id_dishes = $id_dishes;
		}

		public function setId_reservations(int $id_reservations) {
			$this->id_reservations = $id_reservations;
		}

		public function getQuantity():int {
			return $this->quantity;
		}

		public function getId_dishes():int {
			return $this->id_dishes;
		}

		public function getId_reservations():int {
			return $this->id_reservations;
		}

		/**
		 * Méthode permettant de créer une nouvelle commande
		 * 
		 * @return true si la commande a été créée, @return false sinon
		 */
		public function create():bool {
			$query = "INSERT INTO `orders` (`quantity`, `id_dishes`, `id_reservations`) VALUES (:quantity, :id_dishes, :id_reservations);";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':quantity', $this->quantity, PDO::PARAM_INT);
			$sth->bindValue(':id_dishes', $this->id_dishes, PDO::PARAM_INT);
			$sth->bindValue(':id_reservations', $this->id_reservations, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de récupérer toutes les commandes
		 * 
		 * @return array $orders ou false
		 */
		public static function getAll($id):array|bool {
			$pdo = Database::getInstance();

			$query = 
			"SELECT orders.id, orders.id_dishes, reservations.validated_at, users.lastname, users.phone, reservations.reservation_date, dishes.title, orders.quantity, dishes.price FROM `orders` 
			INNER JOIN reservations ON orders.id_reservations = reservations.id
			INNER JOIN dishes ON orders.id_dishes = dishes.id
			INNER JOIN users ON reservations.id_users = users.id
			WHERE reservations.id = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

		/**
		 * Méthode permettant de récupérer une commande
		 * 
		 * @return object $order ou false
		 */
		public static function get($id):object|bool {
			$pdo = Database::getInstance();

			$query = 
			"SELECT * FROM `orders` 
			INNER JOIN reservations ON `orders`.`id_reservations` = `reservations`.`id` 
			INNER JOIN users ON `reservations`.`id_users` = `users`.`id` 
			WHERE `reservations`.`id` = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetch();
			}
			return false;
		}
		/**
		 * Méthode permettant de modifier une commande
		 * 
		 * @return true si la commande a été modifiée, @return false sinon
		 */
		public function update($id):bool {
			$query = "UPDATE `orders` SET `quantity` = :quantity, `id_dishes` = :id_dishes, `id_reservations` = :id_reservations WHERE `orders`.`id` = :id;";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':quantity', $this->quantity, PDO::PARAM_INT);
			$sth->bindValue(':id_dishes', $this->id_dishes, PDO::PARAM_INT);
			$sth->bindValue(':id_reservations', $this->id_reservations, PDO::PARAM_INT);
			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}

		/**
		 * Méthode permettant de supprimer une commande
		 * 
		 * @return true si la commande a été supprimée, @return false sinon
		 */
		public static function delete(int $id):bool {
			$pdo = Database::getInstance();

			$query = "DELETE FROM `orders` WHERE `orders`.`id` = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}

		/**
		 * Méthode permettant de récupérer les commandes d'un utilisateur
		 * 
		 * @return array $order
		 */
		public static function getByUser(int $id):array {
			$pdo = Database::getInstance();

			$query = 
			"SELECT `orders`.`id`, `orders`.`id_dishes`, `reservations`.`validated_at`, `users`.`id` AS `id_user`, `users`.`lastname`, `users`.`phone`, `reservations`.`reservation_date`, `dishes`.`title`, `orders`.`quantity`, `dishes`.`price` FROM `orders` 
			INNER JOIN reservations ON `orders`.`id_reservations` = `reservations`.`id`
			INNER JOIN dishes ON `orders`.`id_dishes` = `dishes`.`id`
			INNER JOIN users ON `reservations`.`id_users` = `users`.`id`
			WHERE `users`.`id` = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

		/**
		 * Méthode permettant de récupérer les commandes d'une réservation
		 * 
		 * @return array $order
		 */
		public static function getByReservation(int $id):array {
			$pdo = Database::getInstance();

			$query = 
			"SELECT orders.id, reservations.validated_at, users.lastname, users.phone, reservations.reservation_date, dishes.title, orders.quantity, dishes.price FROM `orders` 
			INNER JOIN reservations ON orders.id_reservations = reservations.id
			INNER JOIN dishes ON orders.id_dishes = dishes.id
			INNER JOIN users ON reservations.id_users = users.id
			WHERE reservations.id = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}
	}