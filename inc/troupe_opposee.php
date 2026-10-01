<?php

class TroupeOpposee {
    public function __construct(private string $address, private string $city){
        $this->address = $address;
        $this->city = $city;
    }

    public get_address(); string {
        return $this->address;
    }
    public get_city(): string {
        return $this->city;
    }

    public set_address(string $address): void {
        $this->address = $addrress;
    }
    public set_city(string $city): void {
        $this->city = $city;
    }
}

?>
