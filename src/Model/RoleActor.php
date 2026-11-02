<?php

enum RoleActor: string {
    case Narrateur = "Narrateur";
    case PersonnagePrincipal = "Personnage principal";
    case PersonnageSecondaire = "Personnage secondaire";
    case Figurants = "Figurants";
    case Capitaine = "Capitaine";
    case Joueur = "Joueur";
    case Remplacant = "Remplaçant";

    public static function tryFromName(string $name): ?self {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }
        return null;
    }
}
