<?php
class ActorsHasTroupe {
    private Actors $actor;
    private Troupe $troupe;
    private string $role;

    public function __construct(Actors $actor, Troupe $troupe, string $role ) {
        $this->actor = $actor;
        $this->troupe = $troupe;
        $this->role = $role;
    }

    public function get_actor(): Actor {
        return $this->actor;
    }

    public function get_troupe(): Troupe {
        return $this->troupe;
    }

    public function get_role(): string {
        return $this->role;
    }

    public function set_actor($actor): void {
        $this->actor = actor ;
    }

    public function set_troupe($troupe): void {
        $this->troupe = $troupe ;
    }

    public function set_role($role): void {
        $this->role = $role ;
    }

}