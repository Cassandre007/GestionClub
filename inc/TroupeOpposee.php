<?php

class TroupeOpposee {
    public function __construct(private string $address, private string $city){
        $this->address = $address;
        $this->city = $city;
    }

    public function getAddress(): string {
        return $this->address;
    }
    public function getCity(): string {
        return $this->city;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }
    public function setCity(string $city): void {
        $this->city = $city;
    }
}

?>
