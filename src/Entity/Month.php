<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MonthRepository")
 */
class Month
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="month")
     */
    private $Booking;

    public function __construct()
    {
        $this->Booking = new ArrayCollection();
    }

    public function getId()
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

    /**
     * @return Collection|Booking[]
     */
    public function getBooking(): Collection
    {
        return $this->Booking;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->Booking->contains($booking)) {
            $this->Booking[] = $booking;
            $booking->setMonth($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->Booking->contains($booking)) {
            $this->Booking->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getMonth() === $this) {
                $booking->setMonth(null);
            }
        }

        return $this;
    }

    public function __toString() {
	    return $this->getName();
    }
}
