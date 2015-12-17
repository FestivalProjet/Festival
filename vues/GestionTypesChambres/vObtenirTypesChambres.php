<?php

include("_debut.inc.php");
require_once(__DIR__."/../../includes/fonctions.inc.php");
use modele\dao\UserDAO;
use modele\Connexion;
// AFFICHER L'ENSEMBLE DES TYPES DE CHAMBRES 
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR 
// TYPE DE CHAMBRE

echo "
<br>
<table width='40%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong>Types de chambres</strong></td>
   </tr>";
Connexion::connecter();
$rsTypeChambre = obtenirTypesChambres($connexion);
if (isset($_SESSION['pseudo'])){
$privil = UserDAO::getPrivilegeByPseudo($_SESSION['pseudo']);
}

// BOUCLE SUR LES TYPES DE CHAMBRES
while ($lgTypeChambre = $rsTypeChambre->fetch(PDO::FETCH_ASSOC)) {
    $id = $lgTypeChambre['id'];
    $libelle = $lgTypeChambre['libelle'];
    echo "
      <tr class='ligneTabNonQuad'> 
         <td width='15%'>$id</td>
         <td width='33%'>$libelle</td>
         <td width='26%' align='center'>";
        if (isset($_SESSION['pseudo']) && $privil == '1'){
         echo "<a href='cGestionTypesChambres.php?action=demanderModifierTypeChambre&id=$id'>
         Modifier</a></td>";
        }
    // S'il existe déjà des attributions pour le type de chambre, il faudra
    // d'abord les supprimer avant de pouvoir supprimer le type de chambre
    if (!existeAttributionsTypeChambre($connexion, $id) && isset($_SESSION['pseudo']) && $privil == '1') {
        echo "
            <td width='26%' align='center'>
            <a href='cGestionTypesChambres.php?action=demanderSupprimerTypeChambre&id=$id'>
            Supprimer</a></td>";
    } else {
        echo "<td width='26%'>&nbsp; </td>";
    }
    echo "               
    </tr>";
}
if (isset($_SESSION['pseudo']) && $privil == '1'){
echo "    
</table><br>
<a href='cGestionTypesChambres.php?action=demanderCreerTypeChambre'>
Création d'un type de chambre</a>";
}
include("_fin.inc.php");

