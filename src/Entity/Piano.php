<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Piano extends Instrument
{
    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank]
    private ?int $key_number = null;

    public function getKeyNumber(): ?int
    {
        return $this->key_number;
    }

    public function setKeyNumber(?int $key_number): void
    {
        $this->key_number = $key_number;
    }
}