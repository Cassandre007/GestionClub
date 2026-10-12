<?php
require_once __DIR__ . '/../class/Actor.php';

abstract class ActorBDD extends PDO {
    public function getActor(int $id): Actor {
        $requete = $this->pdo->prepare("SELECT * FROM actor WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new Actor($result['id'], $result['first_name'], $result['last_name'], new DateTime($result['birth_date']), $result['picture']);
    }

    public function addActor(Actor $actor): void {
        $requete = $this->pdo->prepare("INSERT INTO actor (first_name, last_name, birth_date, picture) VALUES (:first_name, :last_name, :birth_date, :picture)");
        $requete->bindValue(':first_name', $actor->getFirstName());
        $requete->bindValue(':last_name', $actor->getLastName());
        $requete->bindValue(':birth_date', $actor->getBirthDate()->format('Y-m-d'));
        $requete->bindValue(':picture', $actor->getPicture());
        $requete->execute();
    }
}