<?php

	namespace modele\metier;

	class TypeChambre {

		private $id, $libelle;

		public function __construct ($id, $libelle) {

			$this -> id = $id;
			$this -> libelle = $libelle;

		}

		public function getId () {
			return $this -> id;
		}

		public function getLibelle () {
			return $this -> libelle;
		}

		public function setId ($id) {
			$this -> id = $id;
		}

		public function setLibelle ($libelle) {
			$this -> libelle = $libelle;
		}

		public function __toString () {

			$etat = "id : " . $this -> getId () . "<br />";
			$etat .= "Libelle : " . $this -> getLibelle () . "<br />";

			return $etat;

		}

	}

?>