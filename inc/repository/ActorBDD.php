<?php
require_once __DIR__ . '/../class/Actor.php';
require_once __DIR__ . '/BaseBDD.php';

abstract class ActorBDD extends BaseBDD {
    public static function getActor(int $id): Actor {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM actors WHERE id = :id");
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucun acteur trouvé avec l'ID : $id");
            }
            return new Actor($result['id'], $result['firstname'], $result['lastname'], new DateTime($result['birthdate']), $result['picture']);
        
        } catch (Exception $e) {
            echo "Erreur lors de la récupération de l'acteur : " . $e->getMessage();
            die();
        }
    }

    public static function getAllActors(): array {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM actors");
            $requete->execute();
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
            $actors = [];
            foreach ($results as $result) {
                $actors[] = new Actor($result['id'], $result['firstname'], $result['lastname'], new DateTime($result['birthdate']), $result['picture']);
            }
            return $actors;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des acteurs : " . $e->getMessage();
            die();
        }
    }

    public static function addActor(Actor $actor): void {
        try {
            $requete = self::pdo()->prepare("INSERT INTO actors (firstname, lastname, birthdate, picture) VALUES (:firstname, :lastname, :birthdate, :picture)");
            $requete->bindValue(':firstname', $actor->getFirstName());
            $requete->bindValue(':lastname', $actor->getLastName());
            $requete->bindValue(':birthdate', $actor->getBirthDate()->format('Y-m-d'));
            $requete->bindValue(':picture', $actor->getPicture());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'acteur : " . $e->getMessage());
        }
    }
}
