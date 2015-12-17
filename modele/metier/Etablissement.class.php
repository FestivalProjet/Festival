<?php

	namespace modele\metier;

	class Etablissement {

		public $id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $type, $civiliteResponsable, $nomResponsable, $prenomResponsable;

		public function __construct ($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $type, $civiliteResponsable, $nomResponsable, $prenomResponsable) {

			$this -> ID = $id;
			$this -> nom = $nom;
			$this -> adresseRue = $adresseRue;
			$this -> codePostal = $codePostal;
			$this -> ville = $ville;
			$this -> tel = $tel;
			$this -> adresseElectronique = $adresseElectronique;
			$this -> type = $type;
			$this -> civiliteResponsable = $civiliteResponsable;
			$this -> nomResponsable = $nomResponsable;
			$this -> prenomResponsable = $prenomResponsable;

		}

		public function getID () {
			return $this -> ID;
		}

		public function getNom () {
			return $this -> nom;
		}

		public function getAdresseRue () {
			return $this -> adresseRue;
		}

		public function getCodePostal () {
			return $this -> codePostal;
		}

		public function getVille () {
			return $this -> ville;
		}

		public function getTel () {
			return $this -> tel;
		}

		public function getAdressseElectronique () {
			return $this -> adresseElectronique;
		}

		public function getTypeEtab () {
			return $this -> type;
		}

		public function getCiviliteResponsable () {
			return $this -> civiliteResponsable;
		}

		public function getNomResponsable () {
			return $this -> nomResponsable;
		}

		public function getPrenomResponsable () {
			return $this -> prenomResponsable;
		}

		public function setID ($id) {
			$this -> ID = $id;
		}

		public function setNom ($nom) {
			$this -> nom = $nom;
		}

		public function setAdresseRue ($adresseRue) {
			$this -> adresseRue = $adresseRue;
		}

		public function setCodePostal ($codePostal) {
			$this -> codePostal = $codePostal;
		}

		public function setVille ($ville) {
			$this -> ville = $ville;
		}

		public function setTel ($tel) {
			$this -> tel = $tel;
		}

		public function setAdresseElectronique ($adresseElectronique) {
			$this -> adresseElectronique = $adresseElectronique;
		}

		public function setTypeEtab ($type) {
			$this -> type = $type;
		}

		public function setCiviliteResponsable ($civiliteResponsable) {
			$this -> civiliteResponsable = $civiliteResponsable;
		}

		public function setNomResponsable ($nomResponsable) {
			$this -> nomResponsable = $nomResponsable;
		}

		public function setPrenomResponsable ($prenomResponsable) {
			$this -> prenomResponsable = $prenomResponsable;
		}

		public function __toString () {

			$etat = "ID : " . $this -> getID () . "<br />";
			$etat .= "Nom : " . $this -> getNom () . "<br />";
			$etat .= "Adresse Rue : " . $this -> getAdresseRue () . "<br />";
			$etat .= "Code Postal : " . $this -> getCodePostal () . "<br />";
			$etat .= "Ville : " . $this -> getVille () . "<br />";
			$etat .= "Téléphone : " . $this -> getTel () . "<br />";
			$etat .= "Adresse Electronique : " . $this -> getAdressseElectronique () . "<br />";
			$etat .= "Type : " . $this -> getTypeEtab () . "<br />";
			$etat .= "Civilite du Responsable : " . $this -> getCiviliteResponsable () . "<br />";
			$etat .= "Nom du Responsable : " . $this -> getNomResponsable () . "<br />";
			$etat .= "Prenom du Responsable : " . $this -> getPrenomResponsable () . "<br />";

			return $etat;

		}

	}

?>