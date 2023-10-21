<?php

namespace App\Entity;

use App\Repository\SpecialityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
class Speciality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeSpeciality = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $hidden = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeSpeciality(): ?string
    {
        return $this->typeSpeciality;
    }

    public function setTypeSpeciality(string $typeSpeciality): static
    {
        $this->typeSpeciality = $typeSpeciality;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isHidden(): ?bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }
}
