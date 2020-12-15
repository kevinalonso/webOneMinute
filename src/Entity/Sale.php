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
     * @ORM\Column(type="string", length=255)
     */
    private $SellerName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BuyerName;

    /**
     * @ORM\Column(type="date")
     */
    private $DateofSale;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

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
}
