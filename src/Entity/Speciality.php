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
    private ?string $type_speciality = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hidden = null;

    #[ORM\OneToMany(mappedBy: 'speciality', targetEntity: DoctorSpeciality::class)]
    private Collection $doctorSpecialities;

    public function __construct()
    {
        $this->doctorSpecialities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeSpeciality(): ?string
    {
        return $this->type_speciality;
    }

    public function setTypeSpeciality(string $type_speciality): static
    {
        $this->type_speciality = $type_speciality;

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

    /**
     * @return Collection<int, DoctorSpeciality>
     */
    public function getDoctorSpecialities(): Collection
    {
        return $this->doctorSpecialities;
    }

    public function addDoctorSpeciality(DoctorSpeciality $doctorSpeciality): static
    {
        if (!$this->doctorSpecialities->contains($doctorSpeciality)) {
            $this->doctorSpecialities->add($doctorSpeciality);
            $doctorSpeciality->setSpeciality($this);
        }

        return $this;
    }

    public function removeDoctorSpeciality(DoctorSpeciality $doctorSpeciality): static
    {
        if ($this->doctorSpecialities->removeElement($doctorSpeciality)) {
            // set the owning side to null (unless already changed)
            if ($doctorSpeciality->getSpeciality() === $this) {
                $doctorSpeciality->setSpeciality(null);
            }
        }

        return $this;
    }
}
