<?php

abstract class StaffMembersBDD extends PDO {
    public function getStaffMember(int $id): StaffMember {
        $requete = $this->pdo->prepare("SELECT * FROM staff_member WHERE id = :id");
        $requete->bindValue(':id', $id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return new StaffMember($result['id'], $result['first_name'], $result['last_name'], $result['picture'], $result['role']);
    }

    public function addStaffMember(StaffMember $staffMember): void {
        $requete = $this->pdo->prepare("INSERT INTO staff_member (first_name, last_name, picture, role) VALUES (:first_name, :last_name, :picture, :role)");
        $requete->bindValue(':first_name', $staffMember->getFirstName());
        $requete->bindValue(':last_name', $staffMember->getLastName());
        $requete->bindValue(':picture', $staffMember->getPicture());
        $requete->bindValue(':role', $staffMember->getRole());
        $requete->execute();
    }
}
