<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cabin", inversedBy="booking")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $cabin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Month", inversedBy="Booking")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $month;

    /**
     * @ORM\Column(type="integer")
     */
    private $guest_quantity;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $reference;

    public function getId()
    {
        return $this->id;
    }

    public function getCabin(): ?Cabin
    {
        return $this->cabin;
    }

    public function setCabin(?Cabin $cabin): self
    {
        $this->cabin = $cabin;

        return $this;
    }

    public function getMonth(): ?Month
    {
        return $this->month;
    }

    public function setMonth(?Month $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getGuestQuantity(): ?int
    {
        return $this->guest_quantity;
    }

    public function setGuestQuantity(int $guest_quantity): self
    {
        $this->guest_quantity = $guest_quantity;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function __toString() {
	   return $this->getReference();
    }

}
