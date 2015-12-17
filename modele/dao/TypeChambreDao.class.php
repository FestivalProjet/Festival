<?php

namespace modele\dao;
    use modele\dao\Dao;
    use modele\metier\TypeChambre;
    use modele\Connexion;
    use \PDO;

class TypeChambreDao implements Dao {
        
    public static function enregistrementVersObjet($unEnregistrement) {
        $retour = new TypeChambre($unEnregistrement['id'], $unEnregistrement['libelle']);
        return $retour;        
    }

    public static function objetVersEnregistrement($objetMetier) {
        $retour = array(
            ':id' => $objetMetier->getId(),
            ':libelle' => $objetMetier->getLibelle()
        );
        return $retour;
    }
    
    public static function getAll() {
        $retour = null;
        // Requête textuelle
        $sql = "SELECT * FROM typechambre";
        try {
            Connexion::connecter();
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

    public static function getOneById($id) {
        $retour = null;
        try {
            Connexion::connecter();// Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
            $sql = "SELECT * FROM typechambre WHERE id = ?";
            // préparer la requête PDO
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($id))) {
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
    
    public static function getOneByLibelle($libelle) {
        $retour = null;
        try {
            Connexion::connecter();
            // Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
            $sql = "SELECT * FROM typechambre WHERE libelle = '?'";
            // préparer la requête PDO
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($libelle))) {
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
            $sql = "INSERT INTO typechambre VALUES( ? , ? )";
            // préparer la requête PDO
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($objetMetier->getId(),$objetMetier->getLibelle()))) {
                // si la requête réussit :
                
                $retour = 1;
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }
    
    public static function testAdd($unTypeChambre){
        $retour=1;
        try {
            self::insert($unTypeChambre);
        }catch (PDOException $e) {
            echo  'ERROR : '. $e->getMessage();
            $retour=0;
        }
        return $retour;
    }
    
    public static function update($idMetier, $objetMetier) {
        $retour = null;
        try {
            Connexion::connecter();
            $sql = "UPDATE typechambre SET libelle = ? WHERE id = ?";
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            if ($queryPrepare->execute(array($objetMetier,$idMetier))) {
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
             Connexion::connecter();
            $sql = "DELETE FROM typechambre WHERE id = ?";
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            if ($queryPrepare->execute(array($idMetier))) {
                $retour = 1;
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }
    public static function creerTypeChambre($id,$libelle) {
        
        try {
            Connexion::connecter();
            // Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
            $sql = "INSERT INTO typechambre VALUES( ? , ? )";
            // préparer la requête PDO
            $queryPrepare = Connexion::getPdo()->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($id,$libelle))) {
                // si la requête réussit :
                
                $retour = 1;
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
        }
}
