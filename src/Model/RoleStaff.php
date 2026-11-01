<?php

enum RoleStaff: string {
    case Directeur = "Directeur";
    case Assistant = "Assistant";
    case Technicien = "Technicien";
    case Costumier = "Costumier";
    case Maquilleur = "Maquilleur";
    case Scenariste = "Scénariste";
    case RegisseurLumiere = "Régisseur lumière";
    case MetteurEnScene = "Metteur en scène";
    case Presidente = "Présidente";
    case Tresoriere = "Trésorière";
    case Arbitre = "Arbitre";
    case TechnicienSonEtLumiere = "Technicien son et lumière";

    public static function tryFromName(string $name): ?self {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }
        return null;
    }
}
