<?php
class Troupe {
    public function __construct(private string $name){
        $this->name = $name;
    }

    public function get_name(): string {
        return $this->get_name;
    }

    public function set_name(string $name): void {
        $this->name = $name;
    }
}

?>
