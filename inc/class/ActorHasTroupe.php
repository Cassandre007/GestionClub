<?php

class ActorHasTroupe {
    private Actor $actor;
    private Troupe $troupe;
    private RoleActor $role;

    public function __construct(Actor $actor, Troupe $troupe, RoleActor $role) {
        $this->actor = $actor;
        $this->troupe = $troupe;
        $this->role = $role;
        new InsertionBDD($GLOBALS['pdo'])->addActorHasTroupe($this);
    }

    public function getActor(): Actor {
        return $this->actor;
    }

    public function getTroupe(): Troupe {
        return $this->troupe;
    }

    public function getRole(): RoleActor {
        return $this->role;
    }

    public function setActor(Actor $actor): static {
        $this->actor = $actor;
        return $this;
    }

    public function setTroupe(Troupe $troupe): static {
        $this->troupe = $troupe;
        return $this;
    }

    public function setRole(RoleActor $role): static {
        $this->role = $role;
        return $this;
    }

}
