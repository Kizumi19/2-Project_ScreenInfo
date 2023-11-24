<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'schedules')]
    private ?Doctor $doctor = null;

    #[ORM\Column(type: Types::JSON, length: 255)]
    private ?array $day = null;


    #[ORM\Column(type: Types::JSON, length: 255)]
    private ?array $shift = null;

    #[ORM\ManyToOne(inversedBy: 'schedules')]
    private ?Location $location = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hidden = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): static
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getDay(): array
    {
        return $this->day;
    }



    public function setDay(array $day): static
    {
        $this->day = $day;
        return $this;
    }

    public function getShift(): array
    {
        return $this->shift;
    }

    public function setShift(array $shift): self
    {
        $this->shift = $shift;

        return $this;
    }




    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

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