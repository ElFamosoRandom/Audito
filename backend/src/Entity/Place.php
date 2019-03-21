<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 */
class Place
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="places")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $placeRow;

    /**
     * @ORM\Column(type="integer")
     */
    private $placeColumn;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="placeId")
     */
    private $reservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory()/*: ?category*/
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPlaceRow(): ?string
    {
        return $this->placeRow;
    }

    public function setPlaceRow(string $placeRow): self
    {
        $this->placeRow = $placeRow;

        return $this;
    }

    public function getPlaceColumn(): ?int
    {
        return $this->placeColumn;
    }

    public function setPlaceColumn(int $placeColumn): self
    {
        $this->placeColumn = $placeColumn;

        return $this;
    }

    public function getReservation()
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }
}
