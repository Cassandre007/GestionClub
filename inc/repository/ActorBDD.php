<?php
require_once __DIR__ . '/../class/Actor.php';

abstract class ActorBDD extends PDO {
    public function getActor(int $id): Actor {
        try {
            $requete = $this->pdo->prepare("SELECT * FROM actor WHERE id = :id");
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucun acteur trouvé avec l'ID : $id");
            }
            return new Actor($result['id'], $result['first_name'], $result['last_name'], new DateTime($result['birth_date']), $result['picture']);
        
        } catch (Exception $e) {
            echo "Erreur lors de la récupération de l'acteur : " . $e->getMessage();
            die();
        }
    }

    public function addActor(Actor $actor): void {
        try {
            $requete = $this->pdo->prepare("INSERT INTO actor (first_name, last_name, birth_date, picture) VALUES (:first_name, :last_name, :birth_date, :picture)");
            $requete->bindValue(':first_name', $actor->getFirstName());
            $requete->bindValue(':last_name', $actor->getLastName());
            $requete->bindValue(':birth_date', $actor->getBirthDate()->format('Y-m-d'));
            $requete->bindValue(':picture', $actor->getPicture());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'acteur : " . $e->getMessage());
        }
    }
}
