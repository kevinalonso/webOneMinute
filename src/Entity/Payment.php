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
    private $pbx_retour;

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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serveur_primaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serveur_secondaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_devise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_hash;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pbx_repondre_a;

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

    public function getPbxRetour(): ?string
    {
        return $this->pbx_retour;
    }

    public function setPbxRetour(string $pbx_retour): self
    {
        $this->pbx_retour = $pbx_retour;

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

    public function getServeurPrimaire(): ?string
    {
        return $this->serveur_primaire;
    }

    public function setServeurPrimaire(string $serveur_primaire): self
    {
        $this->serveur_primaire = $serveur_primaire;

        return $this;
    }

    public function getServeurSecondaire(): ?string
    {
        return $this->serveur_secondaire;
    }

    public function setServeurSecondaire(string $serveur_secondaire): self
    {
        $this->serveur_secondaire = $serveur_secondaire;

        return $this;
    }

    public function getPbxDevise(): ?string
    {
        return $this->pbx_devise;
    }

    public function setPbxDevise(string $pbx_devise): self
    {
        $this->pbx_devise = $pbx_devise;

        return $this;
    }

    public function getPbxHash(): ?string
    {
        return $this->pbx_hash;
    }

    public function setPbxHash(string $pbx_hash): self
    {
        $this->pbx_hash = $pbx_hash;

        return $this;
    }

    public function getPbxRepondreA(): ?string
    {
        return $this->pbx_repondre_a;
    }

    public function setPbxRepondreA(string $pbx_repondre_a): self
    {
        $this->pbx_repondre_a = $pbx_repondre_a;

        return $this;
    }
}
