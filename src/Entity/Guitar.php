<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Guitar extends Instrument
{
    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank]
    private ?int $string_number = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank]
    private ?int $fret_number = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $pickups = null;

    public function getStringNumber(): ?int
    {
        return $this->string_number;
    }

    public function setStringNumber(?int $string_number): void
    {
        $this->string_number = $string_number;
    }

    public function getFretNumber(): ?int
    {
        return $this->fret_number;
    }

    public function setFretNumber(?int $fret_number): void
    {
        $this->fret_number = $fret_number;
    }

    public function getPickups(): ?string
    {
        return $this->pickups;
    }

    public function setPickups(?string $pickups): void
    {
        $this->pickups = $pickups;
    }
}