<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $City;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CodePoste;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Factory;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsPro;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Announcement", mappedBy="User")
     */
    private $Announcements;

    /**
     * @ORM\Column(type="json")
     */
    private $Roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->Siret;
    }

    public function setSiret(string $Siret): self
    {
        $this->Siret = $Siret;

        return $this;
    }

    public function getFactory(): ?string
    {
        return $this->Factory;
    }

    public function setFactory(string $Factory): self
    {
        $this->Factory = $Factory;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getCodePoste(): ?string
    {
        return $this->CodePoste;
    }

    public function setCodePoste(string $CodePoste): self
    {
        $this->CodePoste = $CodePoste;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->IsActive;
    }

    public function setIsActive(bool $IsActive): self
    {
        $this->IsActive = $IsActive;

        return $this;
    }

    public function getIsPro(): ?bool
    {
        return $this->IsPro;
    }

    public function setIsPro(bool $IsPro): self
    {
        $this->IsPro = $IsPro;

        return $this;
    }

    public function __construct()
    {
        $this->Announcements = new ArrayCollection();
    }

    /**
     * @return Collection|Annoucement[]
     */
    public function getAnnouncements()
    {
        return $this->Announcements;
    }

    public function __toString()
    {   
        $fullName = $this->FirstName." ".$this->LastName;
        return $fullName;
    }

    //Function from interface

    public function getUsername()
    {
        return $this->Email;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->Roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->Roles = $roles;
        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->IsActive;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->Email,
            $this->Password,
            // see section on salt below
            // $this->salt,
            $this->IsActive
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->Email,
            $this->Password,
            // see section on salt below
            // $this->salt
            $this->IsActive
        ) = unserialize($serialized);
    }


}
