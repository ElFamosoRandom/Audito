<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\event", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eventId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\place", inversedBy="reservation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $placeId;

    public function __construct()
    {
        $this->placeId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->userId;
    }

    public function setUserId(?user $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getEventId(): ?event
    {
        return $this->eventId;
    }

    public function setEventId(?event $eventId): self
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * @return Collection|place[]
     */
    public function getPlaceId(): Collection
    {
        return $this->placeId;
    }

    public function addPlaceId(place $placeId): self
    {
        if (!$this->placeId->contains($placeId)) {
            $this->placeId[] = $placeId;
            $placeId->setReservation($this);
        }

        return $this;
    }

    public function removePlaceId(place $placeId): self
    {
        if ($this->placeId->contains($placeId)) {
            $this->placeId->removeElement($placeId);
            // set the owning side to null (unless already changed)
            if ($placeId->getReservation() === $this) {
                $placeId->setReservation(null);
            }
        }

        return $this;
    }
}
