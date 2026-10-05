<?php

class Actor {
    protected string $first_name;
    protected string $last_name;
    protected DateTime $birth_date;
    protected string $picture;

    public function __construct(string $first_name, string $last_name, DateTime $birth_date, string $picture) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->birth_date = $birth_date;
        $this->picture = $picture;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }

    public function getBirthDate(): DateTime {
        return $this->birth_date;
    }

    public function getPicture(): string {
        return $this->picture;
    }

    public function setFirstName(string $first_name): static {
        $this->first_name = $first_name;
        return $this;
    }

    public function setLastName(string $last_name): static {
        $this->last_name = $last_name ;
        return $this;
    }

    public function setBirthDate(DateTime $birth_date): static {
        $this->birth_date = $birth_date ;
        return $this;
    }

    public function setPicture(string $picture): static {
        $this->picture = $picture ;
        return $this;
    }

}
