<?php

class FaceOff {
    public function __construct(private int $troupe_score, private int $opponent_score, private DateTime $date, private Troupe $troupe, private string $city, private OpposingClub $opposing_club){
        $this->troupe_score = $troupe_score;
        $this->opponent_score = $troupe_score;
        $this->date = $date;
        $this->troupe = $troupe;
        $this->city = $city;
        $this->opposing_club = $opposing_club;
    }

    public function get_troupe_score(): int {
        return $this->troupe_score;
    }
    public function get_opponent_score(): int {
        return $this->opponent_score;
    }
    public function get_date(): DateTime {
        return $this->date;
    }
    public function get_troupe(): Troupe {
        return $this->troupe;
    }
    public function get_city(): string {
        return $this->city;
    }
    public function get_opposing_club(): OpposingClub {
        return $this->opposing_club;
    }


    public function set_troupe_score(int $troupe_score): void {
        $this->troupe_score = $troupe_score;
    }
    public function set_opponent_score(int $opponent_score): void {
        $this->opponent_score = $opponent_score;
    }
    public function set_date(DateTime $date): void {
        $this->date = $date;
    }
    public function set_troupe(Troupe $troupe): void {
        $this->troupe = $troupe;
    }
    public function set_city(string $city): void {
        $this->city = $city;
    }
    public function set_opposing_club(OpposingClub $opposing_club): void {
        $this->opposing_club = $opposing_club;
    }
}

?>
