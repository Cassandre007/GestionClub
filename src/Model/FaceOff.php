<?php

declare(strict_types=1);

class FaceOff
{
    public function __construct(private int $id, private int $troupe_score, private int $opponent_score, private DateTime $date, private Troupe $troupe, private string $city, private TroupeOpposee $opposing_club)
    {
        $this->id = $id;
        $this->troupe_score = $troupe_score;
        $this->opponent_score = $opponent_score;
        $this->date = $date;
        $this->troupe = $troupe;
        $this->city = $city;
        $this->opposing_club = $opposing_club;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTroupeScore(): int
    {
        return $this->troupe_score;
    }
    public function getOpponentScore(): int
    {
        return $this->opponent_score;
    }
    public function getDate(): DateTime
    {
        return $this->date;
    }
    public function getTroupe(): Troupe
    {
        return $this->troupe;
    }
    public function getCity(): string
    {
        return $this->city;
    }
    public function getOpposingClub(): TroupeOpposee
    {
        return $this->opposing_club;
    }


    public function setTroupeScore(int $troupe_score): static
    {
        $this->troupe_score = $troupe_score;
        return $this;
    }
    public function setOpponentScore(int $opponent_score): static
    {
        $this->opponent_score = $opponent_score;
        return $this;
    }
    public function setDate(DateTime $date): static
    {
        $this->date = $date;
        return $this;
    }
    public function setTroupe(Troupe $troupe): static
    {
        $this->troupe = $troupe;
        return $this;
    }
    public function setCity(string $city): static
    {
        $this->city = $city;
        return $this;
    }
    public function setOpposingClub(TroupeOpposee $opposing_club): static
    {
        $this->opposing_club = $opposing_club;
        return $this;
    }
}
