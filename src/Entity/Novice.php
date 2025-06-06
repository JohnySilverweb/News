<?php

namespace App\Entity;

use App\Repository\NoviceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoviceRepository::class)]
class Novice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $summary = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $featured = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTime $createdAt = null;
    
    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTime $updatedAt = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTime $validFrom = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTime $validTill = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $published = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $image = null;


    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getCreatedAt(): ?\DateTime {
        return $this->createdAt;
    }
    
    public function setCreatedAt(?\DateTime $date): static
    {
        $this->createdAt = $date;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTime {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(?\DateTime $date): static
    {
        $this->updatedAt = $date;
        return $this;
    }
    
    public function getName(): ?string
    {
        return $this->name;
    }
    
    public function setName(string $name): static
    {
        $this->name = $name;
        
        return $this;
    }
    
    public function getCategory(): ?string
    {
        return $this->category;
    }
    
    public function setCategory(string $category): static
    {
        $this->category = $category;
        
        return $this;
    }
    
    public function getSummary(): ?string
    {
        return $this->summary;
    }
    
    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;
        
        return $this;
    }
    
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    public function setContent(?string $content): static
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getValidFrom(): ?\DateTime
    {
        return $this->validFrom;
    }
    
    public function setValidFrom(?\DateTime $validFrom): static
    {
        $this->validFrom = $validFrom;
        
        return $this;
    }
    
    public function getValidTill(): ?\DateTime
    {
        return $this->validTill;
    }
    
    public function setValidTill(?\DateTime $validTill): static
    {
        $this->validTill = $validTill;
        
        return $this;
    }
    
    public function isFeatured(): ?bool
    {
        return $this->featured;
    }
    
    public function setFeatured(?bool $featured): static
    {
        $this->featured = $featured;
        
        return $this;
    }
    
    public function isPublished(): ?bool 
    {
        return $this->published;
    }
    
    public function setPublished(?bool $published): static
    {
        $this->published = $published;
        
        return $this;
    }

    public function getImage(): ?string {
        return $this->image;
    }
    
    public function setImage(?string $image): static
    {
        $this->image = $image;
        return $this;
    }
}