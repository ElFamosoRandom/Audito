<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EventTypePriceRepository")
 */
class EventTypePrice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Price", inversedBy="eventTypePrice")
     * @ORM\JoinColumn(nullable=false)
     */
    private $priceId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventType", inversedBy="eventTypePrice")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eventTypeId;

    public function __construct()
    {
        $this->priceId = new ArrayCollection();
        $this->eventTypeId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Price[]
     */
    public function getPriceId(): Collection
    {
        return $this->priceId;
    }

    public function addPriceId(Price $priceId): self
    {
        if (!$this->priceId->contains($priceId)) {
            $this->priceId[] = $priceId;
            $priceId->setEventTypePrice($this);
        }

        return $this;
    }

    public function removePriceId(Price $priceId): self
    {
        if ($this->priceId->contains($priceId)) {
            $this->priceId->removeElement($priceId);
            // set the owning side to null (unless already changed)
            if ($priceId->getEventTypePrice() === $this) {
                $priceId->setEventTypePrice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EventType[]
     */
    public function getEventTypeId(): Collection
    {
        return $this->eventTypeId;
    }

    public function addEventTypeId(EventType $eventTypeId): self
    {
        if (!$this->eventTypeId->contains($eventTypeId)) {
            $this->eventTypeId[] = $eventTypeId;
            $eventTypeId->setEventTypePrice($this);
        }

        return $this;
    }

    public function removeEventTypeId(EventType $eventTypeId): self
    {
        if ($this->eventTypeId->contains($eventTypeId)) {
            $this->eventTypeId->removeElement($eventTypeId);
            // set the owning side to null (unless already changed)
            if ($eventTypeId->getEventTypePrice() === $this) {
                $eventTypeId->setEventTypePrice(null);
            }
        }

        return $this;
    }
}
