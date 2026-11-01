<?php

abstract class FaceOffBDD extends BaseBDD {
    public static function addFaceOff(FaceOff $faceOff): void {
        try {
            $requete = self::pdo()->prepare("INSERT INTO battle (troupe_score, opponent_score, date, troupe_id, city, opposing_club_id) VALUES (:troupe_score, :opponent_score, :date, :troupe_id, :city, :opposing_club_id)");
            $requete->bindValue(':troupe_score', $faceOff->getTroupeScore());
            $requete->bindValue(':opponent_score', $faceOff->getOpponentScore());
            $requete->bindValue(':date', $faceOff->getDate()->format('Y-m-d'));
            $requete->bindValue(':troupe_id', $faceOff->getTroupe()->getId());
            $requete->bindValue(':city', $faceOff->getCity());
            $requete->bindValue(':opposing_club_id', $faceOff->getOpposingClub()->getId());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Error adding FaceOff: " . $e->getMessage());
        }
    }

    public static function getAllFaceOffs(): array {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM battle");
            $requete->execute();
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
            $faceOffs = [];
            foreach ($results as $result) {
                $faceOffs[] = new FaceOff($result['id'], $result['troupe_score'], $result['opponent_score'], new DateTime($result['date']), TroupeBDD::getTroupe($result['troupe_id']), $result['city'], TroupeOpposeeBDD::getTroupeOpposee($result['opposing_club_id']));
            }
            return $faceOffs;
        } catch (Exception $e) {
            throw new Exception("Error retrieving FaceOffs: " . $e->getMessage());
        }
    }

    public static function getFaceOff(int $id): FaceOff {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM battle WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                throw new Exception("FaceOff not found with ID: " . $id);
            }
            return new FaceOff($result['id'], $result['troupe_score'], $result['opponent_score'], new DateTime($result['date']), TroupeBDD::getTroupe($result['troupe_id']), $result['city'], TroupeOpposeeBDD::getTroupeOpposee($result['opposing_club_id']));
        } catch (Exception $e) {
            throw new Exception("Error retrieving FaceOff: " . $e->getMessage());
        }
    }
}
