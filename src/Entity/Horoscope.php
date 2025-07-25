<?php

namespace App\Entity;

use App\Repository\HoroscopeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoroscopeRepository::class)]
class Horoscope
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDuJour = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'horoscopes')]
    private ?Signe $signe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDuJour(): ?\DateTime
    {
        return $this->dateDuJour;
    }

    public function setDateDuJour(\DateTime $dateDuJour): static
    {
        $this->dateDuJour = $dateDuJour;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getSigne(): ?Signe
    {
        return $this->signe;
    }

    public function setSigne(?Signe $signe): static
    {
        $this->signe = $signe;

        return $this;
    }
}
