<?php

namespace App\Entity;

use App\Repository\CgsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CgsRepository::class)
 */
class Cgs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textCgs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextCgs(): ?string
    {
        return $this->textCgs;
    }

    public function setTextCgs(?string $textCgs): self
    {
        $this->textCgs = $textCgs;

        return $this;
    }
}
