<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 */
class User implements UserInterface, \Serializable
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=30)
	 * @Assert\NotBlank()
	 */
	private $firstName;

	/**
	 * @ORM\Column(type="string", length=30)
	 * @Assert\NotBlank()
	 */
	private $lastName;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Length(max=4096)
	 */
	private $plainPassword;

	/**
	 * @ORM\Column(type="string", length=255, unique=true)
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	private $email;

	/**
	 * @ORM\Column(name="is_active", type="boolean")
	 */
	private $isActive;

	/**
	 * @ORM\Column(name="roles", type="string", length=100, options={"default" : "ROLE_USER"})
	 */
	private $roles;
 /**
  * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="user")
  */
 private $bookings;

	public function __construct()
	{
		$this->isActive = true;
		if (is_null($this->roles)) {
			$this->roles = array('ROLE_USER');
		}
  $this->bookings = new ArrayCollection();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getUsername(): ?string
	{
		return $this->email;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setFirstName(string $firstName)
	{
		$this->firstName = $firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function setLastName(string $lastName)
	{
		$this->lastName = $lastName;
	}

	public function getPlainPassword()
	{
		return $this->plainPassword;
	}

	public function setPlainPassword($password)
	{
		$this->plainPassword = $password;
	}

	public function getPassword(): ?string
	{
		return $this->password;
	}

	public function setPassword(string $password): self
	{
		$this->password = $password;

		return $this;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}

	public function getIsActive(): ?bool
	{
		return $this->isActive;
	}

	public function setIsActive(bool $isActive): self
	{
		$this->isActive = $isActive;

		return $this;
	}

	public function getSalt()
	{
		return null;
	}

	/**
	 * @return mixed
	 */
	public function getRoles() {
		return $this->roles;
	}

	/**
	 * @param mixed $roles
	 *
	 * @return User
	 */
	public function setRoles( $roles ) {
		$this->roles = $roles;

		return $this;
	}

	public function eraseCredentials()
	{
	}

	/** @see \Serializable::serialize() */
	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->password,

		));
	}

	/** @see \Serializable::unserialize() */
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->password,
			) = unserialize($serialized, ['allowed_classes' => false]);
	}
 /**
  * @return Collection|Booking[]
  */
 public function getBookings(): Collection
 {
     return $this->bookings;
 }
 public function addBooking(Booking $booking): self
 {
     if (!$this->bookings->contains($booking)) {
         $this->bookings[] = $booking;
         $booking->setUser($this);
     }
     return $this;
 }
 public function removeBooking(Booking $booking): self
 {
     if ($this->bookings->contains($booking)) {
         $this->bookings->removeElement($booking);
         // set the owning side to null (unless already changed)
         if ($booking->getUser() === $this) {
             $booking->setUser(null);
         }
     }
     return $this;
 }
}
