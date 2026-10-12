<?php 
require_once __DIR__ . '/../class/Troupe.php';

abstract class TroupeBDD extends PDO {
    public function addTroupe(Troupe $troupe): void {
        try {
            $requete = $this->pdo->prepare("INSERT INTO troupe (name) VALUES (:name)");
            $requete->bindValue(':name', $troupe->getName());
            $requete->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la troupe : " . $e->getMessage();
        }
    }

    public function getTroupe(int $id): Troupe {
        try {
            $requete = $this->pdo->prepare("SELECT * FROM troupe WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucune troupe trouvée avec l'ID : $id");
            }
            return new Troupe($result['name']);
        } catch (Exception $e) {
            echo "Erreur lors de la récupération de la troupe : " . $e->getMessage();
            die();
        }
    }
}
