<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $month_price = null;

    #[ORM\Column]
    private ?float $day_price = null;

    #[ORM\Column]
    private ?int $seat_count = null;

    #[ORM\Column(length: 255)]
    private ?string $transmission = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMonthPrice(): ?float
    {
        return $this->month_price;
    }

    public function setMonthPrice(float $month_price): static
    {
        $this->month_price = $month_price;

        return $this;
    }

    public function getDayPrice(): ?float
    {
        return $this->day_price;
    }

    public function setDayPrice(float $day_price): static
    {
        $this->day_price = $day_price;

        return $this;
    }

    public function getSeatCount(): ?int
    {
        return $this->seat_count;
    }

    public function setSeatCount(int $seat_count): static
    {
        $this->seat_count = $seat_count;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }
}
