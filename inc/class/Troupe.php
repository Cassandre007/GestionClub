<?php
class Troupe {
    public function __construct(private string $name){
        $this->name = $name;
        new InsertionBDD($GLOBALS['pdo'])->addTroupe($this);
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;
        return $this;
    }
}

?>
