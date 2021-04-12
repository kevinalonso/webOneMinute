<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentRepository::class)
 */
class Payment
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
    private $pbx_site;

    /**
     * @ORM\Column(type="integer")
     */
    private $pbx_rang;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_identifiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_cmd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_porteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_effectue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_annule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_refuse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $HMAC;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPbxSite(): ?string
    {
        return $this->pbx_site;
    }

    public function setPbxSite(string $pbx_site): self
    {
        $this->pbx_site = $pbx_site;

        return $this;
    }

    public function getPbxRang(): ?int
    {
        return $this->pbx_rang;
    }

    public function setPbxRang(int $pbx_rang): self
    {
        $this->pbx_rang = $pbx_rang;

        return $this;
    }

    public function getPbxIdentifiant(): ?string
    {
        return $this->pbx_identifiant;
    }

    public function setPbxIdentifiant(string $pbx_identifiant): self
    {
        $this->pbx_identifiant = $pbx_identifiant;

        return $this;
    }

    public function getPbxCmd(): ?string
    {
        return $this->pbx_cmd;
    }

    public function setPbxCmd(string $pbx_cmd): self
    {
        $this->pbx_cmd = $pbx_cmd;

        return $this;
    }

    public function getPbxPorteur(): ?string
    {
        return $this->pbx_porteur;
    }

    public function setPbxPorteur(string $pbx_porteur): self
    {
        $this->pbx_porteur = $pbx_porteur;

        return $this;
    }

    public function getPbxEffectue(): ?string
    {
        return $this->pbx_effectue;
    }

    public function setPbxEffectue(string $pbx_effectue): self
    {
        $this->pbx_effectue = $pbx_effectue;

        return $this;
    }

    public function getPbxAnnule(): ?string
    {
        return $this->pbx_annule;
    }

    public function setPbxAnnule(string $pbx_annule): self
    {
        $this->pbx_annule = $pbx_annule;

        return $this;
    }

    public function getPbxRefuse(): ?string
    {
        return $this->pbx_refuse;
    }

    public function setPbxRefuse(string $pbx_refuse): self
    {
        $this->pbx_refuse = $pbx_refuse;

        return $this;
    }

    public function getHMAC(): ?string
    {
        return $this->HMAC;
    }

    public function setHMAC(string $HMAC): self
    {
        $this->HMAC = $HMAC;

        return $this;
    }
}
