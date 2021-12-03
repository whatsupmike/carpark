<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=SlackUser::class, cascade={"persist", "remove"})
     */
    private $slackUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $xCoordinate;

    /**
     * @ORM\Column(type="integer")
     */
    private $yCoordinate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlackUser(): ?SlackUser
    {
        return $this->slackUser;
    }

    public function setSlackUser(?SlackUser $slackUser): self
    {
        $this->slackUser = $slackUser;

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
