<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Zone::class, inversedBy="places")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zone;

    /**
     * @ORM\Column(type="integer")
     */
    private $xCoordinate;

    /**
     * @ORM\Column(type="integer")
     */
    private $yCoordinate;

    /**
     * @ORM\OneToMany(targetEntity=EmployeePlace::class, mappedBy="place")
     */
    private $employeePlaces;

    public function __construct()
    {
        $this->employeePlaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getXCoordinate(): ?int
    {
        return $this->xCoordinate;
    }

    public function setXCoordinate(int $xCoordinate): self
    {
        $this->xCoordinate = $xCoordinate;

        return $this;
    }

    public function getYCoordinate(): ?int
    {
        return $this->yCoordinate;
    }

    public function setYCoordinate(int $yCoordinate): self
    {
        $this->yCoordinate = $yCoordinate;

        return $this;
    }
}
