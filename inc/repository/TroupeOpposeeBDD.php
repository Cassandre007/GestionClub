<?php
require_once __DIR__ . '/../class/TroupeOpposee.php';

abstract class TroupeOpposeeBDD extends PDO {
    public function getTroupeOpposee(int $id): TroupeOpposee {
        try {
            $requete = $this->pdo->prepare("SELECT * FROM opposing_club WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                throw new Exception("TroupeOpposee not found with ID: " . $id);
            }
            return new TroupeOpposee($result['address'], $result['city']);
        } catch (Exception $e) {
            throw new Exception("Error retrieving TroupeOpposee: " . $e->getMessage());
        }
    }

    public function addTroupeOpposee(TroupeOpposee $troupeOpposee): void {
        try {
            $requete = $this->pdo->prepare("INSERT INTO opposing_club (address, city) VALUES (:address, :city)");
            $requete->bindValue(':address', $troupeOpposee->getAddress());
            $requete->bindValue(':city', $troupeOpposee->getCity());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Error adding TroupeOpposee: " . $e->getMessage());
        }
    }
}
