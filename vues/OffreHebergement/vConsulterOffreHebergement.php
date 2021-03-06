<?php

include("_debut.inc.php");
require_once(__DIR__."/../../includes/fonctions.inc.php");
use modele\dao\UserDAO;
use modele\Connexion;
// CONSULTER LES OFFRES DE TOUS LES ÉTABLISSEMENTS
// IL FAUT QU'IL Y AIT AU MOINS UN ÉTABLISSEMENT ET UN TYPE CHAMBRE POUR QUE 
// L'AFFICHAGE SOIT EFFECTUÉ
$nbEtab = obtenirNbEtab($connexion);
$nbTypesChambres = obtenirNbTypesChambres($connexion);
Connexion::connecter();
if (isset($_SESSION['pseudo'])){
$privil = UserDAO::getPrivilegeByPseudo($_SESSION['pseudo']);
}
if ($nbEtab != 0 && $nbTypesChambres != 0) {
    // POUR CHAQUE ÉTABLISSEMENT : AFFICHAGE DU NOM ET D'UN TABLEAU COMPORTANT 1
    // LIGNE D'EN-TÊTE ET 1 LIGNE PAR TYPE DE CHAMBRE

    $rsEtab = obtenirIdNomEtablissements($connexion);
    
    // BOUCLE SUR LES ÉTABLISSEMENTS
    while ($lgEtab = $rsEtab->fetch(PDO::FETCH_ASSOC)) {
        $idEtab = $lgEtab['id'];
        $nom = $lgEtab['nom'];
        if (isset($_SESSION['pseudo']) && ($_SESSION['pseudo'] == 'Mairie' || $_SESSION['pseudo'] == $idEtab)){
            $access = '1';
        } else {
            $access = '0';
        }
        // AFFICHAGE DU NOM DE L'ÉTABLISSEMENT ET D'UN LIEN VERS LE FORMULAIRE DE
        // MODIFICATION
        echo "<strong>$nom</strong><br>";
        if (isset($_SESSION['pseudo']) && ($privil == '1' || $privil == '10') && $access == '1'){
      echo "<a href='cOffreHebergement.php?action=demanderModifierOffre&idEtab=$idEtab'>
      Modifier</a>";
        }
      echo "<table width='45%' cellspacing='0' cellpadding='0' class='tabQuadrille'>";

        // AFFICHAGE DE LA LIGNE D'EN-TÊTE
        echo "
         <tr class='enTeteTabQuad'>
            <td width='30%'>Type</td>
            <td width='35%'>Capacité</td>
            <td width='35%'>Nombre de chambres</td> 
         </tr>";

        $rsTypeChambre = obtenirTypesChambres($connexion);

        // BOUCLE SUR LES TYPES DE CHAMBRES (AFFICHAGE D'UNE LIGNE PAR TYPE DE 
        // CHAMBRE AVEC LE NOMBRE DE CHAMBRES OFFERTES DANS L'ÉTABLISSEMENT POUR 
        // LE TYPE DE CHAMBRE)
        while ($lgTypeChambre = $rsTypeChambre->fetch(PDO::FETCH_ASSOC)) {
            $idTypeChambre = $lgTypeChambre['id'];
            $libelle = $lgTypeChambre['libelle'];

            echo " 
            <tr class='ligneTabQuad'>
               <td>$idTypeChambre</td>
               <td>$libelle</td>";
            // On récupère le nombre de chambres offertes pour l'établissement 
            // et le type de chambre actuellement traités
            $nbOffre = obtenirNbOffre($connexion, $idEtab, $idTypeChambre);
            echo "
               <td>$nbOffre</td>
            </tr>";
        }
        echo "
      </table><br>";
    }
}

include("_fin.inc.php");

