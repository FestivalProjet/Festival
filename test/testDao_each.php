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

        ?>
        
        <form name="form" id="form" method="post" action="">
            Groupe :
                <input type="checkbox" name="test[]" value="GroupeDaoGetAll" id="1"/><label for="1">getAll</label>
                <input type="checkbox" name="test[]" value="GroupeDaoGetOneById" id="2"/><label for="2">getOneById</label>
            <br>
            TypeChambre :
                <input type="checkbox" name="test[]" value="TypeChambreDaoGetAll" id="3"/><label for="3">getAll</label>
                <input type="checkbox" name="test[]" value="TypeChambreDaoGetOneById" id="4"/><label for="4">getOneById</label>
                <input type="checkbox" name="test[]" value="TypeChambreDaoGetOneByLibelle" id="5"/><label for="5">getOneByLibelle</label>
                <input type="checkbox" name="test[]" value="TypeChambreDaoInsert" id="6"/><label for="6">insert</label>
                <input type="checkbox" name="test[]" value="TypeChambreDaoUpdate" id="7"/><label for="7">update</label>
                <input type="checkbox" name="test[]" value="TypeChambreDaoDelete" id="8"/><label for="8">delete</label>
            
            <br>
            <input type="submit" name="valider" value="OK" form="form"/>
            <input type="reset" value="Annuler"/>
        </form>
        
        <?php
        
            if(isset($_POST['test'])){
                foreach($_POST['test'] as $test) {
                    $test();
                }
            }
            
            
        
            // Test de GroupeDao
            
            function GroupeDaoGetAll(){
                
                $pdo = Connexion::connecter();
                
                // Groupe : test de sélection de tous les groupes
                echo "<p>Groupe : test de sélection de tous les groupes</p>";
                $lesGroupes = GroupeDao::getAll();
                
                var_dump($lesGroupes);
                
                $pdo = Connexion::deconnecter();
            }
            
            //Groupe : test de sélection par code
            function GroupeDaoGetOneById() {
                
                $pdo = Connexion::connecter();
                
                echo "<p>Groupe : test de sélection par id</p>";
                $unGroupe = GroupeDao::getOneById('g003');
                echo $unGroupe;
                
                $pdo = Connexion::deconnecter();
            }

            

            // Test de TypeChambreDao
            
            function TypeChambreDaoGetAll() {
                
                $pdo = Connexion::connecter();
                
                //TypeChambre : test de sélection de toutes les chambres
                echo "<p>TypeChambre : test de sélection de tous les types de chambre</p>";
                $lesTypeChambre = TypeChambreDao::getAll();
                var_dump($lesTypeChambre);
                
                $pdo = Connexion::deconnecter();
            }
            
            function TypeChambreDaoGetOneById() {
                
                $pdo = Connexion::connecter();
                
                //TypeChambre : test de sélection d'une chambre par id
                echo "<p>TypeChambre : test de sélection d'une chambre par id</p>";
                $unTypeChambre = TypeChambreDao::getOneById('C4');
                var_dump($unTypeChambre);
                
                $pdo = Connexion::deconnecter();
            }
            
            function TypeChambreDaoGetOneByLibelle() {
                
                $pdo = Connexion::connecter();
                
                //TypeChambre : test de sélection d'une chambre par libellé
                echo "<p>TypeChambre : test de sélection d'une chambre par libellé</p>";
                $unTypeChambre = TypeChambreDao::getOneByLibelle('1 lit');
                var_dump($unTypeChambre);
                
                $pdo = Connexion::deconnecter();
            }
            
            function TypeChambreDaoInsert() {
                
                $pdo = Connexion::connecter();
                
                //TypeChambre : test d'ajout d'une chambre
                echo "<p>TypeChambre : test d'ajout d'une chambre</p>";
                $unTypeChambre = new TypeChambre('C6','chambre test');
                try {
                    TypeChambreDao::insert($unTypeChambre);
                }catch (PDOException $e) {
                    echo  'ERROR : '. $e->getMessage();
                }
                var_dump($unTypeChambre);
                
                $pdo = Connexion::deconnecter();
            }
                        
            function TypeChambreDaoUpdate() {
                
                $pdo = Connexion::connecter();
                
                //TypeChambre : test de modification d'une chambre
                echo "<p>TypeChambre : test de modification d'une chambre</p>";
                $unTypeChambre = new TypeChambre('Cosef','chambre modifiée');
                try {
                    TypeChambreDao::update('C6',$unTypeChambre);
                }catch (PDOException $e) {
                    echo  'ERROR : '. $e->getMessage();
                }
                var_dump($unTypeChambre);
                
                $pdo = Connexion::deconnecter();
            }
            
            function TypeChambreDaoDelete() {
                
                $pdo = Connexion::connecter();
                
                //TypeChambre : test de suppression d'une chambre
                echo "<p>TypeChambre : test de suppression d'une chambre</p>";
                try {
                    TypeChambreDao::delete('C6');
                }catch (PDOException $e) {
                    echo  'ERROR : '. $e->getMessage();
                }
                
                $pdo = Connexion::deconnecter();
            }
            
            $pdo = Connexion::deconnecter();
        ?>
        
    </body>
</html>
