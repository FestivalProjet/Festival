<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test DAO</title>
    </head>
    <body>
        <?php
        
        use modele\Connexion;
        use modele\dao\GroupeDao;
        use modele\dao\TypeChambreDao;
        use modele\metier\TypeChambre;
        
        require("../includes/fonctions.inc.php");
        //require_once("../modele/Connexion.class.php");
        //require_once("../modele/dao/AttributionDao.class.php");
        //require_once("../modele/dao/EtablissementDao.class.php");
        //require_once("../modele/dao/GroupeDao.class.php");
	//require_once("../modele/dao/OffreDao.class.php");
        //require_once("../modele/dao/TypeChambreDao.class.php");

            $pdo = Connexion::connecter();
        
        // Test de GroupeDao
        echo "<h3>Test de GroupeDao</h3>";
        
        // Groupe : test de sélection de tous les groupes
        echo "<p>Groupe : test de sélection de tous les groupes</p>";
        $lesGroupes = GroupeDao::getAll();
        var_dump($lesGroupes);
        
        //Groupe : test de sélection par code
        echo "<p>Groupe : test de sélection par id</p>";
        $unGroupe = GroupeDao::getOneById('g003');
        echo $unGroupe;
        
        
        // Test de TypeChambreDao
        echo "<h3>Test de TypeChambreDao</h3>";
        
        //TypeChambre : test de sélection de toutes les chambres
        echo "<p>TypeChambre : test de sélection de tous les types de chambre</p>";
        $lesTypeChambre = TypeChambreDao::getAll();
        var_dump($lesTypeChambre);
        
        //TypeChambre : test de sélection d'une chambre par id
        echo "<p>TypeChambre : test de sélection d'une chambre par id</p>";
        $unTypeChambre = TypeChambreDao::getOneById('C4');
        var_dump($unTypeChambre);
        
        //TypeChambre : test de sélection d'une chambre par libellé
        echo "<p>TypeChambre : test de sélection d'une chambre par libellé</p>";
        $unTypeChambre = TypeChambreDao::getOneByLibelle('1 lit');
        var_dump($unTypeChambre);
        
        //TypeChambre : test d'ajout d'une chambre
        echo "<p>TypeChambre : test d'ajout d'une chambre</p>";
        $unTypeChambre = new TypeChambre('C6','chambre test');
        try {
            TypeChambreDao::insert($unTypeChambre);
        }catch (PDOException $e) {
            echo  'ERROR : '. $e->getMessage();
        }
        var_dump($unTypeChambre);
        
        //TypeChambre : test de modification d'une chambre
        echo "<p>TypeChambre : test de modification d'une chambre</p>";
        $unTypeChambre = new TypeChambre('Cosef','chambre modifiée');
        try {
            TypeChambreDao::update('C6',$unTypeChambre);
        }catch (PDOException $e) {
            echo  'ERROR : '. $e->getMessage();
        }
        var_dump($unTypeChambre);
        
        //TypeChambre : test de suppression d'une chambre
        echo "<p>TypeChambre : test de suppression d'une chambre</p>";
        try {
            TypeChambreDao::delete('C7');
        }catch (PDOException $e) {
            echo  'ERROR : '. $e->getMessage();
        }
        
        $pdo = Connexion::deconnecter();

        ?>
        
    </body>
</html>
