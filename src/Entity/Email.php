<?php

namespace App\Entity;

use App\Repository\EmailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmailRepository::class)
 */
class Email
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
    private $KeyEmail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EmailAddress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Object;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyEmail(): ?string
    {
        return $this->KeyEmail;
    }

    public function setKeyEmail(string $KeyEmail): self
    {
        $this->KeyEmail = $KeyEmail;

        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->EmailAddress;
    }

    public function setEmailAddress(string $EmailAddress): self
    {
        $this->EmailAddress = $EmailAddress;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->Object;
    }

    public function setObject(string $Object): self
    {
        $this->Object = $Object;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): self
    {
        $this->Message = $Message;

        return $this;
    }
}
