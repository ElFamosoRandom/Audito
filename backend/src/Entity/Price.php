<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $priceAmount;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventTypePrice", mappedBy="priceId")
     * @ORM\JoinColumn(nullable=true)
     */
    private $eventTypePrice;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $priceName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceAmount(): ?float
    {
        return $this->priceAmount;
    }

    public function setPriceAmount(float $priceAmount): self
    {
        $this->priceAmount = $priceAmount;

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

    public function getPriceName(): ?string
    {
        return $this->priceName;
    }

    public function setPriceName(string $priceName): self
    {
        $this->priceName = $priceName;

        return $this;
    }
}
