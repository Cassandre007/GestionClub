<?php
class Actors {
    protected string $first_name;
    protected string $last_name;
    protected datetime $birth_date;
    protected string $picture;

    public function __construct(string $first_name, string $last_name, datetime $birth_date, string $picture) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->birth_date = $birth_date;
        $this->picture = $picture;
    }

    public function get_first_name(): string {
        return $this->first_name;
    }

    public function get_last_name(): string {
        return $this->last_name;
    }

    public function get_birth_date(): string {
        return $this->birth_date;
    }

    public function get_picture(): string {
        return $this->picture;
    }

    public function set_first_name($first_name): void {
        $this->first_name = $first_name ;
    }

    public function set_last_name($last_name): void {
        $this->last_name = $last_name ;
    }

    public function set_birth_date($birth_date): void {
        $this->birth_date = $birth_date ;
    }

    public function set_picture($picture): void {
        $this->picture = $picture ;
    }

}