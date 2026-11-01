<?php

abstract class ActorHasTroupeBDD extends BaseBDD {
    public static function getActorHasTroupe(int $actor_id, int $troupe_id): ActorHasTroupe {
        try{
            $requete = self::pdo()->prepare("SELECT * FROM actors_has_troupe WHERE actor_id = :actor_id AND troupe_id = :troupe_id");
            $requete->bindValue(':actor_id', $actor_id);
            $requete->bindValue(':troupe_id', $troupe_id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucun association acteur troupe trouvé");
            }
            return new ActorHasTroupe(ActorBDD::getActor($result['actor_id']), TroupeBDD::getTroupe($result['troupe_id']), RoleActor::from($result['role']));
        } catch (Exception $e) {
            echo "Erreur lors de la récupération de l'acteur dans la troupe : " . $e->getMessage();
            die();
        }
    }

    public static function getAllActorsHasTroupes(int $troupe_id): array {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM actors_has_troupe WHERE troupe_id = :troupe_id");
            $requete->bindValue(':troupe_id', $troupe_id);
            $requete->execute();
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
            $actorsHasTroupes = [];
            foreach ($results as $result) {
                $actorsHasTroupes[] = new ActorHasTroupe(ActorBDD::getActor($result['actor_id']), TroupeBDD::getTroupe($result['troupe_id']), RoleActor::from($result['role']));
            }
            return $actorsHasTroupes;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des acteurs dans les troupes : " . $e->getMessage();
            die();
        }
    }

    public static function addActorHasTroupe(ActorHasTroupe $actorHasTroupe): void {
        try {
            $requete = self::pdo()->prepare("INSERT INTO actors_has_troupe (actor_id, troupe_id, role) VALUES (:actor_id, :troupe_id, :role)");
            $requete->bindValue(':actor_id', $actorHasTroupe->getActor()->getId());
            $requete->bindValue(':troupe_id', $actorHasTroupe->getTroupe()->getId());
            $requete->bindValue(':role', $actorHasTroupe->getRole()->value);
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'acteur dans la troupe : " . $e->getMessage());
        }
    }
}
