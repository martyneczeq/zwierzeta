<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $age = null;

    #[ORM\Column]
    private ?bool $neutered = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $medicalRecords = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Client $owner = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AnimalType $type = null;

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function isNeutered(): ?bool
    {
        return $this->neutered;
    }

    public function setNeutered(bool $neutered): static
    {
        $this->neutered = $neutered;

        return $this;
    }

    public function getMedicalRecords(): ?string
    {
        return $this->medicalRecords;
    }

    public function setMedicalRecords(?string $medicalRecords): static
    {
        $this->medicalRecords = $medicalRecords;

        return $this;
    }

    public function getOwner(): ?Client
    {
        return $this->owner;
    }

    public function setOwner(?Client $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getType(): ?AnimalType
    {
        return $this->type;
    }

    public function setType(?AnimalType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
