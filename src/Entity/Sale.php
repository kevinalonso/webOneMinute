<?php

namespace App\Entity;

use App\Repository\SaleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SaleRepository::class)
 */
class Sale
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
    private $SellerName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $IdSeller;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Command;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdAnnouncement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BuyerName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $IdBuyer;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateofSale;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Cgv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $State;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSellerName(): ?string
    {
        return $this->SellerName;
    }

    public function setSellerName(string $SellerName): self
    {
        $this->SellerName = $SellerName;

        return $this;
    }

    public function getBuyerName(): ?string
    {
        return $this->BuyerName;
    }

    public function setBuyerName(string $BuyerName): self
    {
        $this->BuyerName = $BuyerName;

        return $this;
    }

    public function getDateofSale(): ?\DateTimeInterface
    {
        return $this->DateofSale;
    }

    public function setDateofSale(\DateTimeInterface $DateofSale): self
    {
        $this->DateofSale = $DateofSale;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getCommand(): ?string
    {
        return $this->Command;
    }

    public function setCommand(string $Command): self
    {
        $this->Command = $Command;

        return $this;
    }

    public function getCgv(): ?bool
    {
        return $this->Cgv;
    }

    public function setCgv(bool $Cgv): self
    {
        $this->Cgv = $Cgv;

        return $this;
    }

    public function getIdSeller(): ?int
    {
        return $this->IdSeller;
    }

    public function setIdSeller(int $IdSeller): self
    {
         $this->IdSeller = $IdSeller;

        return $this;
    }

    public function getIdBuyer(): ?int
    {
        return $this->IdBuyer;
    }

    public function setIdBuyer(int $IdBuyer): self
    {
         $this->IdBuyer = $IdBuyer;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->State;
    }

    public function setState(string $State): self
    {
        $this->State = $State;

        return $this;
    }

    public function getIdAnnouncement(): ?int
    {
        return $this->IdAnnouncement;
    }

    public function setIdAnnouncement(int $IdAnnouncement): self
    {
         $this->IdAnnouncement = $IdAnnouncement;

        return $this;
    }
}
