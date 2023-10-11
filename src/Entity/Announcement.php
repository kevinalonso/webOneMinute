<?php

namespace App\Entity;

use App\Repository\AnnouncementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnouncementRepository::class)
 */
class Announcement
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
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $City;

    /**
     * @ORM\Column(type="text", length=65535)
     */
    private $Description;

    /**
     * @ORM\Column(type="date")
     */
    private $DatePublish;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsActive;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    public function getId(): ?int
    {
        return $this->id;
    }

     public function setId(int $id): self
    {
         $this->id = $id;

        return $this;
    }

    /////////////////////////Link between Annnouncement & User////////////////////

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Announcements")
     */
    private $User;

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    ////////////////////////////////////////////


    ////////////////////////Link between Annnouncement & Category////////////////////

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="Announcements")
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

    /////////////////////////////////////////////////////////////////////

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDatePublish(): ?\DateTimeInterface
    {
        return $this->DatePublish;
    }

    public function setDatePublish(\DateTimeInterface $DatePublish): self
    {
        $this->DatePublish = $DatePublish;

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

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }
    

    /*Image Annoucement*/

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image1;

    public function setImage1($Image1)
    {
        $this->Image1 = $Image1;

        return $this;
    }
    
    public function getImage1()
    {
        return $this->Image1;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image2;

    public function setImage2($Image2)
    {
        $this->Image2 = $Image2;

        return $this;
    }
    
    public function getImage2()
    {
        return $this->Image2;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image3;

    public function setImage3($Image3)
    {
        $this->Image3 = $Image3;

        return $this;
    }
    
    public function getImage3()
    {
        return $this->Image3;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image4;

    public function setImage4($Image4)
    {
        $this->Image4 = $Image4;

        return $this;
    }
    
    public function getImage4()
    {
        return $this->Image4;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image5;

    public function setImage5($Image5)
    {
        $this->Image5 = $Image5;

        return $this;
    }
    
    public function getImage5()
    {
        return $this->Image5;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image6;

    public function setImage6($Image6)
    {
        $this->Image6 = $Image6;

        return $this;
    }
    
    public function getImage6()
    {
        return $this->Image6;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image7;

    public function setImage7($Image7)
    {
        $this->Image7 = $Image7;

        return $this;
    }
    
    public function getImage7()
    {
        return $this->Image7;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image8;

    public function setImage8($Image8)
    {
        $this->Image8 = $Image8;

        return $this;
    }
    
    public function getImage8()
    {
        return $this->Image8;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Image9;

    public function setImage9($Image9)
    {
        $this->Image9 = $Image9;

        return $this;
    }
    
    public function getImage9()
    {
        return $this->Image9;
    }

}
