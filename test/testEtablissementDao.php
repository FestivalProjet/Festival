<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test DAO</title>
    </head>
    <body>
        <?php
        
        use modele\Connexion;
        use modele\dao\EtablissementDao;
        use modele\metier\Etablissement;
        
        require("../includes/fonctions.inc.php");
        //require_once("../modele/Connexion.class.php");
        //require_once("../modele/dao/AttributionDao.class.php");
        //require_once("../modele/dao/EtablissementDao.class.php");
        //require_once("../modele/dao/GroupeDao.class.php");
	//require_once("../modele/dao/OffreDao.class.php");
        //require_once("../modele/dao/TypeChambreDao.class.php");

            $pdo = Connexion::connecter();
        
        $unEtab = new Etablissement("TEST","etab test","adresse test","44444","ville test",
                                    "0242042099","","","monsieur","duPON","boul");
        EtablissementDao::insert($unEtab);
        var_dump($unEtab);
        
        
        $unEtab2 = new Etablissement("TEST","etab test modifié","adresse test","44444","ville test",
                                    "0242042099","","","monsieur","duPON","boul");
        EtablissementDao::update("TEST",$unEtab2);
        
        $pdo = Connexion::deconnecter();

        ?>
        
    </body>
</html>
