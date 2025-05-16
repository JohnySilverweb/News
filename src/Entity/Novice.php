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

    #[ORM\Column(length: 30)]
    private ?string $Naziv = null;

    #[ORM\Column(length: 30)]
    private ?string $Kategorija = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Vsebina = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $Datum_objave = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Izpostavljeno = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTime $createdAt = null;

        public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getCreatedAt(): ?\DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $date) {
        $this->createdAt = $date;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaziv(): ?string
    {
        return $this->Naziv;
    }

    public function setNaziv(string $Naziv): static
    {
        $this->Naziv = $Naziv;

        return $this;
    }

    public function getKategorija(): ?string
    {
        return $this->Kategorija;
    }

    public function setKategorija(string $Kategorija): static
    {
        $this->Kategorija = $Kategorija;

        return $this;
    }

    public function getVsebina(): ?string
    {
        return $this->Vsebina;
    }

    public function setVsebina(?string $Vsebina): static
    {
        $this->Vsebina = $Vsebina;

        return $this;
    }

    public function getDatumObjave(): ?\DateTime
    {
        return $this->Datum_objave;
    }

    public function setDatumObjave(\DateTime $Datum_objave): static
    {
        $this->Datum_objave = $Datum_objave;

        return $this;
    }

    public function isIzpostavljeno(): ?bool
    {
        return $this->Izpostavljeno;
    }

    public function setIzpostavljeno(?bool $Izpostavljeno): static
    {
        $this->Izpostavljeno = $Izpostavljeno;

        return $this;
    }
}
