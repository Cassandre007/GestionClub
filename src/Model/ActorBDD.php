<?php

declare(strict_types=1);

abstract class ActorBDD extends BaseBDD
{
    public static function getActor(int $id): Actor
    {
        try {
            $requete = self::pdo()->prepare('SELECT * FROM actors WHERE id = :id');
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucun acteur trouvé avec l'ID : $id");
            }
            return new Actor($result['id'], $result['firstname'], $result['lastname'], new DateTime($result['birthdate']), $result['picture']);

        } catch (Exception $e) {
            echo "Erreur lors de la récupération de l'acteur : ".$e->getMessage();
            die();
        }
    }

    public static function getAllActors(): array
    {
        try {
            $requete = self::pdo()->prepare('SELECT * FROM actors');
            $requete->execute();
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
            $actors = [];
            foreach ($results as $result) {
                $actors[] = new Actor($result['id'], $result['firstname'], $result['lastname'], new DateTime($result['birthdate']), $result['picture']);
            }
            return $actors;
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération des acteurs : '.$e->getMessage();
            die();
        }
    }

    public static function hasHomonym(string $firstName, string $lastName, ?int $excludedActorId = null): bool
    {
        if ($excludedActorId !== null) {
            $sql = 'SELECT * FROM actors WHERE firstname = :firstname AND lastname = :lastname AND id <> :id';
        } else {
            $sql = 'SELECT * FROM actors WHERE firstname = :firstname AND lastname = :lastname';
        }
        $requete = self::pdo()->prepare($sql.' LIMIT 1');
        $requete->bindValue(':firstname', $firstName);
        $requete->bindValue(':lastname', $lastName);
        if ($excludedActorId !== null) {
            $requete->bindValue(':id', $excludedActorId, PDO::PARAM_INT);
        }
        $requete->execute();

        return $requete->fetchColumn() !== false;
    }

    public static function addActor(Actor $actor): void
    {
        try {
            $requete = self::pdo()->prepare('INSERT INTO actors (firstname, lastname, birthdate, picture) VALUES (:firstname, :lastname, :birthdate, :picture)');
            $requete->bindValue(':firstname', $actor->getFirstName());
            $requete->bindValue(':lastname', $actor->getLastName());
            $requete->bindValue(':birthdate', $actor->getBirthDate()->format('Y-m-d'));
            $requete->bindValue(':picture', $actor->getPicture());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'acteur : ".$e->getMessage());
        }
    }

    public static function updateActor(Actor $actor): void
    {
        try {
            $requete = self::pdo()->prepare('UPDATE actors SET firstname = :firstname, lastname = :lastname, birthdate = :birthdate, picture = :picture WHERE id = :id');
            $requete->bindValue(':firstname', $actor->getFirstName());
            $requete->bindValue(':lastname', $actor->getLastName());
            $requete->bindValue(':birthdate', $actor->getBirthDate()->format('Y-m-d'));
            $requete->bindValue(':picture', $actor->getPicture());
            $requete->bindValue(':id', $actor->getId(), PDO::PARAM_INT);
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la mise à jour de l'acteur : ".$e->getMessage());
        }
    }

    public static function deleteActor(int $id): void
    {
        $pdo = self::pdo();

        try {
            $pdo->beginTransaction();

            $requete = $pdo->prepare('DELETE FROM actors_has_troupe WHERE actor_id = :id');
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();

            $requete = $pdo->prepare('DELETE FROM actors WHERE id = :id');
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();

            $pdo->commit();
        } catch (Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            throw new Exception("Erreur lors de la suppression de l'acteur : ".$e->getMessage());
        }
    }
}
