<?php

declare(strict_types=1);

abstract class TroupeOpposeeBDD extends BaseBDD
{
    public static function getTroupeOpposee(int $id): TroupeOpposee
    {
        try {
            $requete = self::pdo()->prepare('SELECT * FROM opposing_club WHERE id = :id');
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                throw new Exception('TroupeOpposee not found with ID: '.$id);
            }
            return new TroupeOpposee($result['id'], $result['address'], $result['city']);
        } catch (Exception $e) {
            throw new Exception('Error retrieving TroupeOpposee: '.$e->getMessage());
        }
    }

    public static function getAllTroupesOpposees(): array
    {
        try {
            $requete = self::pdo()->prepare('SELECT * FROM opposing_club');
            $requete->execute();
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
            $troupesOpposees = [];
            foreach ($results as $result) {
                $troupesOpposees[] = new TroupeOpposee($result['id'], $result['address'], $result['city']);
            }
            return $troupesOpposees;
        } catch (Exception $e) {
            throw new Exception('Error retrieving TroupesOpposees: '.$e->getMessage());
        }
    }

    public static function addTroupeOpposee(TroupeOpposee $troupeOpposee): void
    {
        try {
            $requete = self::pdo()->prepare('INSERT INTO opposing_club (address, city) VALUES (:address, :city)');
            $requete->bindValue(':address', $troupeOpposee->getAddress());
            $requete->bindValue(':city', $troupeOpposee->getCity());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception('Error adding TroupeOpposee: '.$e->getMessage());
        }
    }

    public static function updateTroupeOpposee(TroupeOpposee $troupeOpposee): void
    {
        try {
            $requete = self::pdo()->prepare('UPDATE opposing_club SET address = :address, city = :city WHERE id = :id');
            $requete->bindValue(':address', $troupeOpposee->getAddress());
            $requete->bindValue(':city', $troupeOpposee->getCity());
            $requete->bindValue(':id', $troupeOpposee->getId(), PDO::PARAM_INT);
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception('Error updating TroupeOpposee: '.$e->getMessage());
        }
    }

    public static function deleteTroupeOpposee(int $id): void
    {
        try {
            $requete = self::pdo()->prepare('DELETE FROM opposing_club WHERE id = :id');
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression de la troupe opposée : ".$e->getMessage());
        }
    }
}
