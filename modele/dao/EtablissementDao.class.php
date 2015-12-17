<?php
namespace modele\dao;

use modele\metier\Etablissement;
use modele\dao\Dao;
use modele\Connexion;
use \PDO;


class EtablissementDao implements Dao {
        
    public static function enregistrementVersObjet($unEnregistrement) {
        $retour = new Etablissement($unEnregistrement['id'], $unEnregistrement['nom'], $unEnregistrement['adresseRue'], $unEnregistrement['codePostal'], $unEnregistrement['ville'], $unEnregistrement['tel'], $unEnregistrement['adresseElectronique'], $unEnregistrement['type'], $unEnregistrement['civiliteResponsable'], $unEnregistrement['nomResponsable'], $unEnregistrement['prenomResponsable']);
        return $retour;        
    }

    public static function objetVersEnregistrement($objetMetier) {
        $retour = array(
            ':id' => $objetMetier->getId(),
            ':nom' => $objetMetier->getNom(),
            ':adresseRue' => $objetMetier->getAdresseRue(),
            ':codePostal' => $objetMetier->getCodePostal(),
            ':ville' => $objetMetier->getVille(),
            ':tel' => $objetMetier->getTel(),
            ':adresseElectronique' => $objetMetier->getAdresseElectronique(),
            ':type' => $objetMetier->getType(),
            ':civiliteResponsable' => $objetMetier->getCiviliteResponsable(),
            ':nomResponsable' => $objetMetier->getNomResponsable(),
            ':prenomResponsable' => $objetMetier->getPrenomResponsable()
        );
        return $retour;
    }
    
    public static function getAll() {
        $retour = null;
        // Requête textuelle
        $sql = "SELECT * FROM etablissement ORDER BY id";
        try {
            // préparer la requête PDO
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            // exécuter la requête PDO
            if ($queryPrepare->execute()) {
                // si la requête réussit :
                // initialiser le tableau d'objets à retourner
                $retour = array();
                // pour chaque enregistrement retourné par la requête
                while ($enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC)) {
                    // construir un objet métier correspondant
                    $unObjetMetier = self::enregistrementVersObjet($enregistrement);
                    // ajouter l'objet au tableau
                    $retour[] = $unObjetMetier;
                }
            }
        } catch (PDOException $e) {
            echo get_class() . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    public static function getOneById($valeurClePrimaire) {
        $retour = null;
        try {
            // Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
            $sql = "SELECT * FROM etablissement WHERE id = ?";
            // préparer la requête PDO
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($valeurClePrimaire))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = self::enregistrementVersObjet($enregistrement);
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }


    public static function insert($objetMetier) {
        $retour = null;
        try {
            // Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
            $sql = "INSERT INTO etablissement VALUES( ? , ? , ?, ? , ? , ? , ?, ? , ? , ? , ?)";
            // préparer la requête PDO
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array(
                                            $objetMetier->getId(),
                                            $objetMetier->getNom(),
                                            $objetMetier->getAdresseRue(),
                                            $objetMetier->getCodePostal(),
                                            $objetMetier->getVille(),
                                            $objetMetier->getTel(),
                                            $objetMetier->getAdressseElectronique(),
                                            $objetMetier->getTypeEtab(),
                                            $objetMetier->getCiviliteResponsable(),
                                            $objetMetier->getNomResponsable(),
                                            $objetMetier->getPrenomResponsable() ))) {
                // si la requête réussit :
                
                $retour = 1;
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }
    
    public static function update($idMetier, $objetMetier) {
        $retour = null;
        try {
            $sql = "UPDATE etablissement SET nom = ?,"
                                        . "adresseRue = ?,"
                                        . "codePostal = ?,"
                                        . "ville = ?,"
                                        . "tel = ?,"
                                        . "adresseElectronique = ?,"
                                        . "type = ?,"
                                        . "civiliteResponsable = ?,"
                                        . "nomResponsable = ?,"
                                        . "prenomResponsable = ?"
                                        . "WHERE id = ?";
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            if ($queryPrepare->execute(array(
                                            $objetMetier->getNom(),
                                            $objetMetier->getAdresseRue(),
                                            $objetMetier->getCodePostal(),
                                            $objetMetier->getVille(),
                                            $objetMetier->getTel(),
                                            $objetMetier->getAdressseElectronique(),
                                            $objetMetier->getTypeEtab(),
                                            $objetMetier->getCiviliteResponsable(),
                                            $objetMetier->getNomResponsable(),
                                            $objetMetier->getPrenomResponsable(),
                                            $idMetier                                   ))) {
                $retour = 1;
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }

    public static function delete($idMetier) {
        $retour = null;
        try {
            $sql = "DELETE FROM etablissement WHERE id = ?";
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            if ($queryPrepare->execute(array($idMetier))) {
                $retour = 1;
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }
    
    //Fonctions rajoutées
    
    function obtenirIdNomEtablissements($connexion) {
        $req = "SELECT id, nom FROM etablissement ORDER BY id";
        $stmt = $connexion->prepare($req);
        $stmt->execute();
        return $stmt;
    }

    function obtenirIdNomEtablissementsOffrantChambres($connexion) {
        $req = "SELECT DISTINCT id, nom FROM etablissement e 
                    INNER JOIN offre o ON e.id = o.idEtab 
                    ORDER BY id";
        $stmt = $connexion->prepare($req);
        $stmt->execute();
        return $stmt;
    }

    function obtenirNomEtablissementsOffrantChambres($connexion) {
        $req = "SELECT DISTINCT nom FROM etablissement e 
                    INNER JOIN offre o ON e.id = o.idEtab 
                    ORDER BY id";
        $stmt = $connexion->prepare($req);
        $stmt->execute();
        return $stmt;
    }

    function obtenirIdEtablissementsOffrantChambres($connexion) {
        $req = "SELECT DISTINCT id FROM etablissement e 
                    INNER JOIN offre o ON e.id = o.idEtab 
                    ORDER BY id";
        $stmt = $connexion->prepare($req);
        $stmt->execute();
        return $stmt;
    }

    function obtenirDetailEtablissement($connexion, $id) {
        $req = "SELECT * FROM etablissement WHERE id=?";
        $stmt = $connexion->prepare($req);
        $stmt->execute(array($id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function supprimerEtablissement($connexion, $id) {
        $req = "DELETE FROM etablissement WHERE id=?";
        $stmt = $connexion->prepare($req);
        $ok = $stmt->execute(array($id));
        return $ok;
    }

    public static function creerModifierEtablissement($connexion, $mode, $id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $type, $civiliteResponsable, $nomResponsable, $prenomResponsable) {
        if ($mode == 'C') {
            $req = "INSERT INTO etablissement VALUES (:id, :nom, :rue, :cdp, :ville, :tel, :email, :type, :civ, :nomResp, :prenomResp)";
        } else {
            $req = "UPDATE Etablissement SET nom=:nom, adresseRue=:rue,
               codePostal=:cdp, ville=:ville, tel=:tel,
               adresseElectronique=:email, type=:type,
               civiliteResponsable=:civ, nomResponsable=:nomResp, prenomResponsable=:prenomResp 
               WHERE id=:id";
        }
        $stmt = $connexion->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':rue', $adresseRue);
        $stmt->bindParam(':cdp', $codePostal);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $adresseElectronique);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':civ', $civiliteResponsable);
        $stmt->bindParam(':nomResp', $nomResponsable);
        $stmt->bindParam(':prenomResp', $prenomResponsable);
        $ok = $stmt->execute();
        return $ok;
    }

    function estUnIdEtablissement($connexion, $id) {
    //    global $connexion;
        $req = "SELECT COUNT(*) FROM etablissement WHERE id=?";
        $stmt = $connexion->prepare($req);
        $stmt->execute(array($id));
        return $stmt->fetchColumn();
    }

    function estUnNomEtablissement($connexion, $mode, $id, $nom) {
        //global $connexion;
        $nom = str_replace("'", "''", $nom);
        // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
        // on vérifie la non existence d'un autre établissement (id!='$id') portant 
        // le même nom
        if ($mode == 'C') {
            $req = "SELECT COUNT(*) FROM etablissement WHERE nom=?";
            $stmt = $connexion->prepare($req);
            $stmt->execute(array($nom));
        } else {
            $req = "SELECT COUNT(*) FROM etablissement WHERE nom=? AND id<>?";
            $stmt = $connexion->prepare($req);
            $stmt->execute(array($nom, $id));
        }
        return $stmt->fetchColumn();
    }

    function obtenirNbEtab($connexion) {
    //    global $connexion;
        $req = "SELECT COUNT(*) FROM etablissement";
        $stmt = $connexion->prepare($req);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    function obtenirNbEtabOffrantChambres($connexion) {
    //    global $connexion;
        $req = "SELECT COUNT(DISTINCT idEtab) FROM offre";
        $stmt = $connexion->prepare($req);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    //fonctions de vues/vCreerModifierEtablissement.php
    
    function a(){
        
    }
}