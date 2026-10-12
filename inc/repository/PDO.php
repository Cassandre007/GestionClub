<?php

class PDO {
    public function __construct(private PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }

    public function setPDO(PDO $pdo): static {
        $this->pdo = $pdo;
        return $this;
    }
}
