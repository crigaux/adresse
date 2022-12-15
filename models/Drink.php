<?php

require_once(__DIR__ . '/../config/Database.php');

class Drink {

	private int $id;
	private string $titre;
	private string $description;
	private string $provenance;
	private string $appellation;
	private int $type;
	private string $prix;
	private string $prix_bouteille;
	private string $prix_demibouteille;
	private string $prix_verre;
	private string $prix_carafe;
	private string $prix_demicarafe;
	private int $alacarte;
	private int $image;
	private PDO $pdo;

	public function __construct($titre, $description, $provenance, $appellation, $type, $prix, $prix_bouteille, $prix_demibouteille, $prix_verre, $prix_carafe, $prix_demicarafe, $alacarte, $image) {

		$this->pdo = Database::getInstance();

		$this->titre = $titre;
		$this->description = $description;
		$this->provenance = $provenance;
		$this->appellation = $appellation;
		$this->type = $type;
		$this->prix = $prix;
		$this->prix_bouteille = $prix_bouteille;
		$this->prix_demibouteille = $prix_demibouteille;
		$this->prix_verre = $prix_verre;
		$this->prix_carafe = $prix_carafe;
		$this->prix_demicarafe = $prix_demicarafe;
		$this->alacarte = $alacarte;
		$this->image = $image;
	}

	public function setTitre(string $titre) {
		$this->titre = $titre;
	}
	public function setDescription(string $description) {
		$this->description = $description;
	}
	public function setProvenance(string $provenance) {
		$this->provenance = $provenance;
	}
	public function setAppellation(string $appellation) {
		$this->appellation = $appellation;
	}
	public function setType(int $type) {
		$this->type = $type;
	}
	public function setPrix(string $prix) {
		$this->prix = $prix;
	}
	public function setPrixBouteille(string $prix_bouteille) {
		$this->prix_bouteille = $prix_bouteille;
	}
	public function setPrixDemibouteille(string $prix_demibouteille) {
		$this->prix_demibouteille = $prix_demibouteille;
	}
	public function setPrixVerre(string $prix_verre) {
		$this->prix_verre = $prix_verre;
	}
	public function setPrixCarafe(string $prix_carafe) {
		$this->prix_carafe = $prix_carafe;
	}
	public function setPrixDemicarafe(string $prix_demicarafe) {
		$this->prix_demicarafe = $prix_demicarafe;
	}
	public function setAlacarte(int $alacarte) {
		$this->alacarte = $alacarte;
	}
	public function setImage(int $image) {
		$this->image = $image;
	}

	public function getTitre() {
		return $this->titre;
	}
	public function getDescription() {
		return $this->description;
	}
	public function getProvenance() {
		return $this->provenance;
	}
	public function getAppellation() {
		return $this->appellation;
	}
	public function getType() {
		return $this->type;
	}
	public function getPrix() {
		return $this->prix;
	}
	public function getPrixBouteille() {
		return $this->prix_bouteille;
	}
	public function getPrixDemibouteille() {
		return $this->prix_demibouteille;
	}
	public function getPrixVerre() {
		return $this->prix_verre;
	}
	public function getPrixCarafe() {
		return $this->prix_carafe;
	}
	public function getPrixDemicarafe() {
		return $this->prix_demicarafe;
	}
	public function getAlacarte() {
		return $this->alacarte;
	}
	public function getImage() {
		return $this->image;
	}

	public function create() {
		$sql = "INSERT INTO boissons (titre, description, provenance, appellation, type, prix, prix_bouteille, prix_demibouteille, prix_verre, prix_carafe, prix_demicarafe, alacarte, image) VALUES (:titre, :description, :provenance, :appellation, :type, :prix, :prix_bouteille, :prix_demibouteille, :prix_verre, :prix_carafe, :prix_demicarafe, :alacarte, :image)";
		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(':titre', $this->titre, PDO::PARAM_STR);
		$sth->bindValue(':description', $this->description, PDO::PARAM_STR);
		$sth->bindValue(':provenance', $this->provenance, PDO::PARAM_STR);
		$sth->bindValue(':appellation', $this->appellation, PDO::PARAM_STR);
		$sth->bindValue(':type', $this->type, PDO::PARAM_INT);
		$sth->bindValue(':prix', $this->prix, PDO::PARAM_STR);
		$sth->bindValue(':prix_bouteille', $this->prix_bouteille, PDO::PARAM_STR);
		$sth->bindValue(':prix_demibouteille', $this->prix_demibouteille, PDO::PARAM_STR);
		$sth->bindValue(':prix_verre', $this->prix_verre, PDO::PARAM_STR);
		$sth->bindValue(':prix_carafe', $this->prix_carafe, PDO::PARAM_STR);
		$sth->bindValue(':prix_demicarafe', $this->prix_demicarafe, PDO::PARAM_STR);
		$sth->bindValue(':alacarte', $this->alacarte, PDO::PARAM_INT);
		$sth->bindValue(':image', $this->image, PDO::PARAM_INT);

		if($sth->execute()) {
			return ($sth->rowCount() == 1) ?  true : false;
		}
		return false;
	}

	public function update() {
		$sql = "UPDATE boissons SET titre = :titre, description = :description, provenance = :provenance, appellation = :appellation, type = :type, prix = :prix, prix_bouteille = :prix_bouteille, prix_demibouteille = :prix_demibouteille, prix_verre = :prix_verre, prix_carafe = :prix_carafe, prix_demicarafe = :prix_demicarafe, alacarte = :alacarte WHERE id = :id";
		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(':titre', $this->titre, PDO::PARAM_STR);
		$sth->bindValue(':description', $this->description, PDO::PARAM_STR);
		$sth->bindValue(':provenance', $this->provenance, PDO::PARAM_STR);
		$sth->bindValue(':appellation', $this->appellation, PDO::PARAM_STR);
		$sth->bindValue(':type', $this->type, PDO::PARAM_INT);
		$sth->bindValue(':prix', $this->prix, PDO::PARAM_STR);
		$sth->bindValue(':prix_bouteille', $this->prix_bouteille, PDO::PARAM_STR);
		$sth->bindValue(':prix_demibouteille', $this->prix_demibouteille, PDO::PARAM_STR);
		$sth->bindValue(':prix_verre', $this->prix_verre, PDO::PARAM_STR);
		$sth->bindValue(':prix_carafe', $this->prix_carafe, PDO::PARAM_STR);
		$sth->bindValue(':prix_demicarafe', $this->prix_demicarafe, PDO::PARAM_STR);
		$sth->bindValue(':alacarte', $this->alacarte, PDO::PARAM_INT);
		$sth->bindValue(':id', $this->id, PDO::PARAM_INT);

		if($sth->execute()) {
			return ($sth->rowCount() == 1) ?  true : false;
		}
		return false;
	}

	public static function delete($id) {
		$pdo = Database::getInstance();
		$sql = "DELETE FROM boissons WHERE id = :id";
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
			$sql = "SELECT * FROM `boissons`";
			$sth = $pdo->prepare($sql);
		} else {
			$sql = "SELECT * FROM `boissons` WHERE `type` = :type";
			$sth = $pdo->prepare($sql);
			$sth->bindValue(':type', $type, PDO::PARAM_INT);
		}
		$sth->execute();
		return $sth->fetchAll();
	}

	public static function get($id) {
		$pdo = Database::getInstance();
		$sql = "SELECT * FROM `boissons` WHERE `id` = :id";
		$sth = $pdo->prepare($sql);
		$sth->bindValue(':id', $id, PDO::PARAM_INT);
		$sth->execute();
		$ardoise = $sth->fetch();
		return $ardoise;
	}

	public static function getTypes() {
		$pdo = Database::getInstance();
		$sql = "SELECT * FROM `types`";
		$sth = $pdo->prepare($sql);
		$sth->execute();
		$types = $sth->fetchAll();
		return $types;
	}

	public static function drinkTypes():int {
		$pdo = Database::getInstance();

		$query = "SELECT COUNT(*) AS typesNb FROM `types_de_boissons`;";

		if($sth = $pdo->query($query)) {
			return $sth->fetch()->typesNb;
		}
		return false;
	}

	public static function firstDrinkType():int|false {
		$pdo = Database::getInstance();

		$query = "SELECT `id` FROM `types_de_boissons` ORDER BY `id` ASC LIMIT 1;";

		if($sth = $pdo->query($query)) {
			return $sth->fetch()->id ?? false;
		}
		return false;
	}

	public static function drinkTypeName(int $id):string|false {
		$pdo = Database::getInstance();

		$query = "SELECT `type` FROM `types_de_boissons` WHERE `id` = :id;";

		$sth = $pdo->prepare($query);

		$sth->bindValue(':id', $id, PDO::PARAM_INT);

		if($sth->execute()) {
			return $sth->fetch()->type ?? false;
		}
		return false;
	}

	public static function getAllActive(int $type = NULL):array|false {
		$pdo = Database::getInstance();
		if($type == NULL) {
			$query = "SELECT * FROM `boissons` WHERE `active` = 1";
			$sth = $pdo->prepare($query);
		} else {
			$query = "SELECT * FROM `boissons` WHERE `type` = :type AND `alacarte` = 1 ORDER BY `type`;";
			$sth = $pdo->prepare($query);
			$sth->bindValue(':type', $type, PDO::PARAM_INT);
		}
		if($sth->execute()) {
			return $sth->fetchAll();
		}
		return false;
	}

	public static function getFilter($filter, $type) {
		$pdo = Database::getInstance();
		$sql = "SELECT * FROM `boissons` WHERE `type` = :type AND `titre` LIKE :filter";
		$sth = $pdo->prepare($sql);
		$sth->bindValue(':type', $type, PDO::PARAM_INT);
		$sth->bindValue(':filter', '%'.$filter.'%', PDO::PARAM_STR);
		$sth->execute();
		$boissons = $sth->fetchAll();
		return $boissons;
	}
}