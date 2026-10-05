<?php

class ActorHasTroupe {
    private Actor $actor;
    private Troupe $troupe;
    private string $role;

    public function __construct(Actor $actor, Troupe $troupe, string $role) {
        $this->actor = $actor;
        $this->troupe = $troupe;
        $this->role = $role;
    }

    public function getActor(): Actor {
        return $this->actor;
    }

    public function getTroupe(): Troupe {
        return $this->troupe;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setActor(Actor $actor): void {
        $this->actor = $actor;
    }

    public function setTroupe(Troupe $troupe): void {
        $this->troupe = $troupe;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

}
