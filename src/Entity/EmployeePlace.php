<?php

namespace App\Entity;

use App\Repository\EmployeePlaceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeePlaceRepository::class)
 */
class EmployeePlace
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=StsEmployee::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @ORM\OneToOne(targetEntity=Place::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?StsEmployee
    {
        return $this->employee;
    }

    public function setEmployee(StsEmployee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(Place $place): self
    {
        $this->place = $place;

        return $this;
    }
}
