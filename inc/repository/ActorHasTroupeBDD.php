<?php

abstract class ActorHasTroupeBDD extends PDO {
    public function getActorHasTroupe(int $id): ActorHasTroupe {
        try{
            $requete = $this->pdo->prepare("SELECT * FROM actor_has_troupe WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucun acteur trouvé dans la troupe avec l'ID : $id");
            }
            return new ActorHasTroupe($result['id'], $result['actor_id'], $result['troupe_id'], $result['role']);
        } catch (Exception $e) {
            echo "Erreur lors de la récupération de l'acteur dans la troupe : " . $e->getMessage();
            die();
        }
    }

    public function addActorHasTroupe(ActorHasTroupe $actorHasTroupe): void {
        try {
            $requete = $this->pdo->prepare("INSERT INTO actor_has_troupe (actor_id, troupe_id, role) VALUES (:actor_id, :troupe_id, :role)");
            $requete->bindValue(':actor_id', $actorHasTroupe->getActor()->getId());
            $requete->bindValue(':troupe_id', $actorHasTroupe->getTroupe()->getId());
            $requete->bindValue(':role', $actorHasTroupe->getRole());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'acteur dans la troupe : " . $e->getMessage());
        }
    }
}
