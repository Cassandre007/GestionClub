<?php

abstract class TroupeOpposeeBDD extends BaseBDD {
    public static function getTroupeOpposee(int $id): TroupeOpposee {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM opposing_club WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                throw new Exception("TroupeOpposee not found with ID: " . $id);
            }
            return new TroupeOpposee($result['id'], $result['address'], $result['city']);
        } catch (Exception $e) {
            throw new Exception("Error retrieving TroupeOpposee: " . $e->getMessage());
        }
    }

    public static function getAllTroupesOpposees(): array {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM opposing_club");
            $requete->execute();
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
            $troupesOpposees = [];
            foreach ($results as $result) {
                $troupesOpposees[] = new TroupeOpposee($result['id'],$result['address'], $result['city']);
            }
            return $troupesOpposees;
        } catch (Exception $e) {
            throw new Exception("Error retrieving TroupesOpposees: " . $e->getMessage());
        }
    }

    public static function addTroupeOpposee(TroupeOpposee $troupeOpposee): void {
        try {
            $requete = self::pdo()->prepare("INSERT INTO opposing_club (address, city) VALUES (:address, :city)");
            $requete->bindValue(':address', $troupeOpposee->getAddress());
            $requete->bindValue(':city', $troupeOpposee->getCity());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Error adding TroupeOpposee: " . $e->getMessage());
        }
    }
}
