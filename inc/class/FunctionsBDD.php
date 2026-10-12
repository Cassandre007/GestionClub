<?php 

abstract class InsertionBDD {
    public function __construct(private PDO $pdo){
        $this->pdo = $pdo;
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }

    public function setPdo(PDO $pdo): static {
        $this->pdo = $pdo;
        return $this;
    }

    public function addActor(Actor $actor){
        $requete = $this->pdo->prepare("INSERT INTO actor (first_name, last_name, birth_date, picture) VALUES (:first_name, :last_name, :birth_date, :picture)");
        $requete->bindValue(':first_name', $actor->getFirstName());
        $requete->bindValue(':last_name', $actor->getLastName());
        $requete->bindValue(':birth_date', $actor->getBirthDate()->format('Y-m-d'));
        $requete->bindValue(':picture', $actor->getPicture());
        $requete->execute();
    }

    public function addTroupe(Troupe $troupe){
        $requete = $this->pdo->prepare("INSERT INTO troupe (name) VALUES (:name)");
        $requete->bindValue(':name', $troupe->getName());
        $requete->execute();
    }

    public function addActorHasTroupe(ActorHasTroupe $actorHasTroupe){
        $requete = $this->pdo->prepare("INSERT INTO actor_has_troupe (actor_id, troupe_id, role) VALUES (:actor_id, :troupe_id, :role)");
        $requete->bindValue(':actor_id', $actorHasTroupe->getActor()->getId());
        $requete->bindValue(':troupe_id', $actorHasTroupe->getTroupe()->getId());
        $requete->bindValue(':role', $actorHasTroupe->getRole());
        $requete->execute();
    }

    public function addStaffMember(StaffMember $staffMember){
        $requete = $this->pdo->prepare("INSERT INTO staff_member (first_name, last_name, picture, role) VALUES (:first_name, :last_name, :picture, :role)");
        $requete->bindValue(':first_name', $staffMember->getFirstName());
        $requete->bindValue(':last_name', $staffMember->getLastName());
        $requete->bindValue(':picture', $staffMember->getPicture());
        $requete->bindValue(':role', $staffMember->getRole());
        $requete->execute();
    }

    public function addTroupeOpposee(TroupeOpposee $troupeOpposee){
        $requete = $this->pdo->prepare("INSERT INTO opposing_club (address, city) VALUES (:address, :city)");
        $requete->bindValue(':address', $troupeOpposee->getAddress());
        $requete->bindValue(':city', $troupeOpposee->getCity());
        $requete->execute();
    }

    public function addFaceOff(FaceOff $faceOff){
        $requete = $this->pdo->prepare("INSERT INTO face_off (troupe_score, opponent_score, date, troupe_id, city, opposing_club_id) VALUES (:troupe_score, :opponent_score, :date, :troupe_id, :city, :opposing_club_id)");
        $requete->bindValue(':troupe_score', $faceOff->getTroupeScore());
        $requete->bindValue(':opponent_score', $faceOff->getOpponentScore());
        $requete->bindValue(':date', $faceOff->getDate()->format('Y-m-d'));
        $requete->bindValue(':troupe_id', $faceOff->getTroupe()->getId());
        $requete->bindValue(':city', $faceOff->getCity());
        $requete->bindValue(':opposing_club_id', $faceOff->getOpposingClub()->getId());
        $requete->execute();
    }
}

?>
