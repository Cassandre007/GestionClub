<?php

enum RoleActor: string {
    case Narrateur = "Narrateur";
    case PersonnagePrincipal = "Personnage principal";
    case PersonnageSecondaire = "Personnage secondaire";
    case Figurants = "Figurants";
}

enum RoleStaff: string {
    case Directeur = "Directeur";
    case Assistant = "Assistant";
    case Technicien = "Technicien";
    case Costumier = "Costumier";
    case Maquilleur = "Maquilleur";
    case Scénariste = "Scénariste";
    case RégisseurLumière = "Régisseur lumière";
    case MetteurEnScène = "Metteur en scène";
}

?>
