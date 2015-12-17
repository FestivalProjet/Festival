<?php

	namespace modele\metier;

	class Offre {

		private $idEtat, $idTypeChambre, $nombreChambres;

		public function __construct ($idEtat, $idTypeChambre, $nombreChambres) {

			$this -> IDEtat = $idEtat;
			$this -> IDTypeChambre = $idTypeChambre;
			$this -> nombreChambres = $nombreChambres;

		}

		public function getIDEtat () {
			return $this -> IDEtat;
		}

		public function getIDTypeChambre () {
			return $this -> IDTypeChambre;
		}

		public function getNombreChambres () {
			return $this -> nombreChambres;
		}

		public function setIDEtat ($idEtat) {
			$this -> IDEtat = $idEtat;
		}

		public function setIDTypeChambre ($idTypeChambre) {
			$this -> IDTypeChambre = $idTypeChambre;
		}

		public function setNombreChambres ($nombreChambres) {
			$this -> nombreChambres = $nombreChambres;
		}

		public function __toString () {

			$etat = "ID de l'Etat : " . $this -> getIDEtat () . "<br />";
			$etat .= "ID du Type de Chambre : " . $this -> getIDTypeChambre () . "<br />";
			$etat .= "Nombre de Chambres : " . $this -> getNombreChambres () . "<br />";

			return $etat;

		}

	}

?>