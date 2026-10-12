<?php 

abstract class TroupeBDD extends PDO {
    public function addTroupe(Troupe $troupe): void {
        $requete = $this->pdo->prepare("INSERT INTO troupe (name) VALUES (:name)");
        $requete->bindValue(':name', $troupe->getName());
        $requete->execute();
    }

    public function getTroupe(int $id): Troupe {
        $requete = $this->pdo->prepare("SELECT * FROM troupe WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new Troupe($result['id'], $result['name']);
    }
}
