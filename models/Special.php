<?php
	require_once(__DIR__ . '/../config/Database.php');

	class Special {
		private int $id;
		private string $title;
		private string $description;
		private string $price;
		private int $type;
		private string $datetime;
		private int $active;
		private int $image;

		private PDO $pdo;

		public function __construct($title, $description, $price, $type, $datetime, $image, $active = 0) {

			$this->pdo = Database::getInstance();

			$this->title = $title;
			$this->description = $description;
			$this->price = $price;
			$this->type = $type;
			$this->datetime = $datetime;
			$this->image = $image;
			$this->active = $active;
		}

		public function setTitle(string $title) {
			$this->title = $title;
		}
		public function setDescription(string $description) {
			$this->description = $description;
		}
		public function setPrice(float $price) {
			$this->price = $price;
		}
		public function setType(int $type) {
			$this->type = $type;
		}
		public function setDatetime(string $datetime) {
			$this->datetime = $datetime;
		}
		public function setImage(int $image) {
			$this->image = $image;
		}
		public function setActive(int $active) {
			$this->active = $active;
		}

		public function getTitle():string {
			return $this->title;
		}
		public function getDescription():string {
			return $this->description;
		}
		public function getPrice():float {
			return $this->price;
		}
		public function getType():int {
			return $this->type;
		}
		public function getDatetime():string {
			return $this->datetime;
		}
		public function getImage():int {
			return $this->image;
		}
		public function getActive():int {
			return $this->active;
		}

		public function create() {
			$sql = "INSERT INTO `ardoises` (`title`, `description`, `price`, `type`, `datetime`, `image`, `active`) VALUES (:title, :description, :price, :type, NOW(), :image, :active)";
			$sth = $this->pdo->prepare($sql);
			$sth->bindValue(':title', $this->title, PDO::PARAM_STR);
			$sth->bindValue(':description', $this->description, PDO::PARAM_STR);
			$sth->bindValue(':price', $this->price);
			$sth->bindValue(':type', $this->type, PDO::PARAM_INT);
			$sth->bindValue(':image', $this->image, PDO::PARAM_INT);
			$sth->bindValue(':active', $this->active, PDO::PARAM_INT);
			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}

		public function update($id) {
			$sql = "UPDATE `ardoises` SET `title` = :title, `description` = :description, `price` = :price, `type` = :type, `datetime` = :datetime, `image` = :image, `active` = :active WHERE id = :id;";
			$sth = $this->pdo->prepare($sql);
			$sth->bindValue(':title', $this->title, PDO::PARAM_STR);
			$sth->bindValue(':description', $this->description, PDO::PARAM_STR);
			$sth->bindValue(':price', $this->price);
			$sth->bindValue(':type', $this->type, PDO::PARAM_INT);
			$sth->bindValue(':datetime', $this->datetime, PDO::PARAM_STR);
			$sth->bindValue(':image', $this->image, PDO::PARAM_INT);
			$sth->bindValue(':active', $this->active, PDO::PARAM_INT);
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
		}

		public static function delete($id) {	
			$pdo = Database::getInstance();
			$sql = "DELETE FROM `ardoises` WHERE `id` = :id;";
			$sth = $pdo->prepare($sql);
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}

		public static function getAll($type) {
			$pdo = Database::getInstance();
			if($type == '') {
				$sql = "SELECT * FROM `ardoises`";
				$sth = $pdo->prepare($sql);
			} else {
				$sql = "SELECT * FROM `ardoises` WHERE `type` = :type";
				$sth = $pdo->prepare($sql);
				$sth->bindValue(':type', $type, PDO::PARAM_INT);
			}
			$sth->execute();
			$ardoises = $sth->fetchAll();
			return $ardoises;
		}

		public static function specialTypeName($type) {
			switch ($type) {
				case 1:
					return 'Entrée';
					break;
				case 2:
					return 'Plat';
					break;
				case 3:
					return 'Dessert';
					break;
				default:
					return 'Type inconnu';
					break;
			}
		}

		// methode pour récupérer une ardoise en fonction de son id
		public static function get($id) {
			$pdo = Database::getInstance();
			$sql = "SELECT * FROM `ardoises` WHERE `id` = :id";
			$sth = $pdo->prepare($sql);
			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->execute();
			$ardoise = $sth->fetch();
			return $ardoise;
		}

		// methode pour récupérer les ardoises en fonction d'un filtre
		public static function getFilter($filter, $type) {
			$pdo = Database::getInstance();
			$sql = "SELECT * FROM `ardoises` WHERE `type` = :type AND `title` LIKE :filter";
			$sth = $pdo->prepare($sql);
			$sth->bindValue(':type', $type, PDO::PARAM_INT);
			$sth->bindValue(':filter', '%'.$filter.'%', PDO::PARAM_STR);
			$sth->execute();
			$ardoises = $sth->fetchAll();
			return $ardoises;
		}
	}