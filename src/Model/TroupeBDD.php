<?php

abstract class TroupeBDD extends BaseBDD {
    public static function addTroupe(Troupe $troupe): void {
        try {
            $requete = self::pdo()->prepare("INSERT INTO troupe (name) VALUES (:name)");
            $requete->bindValue(':name', $troupe->getName());
            $requete->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la troupe : " . $e->getMessage();
        }
    }

    public static function getAllTroupes(): array {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM troupe");
            $requete->execute();
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
            $troupes = [];
            foreach ($results as $result) {
                $troupes[] = new Troupe($result['id'], $result['name']);
            }
            return $troupes;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des troupes : " . $e->getMessage();
            die();
        }
    }

    public static function getTroupe(int $id): Troupe {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM troupe WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucune troupe trouvée avec l'ID : $id");
            }
            return new Troupe($id, $result['name']);
        } catch (Exception $e) {
            echo "Erreur lors de la récupération de la troupe : " . $e->getMessage();
            die();
        }
    }
}
