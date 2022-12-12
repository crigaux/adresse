<?php
	require_once(__DIR__ . '/../config/Database.php');

	class User {
		private int $id;
		private string $lastname;
		private string $firstname;
		private string $email;
		private string $password;
		private string $phone;
		private bool $admin;
		private bool $newsletter;
		private string $created_at;
		private string $validated_at;
		private object $pdo;

		public function __construct($lastname, $firstname, $email, $phone, $admin, $newsletter) {
			$this->pdo = Database::getInstance();

			$this->lastname = $lastname;
			$this->firstname = $firstname;
			$this->email = $email;
			$this->phone = $phone;
			$this->admin = $admin;
			$this->newsletter = $newsletter;
		}

		public function setId($id) {
			$this->id = $id;
		}
		public function setLastname($lastname) {
			$this->lastname = $lastname;
		}
		public function setFirstname($firstname) {
			$this->firstname = $firstname;
		}
		public function setEmail($email) {
			$this->email = $email;
		}
		public function setPassword($password) {
			$this->password = $password;
		}
		public function setPhone($phone) {
			$this->phone = $phone;
		}
		public function setAdmin($admin) {
			$this->admin = $admin;
		}
		public function setNewsletter($newsletter) {
			$this->newsletter = $newsletter;
		}
		public function setValidated_at($validated_at) {
			$this->validated_at = $validated_at;
		}

		public function getId() {
			return $this->id;
		}
		public function getLastname() {
			return $this->lastname;
		}
		public function getFirstname() {
			return $this->firstname;
		}
		public function getEmail() {
			return $this->email;
		}
		public function getPassword() {
			return $this->password;
		}
		public function getPhone() {
			return $this->phone;
		}
		public function getAdmin() {
			return $this->admin;
		}
		public function getNewsletter() {
			return $this->newsletter;
		}
		public function getCreated_at() {
			return $this->created_at;
		}
		public function getValidated_at() {
			return $this->validated_at;
		}

		/**
		 * Méthode de création d'un utilisateur
		 *
		 * @return true si l'utilisateur a bien été créé, @return false sinon
		 *
		 */
		public function create():bool{
			$sql = 
			"INSERT INTO `users` (`lastname`, `firstname`, `email`, `password`, `phone`, `admin`, `newsletter`) 
			VALUES (:lastname, :firstname, :email, :password, :phone, :admin, :newsletter);";

			$sth = $this->pdo->prepare($sql);

			$sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
			$sth->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
			$sth->bindValue(':email', $this->email, PDO::PARAM_STR);
			$sth->bindValue(':password', $this->password, PDO::PARAM_STR);
			$sth->bindValue(':phone', $this->phone, PDO::PARAM_STR);
			$sth->bindValue(':admin', $this->admin, PDO::PARAM_BOOL);
			$sth->bindValue(':newsletter', $this->newsletter, PDO::PARAM_BOOL);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode de récupération d'un utilisateur
		 *	
		 * @param int $id
		 * 
		 * @return PDOStatement si l'utilisateur existe, @return false sinon.
		 *
		 */
		public static function get(int $id = NULL, string $email = NULL):mixed {
			if($id != NULL && $email == NULL) {
				$sql = "SELECT * FROM `users` WHERE `id` = :id;";
	
				$pdo = Database::getInstance();
				$sth = $pdo->prepare($sql);
	
				$sth->bindValue(':id', $id, PDO::PARAM_INT);
			} else if ($email != NULL && $id == NULL) {
				$sql = "SELECT * FROM `users` WHERE `email` = :email;";
	
				$pdo = Database::getInstance();
				$sth = $pdo->prepare($sql);
	
				$sth->bindValue(':email', $email);
			} else {
				return false;
			}

			if($sth->execute()) {
				return $sth->fetch();
			}
		}

		/**
		 * Méthode de récupération de tous les utilisateurs
		 *
		 * @return array si il y a des utilisateurs, @return false sinon.
		 *
		 */
		public static function getAll($search = ''):mixed {
			$pdo = Database::getInstance();
			if($search == '') {
				$sql = "SELECT * FROM `users`;";
				$sth = $pdo->prepare($sql);
			} else {
				$sql = "SELECT * FROM `users` WHERE `lastname` LIKE :search OR `firstname` LIKE :search OR `email` LIKE :search;";
				$sth = $pdo->prepare($sql);
				$sth->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
			}
			if($sth->execute()) {
				return $sth->fetchAll();
			}
		}

		/**
		 * Méthode de mise à jour d'un utilisateur
		 *
		 * @param int $id
		 * 
		 * @return true si l'utilisateur a bien été mis à jour, @return false sinon
		 *
		 */
		public function update($id):bool {
			$sql = 
			"UPDATE `users` 
			SET `lastname` = :lastname, `firstname` = :firstname, `email` = :email, `phone` = :phone, `admin` = :admin, `newsletter` = :newsletter 
			WHERE `id` = :id;";

			$sth = $this->pdo->prepare($sql);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
			$sth->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
			$sth->bindValue(':email', $this->email, PDO::PARAM_STR);
			$sth->bindValue(':phone', $this->phone, PDO::PARAM_STR);
			$sth->bindValue(':admin', $this->admin, PDO::PARAM_BOOL);
			$sth->bindValue(':newsletter', $this->newsletter, PDO::PARAM_BOOL);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode de suppression d'un utilisateur
		 *
		 * @param int $id
		 * 
		 * @return true si l'utilisateur a bien été supprimé, @return false sinon
		 *
		 */
		public static function delete(int $id):bool {
			$sql = "DELETE FROM `users` WHERE `id` = :id;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($sql);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode de validation d'un utilisateur
		 *
		 * @param int $id
		 * 
		 * @return true si l'utilisateur a bien été validé, @return false sinon
		 *
		 */
		public static function validate(int $id):bool {
			$sql = "UPDATE `users` SET `validated_at` = NOW() WHERE `id` = :id;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($sql);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode de récupération d'un utilisateur par son email
		 *
		 * @param string $email
		 * 
		 * @return true si l'utilisateur existe, @return false sinon.
		 *
		 */
		public static function isExist(string $email):bool {
			$sql = "SELECT * FROM `users` WHERE `email` = :email;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($sql);

			$sth->bindValue(':email', $email, PDO::PARAM_STR);

			if($sth->execute()) {
				if($sth->fetch() != false) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Méthode permettant de récupérer le mot de passe d'un utilisateur en fonction de son email
		 *
		 * @param string $email
		 * 
		 * @return string (le mot de passe) si l'email existe, @return false sinon.
		 *
		 */
		public static function passwordVerification(string $email):mixed {
			$sql = "SELECT `password` FROM `users` WHERE `email` = :email;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($sql);

			$sth->bindValue(':email', $email, PDO::PARAM_STR);

			if($sth->execute()) {
				$object = $sth->fetch();
				return $object->password;
			}
		}

		/**
		 * Méthode permettant de vérifier si un id existe et de valider le compte correspondant
		 *
		 * @param int $id
		 * 
		 * @return true si le compte existe et a été vérifié, @return false sinon.
		 *
		 */
		public static function idExist(int $id):bool {
			$sql = "SELECT * FROM `users` WHERE `id` = :id;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($sql);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				if($sth->fetch() != false) {
					return true;
				}
			}
			return false;
		}
		
		/**
		 * Méthode de réinitialisation du mot de passe
		 * 
		 * @param int $id
		 * @param string $password
		 * 
		 * @return bool
		 */
		public static function resetPassword(int $id, string $password):bool {
			$sql = "UPDATE `users` SET `password` = :password WHERE `id` = :id;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($sql);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->bindValue(':password', $password, PDO::PARAM_STR);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}
}