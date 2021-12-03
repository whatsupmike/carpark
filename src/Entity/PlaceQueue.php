<?php

namespace App\Entity;

use App\Repository\PlaceQueueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaceQueueRepository::class)
 */
class PlaceQueue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class)
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity=SlackUser::class)
     */
    private $slackUser;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
