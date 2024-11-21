<?php
namespace App\Entity;

use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\InheritanceType("JOINED")]
abstract class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;


     #[ORM\Column(type: Types::TEXT, length: 200)]
     #[Assert\NotBlank]
     #[Assert\Length(min: 1, max: 200)]
     private ?string $name = null;

     #[ORM\Column(type: Types::TEXT, length: 200)]
     #[Assert\NotBlank]
     #[Assert\Length(min: 1, max: 200)]
     private ?string $model = null;

     #[ORM\Column(type: Types::DATE_MUTABLE)]
     #[Assert\NotBlank]
     private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $description = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'instruments')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): void
    {
        $this->model = $model;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }
}

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