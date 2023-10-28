<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DoctorRepository::class)]
class Doctor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hidden = null;

    #[ORM\OneToMany(mappedBy: 'doctor', targetEntity: Schedule::class)]
    private Collection $schedules;

    #[ORM\OneToMany(mappedBy: 'doctor', targetEntity: DoctorSpeciality::class)]
    private Collection $doctorSpecialities;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->doctorSpecialities = new ArrayCollection();
    }

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

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
     * @return Collection<int, Schedule>
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): static
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules->add($schedule);
            $schedule->setDoctor($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): static
    {
        if ($this->schedules->removeElement($schedule)) {
            // set the owning side to null (unless already changed)
            if ($schedule->getDoctor() === $this) {
                $schedule->setDoctor(null);
            }
        }

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
            $doctorSpeciality->setDoctor($this);
        }

        return $this;
    }

    public function removeDoctorSpeciality(DoctorSpeciality $doctorSpeciality): static
    {
        if ($this->doctorSpecialities->removeElement($doctorSpeciality)) {
            // set the owning side to null (unless already changed)
            if ($doctorSpeciality->getDoctor() === $this) {
                $doctorSpeciality->setDoctor(null);
            }
        }

        return $this;
    }
}
