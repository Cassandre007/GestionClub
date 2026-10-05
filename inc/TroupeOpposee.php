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

    public function setAddress(string $address): static {
        $this->address = $address;
        return $this;
    }
    public function setCity(string $city): static {
        $this->city = $city;
        return $this;
    }
}

?>
