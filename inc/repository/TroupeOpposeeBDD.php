<?php

abstract class TroupeOpposeeBDD extends PDO {
    public function getTroupeOpposee(int $id): TroupeOpposee {
        $requete = $this->pdo->prepare("SELECT * FROM opposing_club WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new TroupeOpposee($result['id'], $result['address'], $result['city']);
    }

    public function addTroupeOpposee(TroupeOpposee $troupeOpposee): void {
        $requete = $this->pdo->prepare("INSERT INTO opposing_club (address, city) VALUES (:address, :city)");
        $requete->bindValue(':address', $troupeOpposee->getAddress());
        $requete->bindValue(':city', $troupeOpposee->getCity());
        $requete->execute();
    }
}
