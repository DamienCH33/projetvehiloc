<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column('name', length: 255)]
    private ?string $name = null;

   #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;    

    #[ORM\Column('daily_price')]
    private ?float $daily_price = null;

    #[ORM\Column]
    private ?float $monthly_price = null;

    #[ORM\Column]
    private ?int $places = null;

   #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private ?bool $isManual = null; 

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

    public function getDailyPrice(): ?float
    {
        return $this->daily_price;
    }

    public function setDailyPrice(float $daily_price): static
    {
        $this->daily_price = $daily_price;

        return $this;
    }

    public function getMonthlyPrice(): ?float
    {
        return $this->monthly_price;
    }

    public function setMonthlyPrice(float $monthly_price): static
    {
        $this->monthly_price = $monthly_price;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): static
    {
        $this->places = $places;

        return $this;
    }

    public function isManual(): ?bool
    {
        return $this->isManual;
    }

    public function setManual(bool $isManual): static
    {
        $this->isManual = $isManual;

        return $this;
    }
}
