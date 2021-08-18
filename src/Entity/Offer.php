<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Label;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Photo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $IsUp;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Year;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Month;

    /**
     * @ORM\Column(type="text", length=65535)
     */
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subscription", mappedBy="Offer")
     */
    private $Subscriptions;

    public function __construct()
    {
        $this->Subscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->Label;
    }

    public function setLabel(?string $Label): self
    {
        $this->Label = $Label;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(?float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getPhoto(): ?int
    {
        return $this->Photo;
    }

    public function setPhoto(?int $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function __toString()
    {   
        return $this->Label;
    }

    public function getIsUp(): ?bool
    {
        return $this->IsUp;
    }

    public function setIsUp(?bool $IsUp): self
    {
        $this->IsUp = $IsUp;

        return $this;
    }

    public function getYear(): ?bool
    {
        return $this->Year;
    }

    public function setYear(?bool $Year): self
    {
        $this->Year = $Year;

        return $this;
    }

    public function getMonth(): ?bool
    {
        return $this->Month;
    }

    public function setMonth(?bool $Month): self
    {
        $this->Month = $Month;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    private $Sale;
    public function getSale(): ?Sale
    {
        return $this->Sale;
    }

    public function setSale(Sale $Sale): self
    {
        $this->Sale = $Sale;

        return $this;
    }

}
