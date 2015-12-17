<?php

	namespace modele\metier;

	class Attribution {

		private $idEtab, $idTypeChambre, $idGroupe, $nombreChambres;

		public function __construct ($idEtab, $idTypeChambre, $idGroupe, $nombreChambres) {

			$this -> IDEtab = $idEtab;
			$this -> IDTypeChambre = $idTypeChambre;
			$this -> IDGroupe = $idGroupe;
			$this -> nombreChambres = $nombreChambres;

		}

		public function getIDEtab () {
			return $this -> IDEtab;
		}

		public function getIDTypeChambre () {
			return $this -> IDTypeChambre;
		}

		public function getIDGroupe () {
			return $this -> IDGroupe;
		}

		public function getNombreChambres () {
			return $this -> nombreChambres;
		}

		public function setIDEtab ($idEtab) {
			$this -> IDEtab = $idEtab;
		}

		public function setIDTypeChambre ($idTypeChambre) {
			$this -> IDTypeChambre = $idTypeChambre;
		}

		public function setIDGroupe ($idGroupe) {
			$this -> IDGroupe = $idGroupe;
		}

		public function setNombreChambres ($nombreChambres) {
			$this -> nombreChambres = $nombreChambres;
		}

		public function __toString () {

			$etat = "ID Etablissement : " . $this -> getIDEtab () . "<br />";
			$etat .= "ID du Type de Chambre : " . $this -> getIDTypeChambre () . "<br />";
			$etat .= "ID du Groupe : " . $this -> getIDGroupe () . "<br />";
			$etat .= "Nombre de Chambres : " . $this -> getNombreChambres () . "<br />";

			return $etat;

		}

	}

?>