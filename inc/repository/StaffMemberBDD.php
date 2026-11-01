<?php
require_once __DIR__ . '/../enum/RoleStaff.php';
require_once __DIR__ . '/../class/StaffMember.php';
require_once __DIR__ . '/BaseBDD.php';

abstract class StaffMembersBDD extends BaseBDD {
    public static function getStaffMember(int $id): StaffMember {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM staff_members WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result === null) {
                throw new RuntimeException("Aucun membre du personnel trouvé avec l'ID : $id");
            }
            return new StaffMember($result['id'], $result['firstname'], $result['lastname'], $result['picture'], RoleStaff::{$result['role']});
        } catch (Exception $e) {
            echo "Erreur lors de la récupération du membre du personnel : " . $e->getMessage();
            die();
        }
    }

    public static function getAllStaffMembers(): array {
        try {
            $requete = self::pdo()->prepare("SELECT * FROM staff_members");
            $requete->execute();
            $results = $requete->fetchAll(PDO::FETCH_ASSOC);
            $staffMembers = [];
            foreach ($results as $result) {
                $staffMembers[] = new StaffMember($result['id'], $result['firstname'], $result['lastname'], $result['picture'], RoleStaff::{$result['role']});
            }
            return $staffMembers;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des membres du personnel : " . $e->getMessage();
            die();
        }
    }

    public static function addStaffMember(StaffMember $staffMember): void {
        try {
            $requete = self::pdo()->prepare("INSERT INTO staff_members (firstname, lastname, picture, role) VALUES (:firstname, :lastname, :picture, :role)");
            $requete->bindValue(':firstname', $staffMember->getFirstName());
            $requete->bindValue(':lastname', $staffMember->getLastName());
            $requete->bindValue(':picture', $staffMember->getPicture());
            $requete->bindValue(':role', $staffMember->getRole());
            $requete->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du membre du personnel : " . $e->getMessage());
        }
    }
}
