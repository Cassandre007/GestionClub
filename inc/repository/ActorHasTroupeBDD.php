<?php

abstract class ActorHasTroupeBDD extends PDO {
    public function getActorHasTroupe(int $id): ActorHasTroupe {
        $requete = $this->pdo->prepare("SELECT * FROM actor_has_troupe WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new ActorHasTroupe($result['id'], $result['actor_id'], $result['troupe_id'], $result['role']);
    }

    public function addActorHasTroupe(ActorHasTroupe $actorHasTroupe): void {
        $requete = $this->pdo->prepare("INSERT INTO actor_has_troupe (actor_id, troupe_id, role) VALUES (:actor_id, :troupe_id, :role)");
        $requete->bindValue(':actor_id', $actorHasTroupe->getActor()->getId());
        $requete->bindValue(':troupe_id', $actorHasTroupe->getTroupe()->getId());
        $requete->bindValue(':role', $actorHasTroupe->getRole());
        $requete->execute();
    }
}
