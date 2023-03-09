<?php

namespace App\Entity;

use App\Repository\BankRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankRepository::class)
 */
class Bank
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
    private $Iban;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Bic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Banks")
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
         $this->id = $id;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->Iban;
    }

    public function setIban(?string $Iban): self
    {
        $this->Iban = $Iban;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->Bic;
    }

    public function setBic(?string $Bic): self
    {
        $this->Bic = $Bic;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
