<?php 
require_once __DIR__ . '/../class/FaceOff.php';

abstract class FaceOffBDD extends PDO {
    public function addFaceOff(FaceOff $faceOff): void {
        $requete = $this->pdo->prepare("INSERT INTO face_off (troupe_score, opponent_score, date, troupe_id, city, opposing_club_id) VALUES (:troupe_score, :opponent_score, :date, :troupe_id, :city, :opposing_club_id)");
        $requete->bindValue(':troupe_score', $faceOff->getTroupeScore());
        $requete->bindValue(':opponent_score', $faceOff->getOpponentScore());
        $requete->bindValue(':date', $faceOff->getDate()->format('Y-m-d'));
        $requete->bindValue(':troupe_id', $faceOff->getTroupe()->getId());
        $requete->bindValue(':city', $faceOff->getCity());
        $requete->bindValue(':opposing_club_id', $faceOff->getOpposingClub()->getId());
        $requete->execute();
    }

    public function getFaceOff(int $id): FaceOff {
        $requete = $this->pdo->prepare("SELECT * FROM face_off WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new FaceOff($result['id'], $result['troupe_score'], $result['opponent_score'], new DateTime($result['date']), $result['troupe_id'], $result['city'], $result['opposing_club_id']);
    }
}
