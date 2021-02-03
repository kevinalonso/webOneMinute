<?php

namespace App\Entity;

use App\Repository\ImageCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageCategoryRepository::class)
 */
class ImageCategory
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
    private $Path;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->Path;
    }

    public function setPath(string $Path): self
    {
        $this->Path = $Path;

        return $this;
    }

    public function getVirtualFilename()
    {
        //Set path for easyadmin
        return realpath(__DIR__.'/../../templates/imagescat/'.$this->Path);
    }

    public function setVirtualFilename($Path)
    {
        //Only keep last part of filepath
        $this->setPath(basename($Path));
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="Images")
     */
    private $Category;

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }
}
