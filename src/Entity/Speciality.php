<?php

namespace App\Entity;

use App\Entity\Doctor;
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



    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hidden = null;

    #[ORM\ManyToMany(targetEntity: Doctor::class, mappedBy: 'specialities')]
    private Collection $doctors;

    public function __construct()
    {
        $this->doctors = new ArrayCollection();
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



    public function getHidden(): ?\DateTimeInterface
    {
        return $this->hidden;
    }

    public function setHidden(?\DateTimeInterface $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    // Per poder agafar els noms dels doctors
    /**
     * @return array<string>
     */
    public function  getFullNamesOfDoctors(): array
    {
        $fullName = [];
        foreach ($this->doctors as $doctor) {
            $fullName[] = $doctor->getFullName();
        }
        return $fullName;
   }

   /**
    * @return Collection<int, Doctor>
    */
   public function getDoctors(): Collection
   {
       return $this->doctors;
   }

   public function addDoctor(Doctor $doctor): static
   {
       if (!$this->doctors->contains($doctor)) {
           $this->doctors->add($doctor);
           $doctor->addSpeciality($this);
       }

       return $this;
   }

   public function removeDoctor(Doctor $doctor): static
   {
       if ($this->doctors->removeElement($doctor)) {
           $doctor->removeSpeciality($this);
       }

       return $this;
   }
}
