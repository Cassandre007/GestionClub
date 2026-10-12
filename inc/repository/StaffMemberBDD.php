<?php

abstract class StaffMembersBDD extends PDO {
    public function getStaffMember(int $id): StaffMember {
        try {
            $requete = $this->pdo->prepare("SELECT * FROM staff_member WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucun membre du personnel trouvé avec l'ID : $id");
            }
            return new StaffMember($result['id'], $result['first_name'], $result['last_name'], $result['picture'], $result['role']);
        } catch (Exception $e) {
            echo "Erreur lors de la récupération du membre du personnel : " . $e->getMessage();
            die();
        }
    }

    public function addStaffMember(StaffMember $staffMember): void {
        try {
            $requete = $this->pdo->prepare("INSERT INTO staff_member (first_name, last_name, picture, role) VALUES (:first_name, :last_name, :picture, :role)");
            $requete->bindValue(':first_name', $staffMember->getFirstName());
            $requete->bindValue(':last_name', $staffMember->getLastName());
            $requete->bindValue(':picture', $staffMember->getPicture());
            $requete->bindValue(':role', $staffMember->getRole());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du membre du personnel : " . $e->getMessage());
        }
    }
}
