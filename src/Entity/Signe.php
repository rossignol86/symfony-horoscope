<?php

namespace App\Entity;

use App\Repository\SigneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SigneRepository::class)]
class Signe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $element = null;

    #[ORM\Column(length: 255)]
    private ?string $symbole = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateFin = null;

    /**
     * @var Collection<int, Horoscope>
     */
    #[ORM\OneToMany(targetEntity: Horoscope::class, mappedBy: 'signe')]
    private Collection $horoscopes;

    public function __construct()
    {
        $this->horoscopes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getElement(): ?string
    {
        return $this->element;
    }

    public function setElement(string $element): static
    {
        $this->element = $element;

        return $this;
    }

    public function getSymbole(): ?string
    {
        return $this->symbole;
    }

    public function setSymbole(string $symbole): static
    {
        $this->symbole = $symbole;

        return $this;
    }



    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, Horoscope>
     */
    public function getHoroscopes(): Collection
    {
        return $this->horoscopes;
    }

    public function addHoroscope(Horoscope $horoscope): static
    {
        if (!$this->horoscopes->contains($horoscope)) {
            $this->horoscopes->add($horoscope);
            $horoscope->setSigne($this);
        }

        return $this;
    }

    public function removeHoroscope(Horoscope $horoscope): static
    {
        if ($this->horoscopes->removeElement($horoscope)) {
            // set the owning side to null (unless already changed)
            if ($horoscope->getSigne() === $this) {
                $horoscope->setSigne(null);
            }
        }

        return $this;
    }
}
