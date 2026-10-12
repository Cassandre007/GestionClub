<?php 

class InsertionBDD {
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

    public function getActor(int $id): Actor {
        $requete = $this->pdo->prepare("SELECT * FROM actor WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new Actor($result['id'], $result['first_name'], $result['last_name'], new DateTime($result['birth_date']), $result['picture']);
    }

    public function getTroupe(int $id): Troupe {
        $requete = $this->pdo->prepare("SELECT * FROM troupe WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new Troupe($result['id'], $result['name']);
    }

    public function getActorHasTroupe(int $id): ActorHasTroupe {
        $requete = $this->pdo->prepare("SELECT * FROM actor_has_troupe WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new ActorHasTroupe($result['id'], $result['actor_id'], $result['troupe_id'], $result['role']);
    }

    public function getStaffMember(int $id): StaffMember {
        $requete = $this->pdo->prepare("SELECT * FROM staff_member WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new StaffMember($result['id'], $result['first_name'], $result['last_name'], $result['picture'], $result['role']);
    }

    public function getTroupeOpposee(int $id): TroupeOpposee {
        $requete = $this->pdo->prepare("SELECT * FROM opposing_club WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new TroupeOpposee($result['id'], $result['address'], $result['city']);
    }

    public function getFaceOff(int $id): FaceOff {
        $requete = $this->pdo->prepare("SELECT * FROM face_off WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new FaceOff($result['id'], $result['troupe_score'], $result['opponent_score'], new DateTime($result['date']), $result['troupe_id'], $result['city'], $result['opposing_club_id']);
    }

    public function addActor(Actor $actor): void {
        $requete = $this->pdo->prepare("INSERT INTO actor (first_name, last_name, birth_date, picture) VALUES (:first_name, :last_name, :birth_date, :picture)");
        $requete->bindValue(':first_name', $actor->getFirstName());
        $requete->bindValue(':last_name', $actor->getLastName());
        $requete->bindValue(':birth_date', $actor->getBirthDate()->format('Y-m-d'));
        $requete->bindValue(':picture', $actor->getPicture());
        $requete->execute();
    }

    public function addTroupe(Troupe $troupe): void {
        $requete = $this->pdo->prepare("INSERT INTO troupe (name) VALUES (:name)");
        $requete->bindValue(':name', $troupe->getName());
        $requete->execute();
    }

    public function addActorHasTroupe(ActorHasTroupe $actorHasTroupe): void {
        $requete = $this->pdo->prepare("INSERT INTO actor_has_troupe (actor_id, troupe_id, role) VALUES (:actor_id, :troupe_id, :role)");
        $requete->bindValue(':actor_id', $actorHasTroupe->getActor()->getId());
        $requete->bindValue(':troupe_id', $actorHasTroupe->getTroupe()->getId());
        $requete->bindValue(':role', $actorHasTroupe->getRole());
        $requete->execute();
    }

    public function addStaffMember(StaffMember $staffMember): void {
        $requete = $this->pdo->prepare("INSERT INTO staff_member (first_name, last_name, picture, role) VALUES (:first_name, :last_name, :picture, :role)");
        $requete->bindValue(':first_name', $staffMember->getFirstName());
        $requete->bindValue(':last_name', $staffMember->getLastName());
        $requete->bindValue(':picture', $staffMember->getPicture());
        $requete->bindValue(':role', $staffMember->getRole());
        $requete->execute();
    }

    public function addTroupeOpposee(TroupeOpposee $troupeOpposee): void {
        $requete = $this->pdo->prepare("INSERT INTO opposing_club (address, city) VALUES (:address, :city)");
        $requete->bindValue(':address', $troupeOpposee->getAddress());
        $requete->bindValue(':city', $troupeOpposee->getCity());
        $requete->execute();
    }

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
}

?>
