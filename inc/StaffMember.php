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

    public function setFirstName(string $first_name): static {
        $this->first_name = $first_name;
        return $this;
    }
    public function setLastName(string $last_name): static {
        $this->last_name = $last_name;
        return $this;
    }
    public function setPicture(string $picture): static {
        $this->picture = $picture;
        return $this;
    }
    public function setRole(string $role): static {
        $this->role = $role;
        return $this;
    }
}

?>
