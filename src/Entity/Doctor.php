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

    #[ORM\ManyToMany(targetEntity: Speciality::class, inversedBy: 'doctors')]
    #[ORM\JoinTable(name: "speciality_doctor")]
    private Collection $specialities;



    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->specialities = new ArrayCollection();
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

    public function getFullName(): ?string
    {
        return $this->getName().' '.$this->getSurname();
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


    public function  getAllSchedules(): array
    {
        $fullSchedule = [];
        foreach ($this->schedules as $schedule) {
            $fullSchedule[] = $schedule->getAllSchedules();
        }
        return $fullSchedule;
    }

    /**
     * @return Collection<int, Speciality>
     */
    public function getSpecialities(): Collection
    {
        return $this->specialities;
    }

    /**
     * @param Speciality[]|Collection $specialities
     */
    public function setSpecialities($specialities): void
    {
        $this->specialities = $specialities;
    }

    public function addSpeciality(Speciality $speciality): static
    {
        if (!$this->specialities->contains($speciality)) {
            $this->specialities->add($speciality);
        }

        return $this;
    }

    public function removeSpeciality(Speciality $speciality): static
    {
        $this->specialities->removeElement($speciality);

        return $this;
    }

}
