<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subscription", inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     */
    private $subscription;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $userLastName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $userFirstName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $userBirthDate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $userEmail;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $userPassword;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $userCity;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $userPostCode;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $userStreet;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $userPhoneNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="userId")
     */
    private $reservations;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    public function setSubscription(?Subscription $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    public function getUserLastName(): ?string
    {
        return $this->userLastName;
    }

    public function setUserLastName(string $userLastName): self
    {
        $this->userLastName = $userLastName;

        return $this;
    }

    public function getUserFirstName(): ?string
    {
        return $this->userFirstName;
    }

    public function setUserFirstName(string $userFirstName): self
    {
        $this->userFirstName = $userFirstName;

        return $this;
    }

    public function getUserBirthDate(): ?\DateTimeInterface
    {
        return $this->userBirthDate;
    }

    public function setUserBirthDate(\DateTimeInterface $userBirthDate): self
    {
        $this->userBirthDate = $userBirthDate;

        return $this;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): self
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    public function getUserPassword(): ?string
    {
        return $this->userPassword;
    }

    public function setUserPassword(string $userPassword): self
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    public function getUserCity(): ?string
    {
        return $this->userCity;
    }

    public function setUserCity(string $userCity): self
    {
        $this->userCity = $userCity;

        return $this;
    }

    public function getUserPostCode(): ?string
    {
        return $this->userPostCode;
    }

    public function setUserPostCode(string $userPostCode): self
    {
        $this->userPostCode = $userPostCode;

        return $this;
    }

    public function getUserStreet(): ?string
    {
        return $this->userStreet;
    }

    public function setUserStreet(string $userStreet): self
    {
        $this->userStreet = $userStreet;

        return $this;
    }

    public function getUserPhoneNumber(): ?string
    {
        return $this->userPhoneNumber;
    }

    public function setUserPhoneNumber(string $userPhoneNumber): self
    {
        $this->userPhoneNumber = $userPhoneNumber;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setUserId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getUserId() === $this) {
                $reservation->setUserId(null);
            }
        }

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }
}
