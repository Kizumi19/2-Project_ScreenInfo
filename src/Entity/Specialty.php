<?php

namespace App\Entity;

use App\Repository\SpecialtyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialtyRepository::class)]
class Specialty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_specialty = null;

    #[ORM\ManyToMany(targetEntity: Doctor::class, inversedBy: 'specialties')]
    private Collection $doctor_id;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?bool $hidden = null;

    public function __construct()
    {
        $this->doctor_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeSpecialty(): ?string
    {
        return $this->type_specialty;
    }

    public function setTypeSpecialty(string $type_specialty): static
    {
        $this->type_specialty = $type_specialty;

        return $this;
    }

    /**
     * @return Collection<int, Doctor>
     */
    public function getDoctorId(): Collection
    {
        return $this->doctor_id;
    }

    public function addDoctorId(Doctor $doctorId): static
    {
        if (!$this->doctor_id->contains($doctorId)) {
            $this->doctor_id->add($doctorId);
        }

        return $this;
    }

    public function removeDoctorId(Doctor $doctorId): static
    {
        $this->doctor_id->removeElement($doctorId);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

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
