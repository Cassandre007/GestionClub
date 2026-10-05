<?php

class StaffMember {
    public function __construct(private string $first_name, private string $last_name, private string $picture, private string $role){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->picture = $picture;
        $this->role = $role;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }
    public function getLastName(): string {
        return $this->last_name;
    }
    public function getPicture(): string {
        return $this->picture;
    }
    public function getRole(): string {
        return $this->role;
    }

    public function setFirstName(string $first_name): void {
        $this->first_name = $first_name;
    }
    public function setLastName(string $last_name): void {
        $this->last_name = $last_name;
    }
    public function setPicture(string $picture): void {
        $this->picture = $picture;
    }
    public function setRole(string $role): void {
        $this->role = $role;
    }
}

?>
