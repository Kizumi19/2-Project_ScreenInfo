<?php

namespace App\Entity;

use App\Repository\SpecialityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
class Speciality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Type_Speciality = null;

    #[ORM\ManyToMany(targetEntity: Doctor::class, inversedBy: 'specialities')]
    private Collection $Doctor;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hidden = null;

    public function __construct()
    {
        $this->Doctor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeSpeciality(): ?string
    {
        return $this->Type_Speciality;
    }

    public function setTypeSpeciality(string $Type_Speciality): static
    {
        $this->Type_Speciality = $Type_Speciality;

        return $this;
    }

    /**
     * @return Collection<int, Doctor>
     */
    public function getDoctor(): Collection
    {
        return $this->Doctor;
    }

    public function addDoctor(Doctor $doctor): static
    {
        if (!$this->Doctor->contains($doctor)) {
            $this->Doctor->add($doctor);
        }

        return $this;
    }

    public function removeDoctor(Doctor $doctor): static
    {
        $this->Doctor->removeElement($doctor);

        return $this;
    }

    public function getHidden(): ?\DateTimeInterface
    {
        return $this->hidden;
    }

    public function setHidden(?\DateTimeInterface $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }
}
