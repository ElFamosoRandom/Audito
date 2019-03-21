<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EventTypeRepository")
 */
class EventType 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $eventTypeName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="eventType")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventTypePrice", mappedBy="eventTypeId")
     * @ORM\JoinColumn(nullable=true)
     */
    private $eventTypePrice;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventTypeName(): ?string
    {
        return $this->eventTypeName;
    }

    public function setEventTypeName(string $eventTypeName): self
    {
        $this->eventTypeName = $eventTypeName;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setEventType($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getEventType() === $this) {
                $event->setEventType(null);
            }
        }

        return $this;
    }

    public function getEventTypePrice()
    {
        return $this->eventTypePrice;
    }

    public function setEventTypePrice(?EventTypePrice $eventTypePrice): self
    {
        $this->eventTypePrice = $eventTypePrice;

        return $this;
    }
}
