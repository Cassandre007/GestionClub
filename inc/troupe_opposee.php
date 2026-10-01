<?php

class TroupeOpposee {
    public function __construct(private string $address, private string $city){
        $this->address = $address;
        $this->city = $city;
    }

    public function get_address(): string {
        return $this->address;
    }
    public function get_city(): string {
        return $this->city;
    }

    public function set_address(string $address): void {
        $this->address = $addrress;
    }
    public function set_city(string $city): void {
        $this->city = $city;
    }
}

?>
