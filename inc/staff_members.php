<?php

class StaffMember {
    public function __construct(private string $first_name, private string $last_name, private string $picture, private string $role){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->picture = $picture;
        $this->role = $role;
    }

    public function get_first_name(): string {
        return $this->first_name;
    }
    public function get_last_name(): string {
        return $this->last_name;
    }
    public function get_picture(): string {
        return $this->picture;
    }
    public function get_role(): string {
        return $this->role;
    }

    public function set_first_name(string $first_name): void {
        $this->first_name = $first_name;
    }
    public function set_last_name(string $last_name): void {
        $this->last_name = $last_name;
    }
    public function set_picture(string $picture): void {
        $this->picture = $picture;
    }
    public function set_role(string $role): void {
        $this->role = $role;
    }
}

?>
