<?php

namespace App\Entity;

use App\Repository\FormulaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormulaireRepository::class)]
class Formulaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $champs = null;

    #[ORM\ManyToOne(inversedBy: 'formulaires')]
    private ?User $FormulaireUser = null;

    /**
     * @var Collection<int, Champsresult>
     */
    #[ORM\OneToMany(targetEntity: Champsresult::class, mappedBy: 'FormulaireChamps')]
    private Collection $champsresults;

    public function __construct()
    {
        $this->champsresults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getChamps(): ?array
    {
        return $this->champs;
    }

    public function setChamps(?array $champs): static
    {
        $this->champs = $champs;

        return $this;
    }

    public function getFormulaireUser(): ?User
    {
        return $this->FormulaireUser;
    }

    public function setFormulaireUser(?User $FormulaireUser): static
    {
        $this->FormulaireUser = $FormulaireUser;

        return $this;
    }

    /**
     * @return Collection<int, Champsresult>
     */
    public function getChampsresults(): Collection
    {
        return $this->champsresults;
    }

    public function addChampsresult(Champsresult $champsresult): static
    {
        if (!$this->champsresults->contains($champsresult)) {
            $this->champsresults->add($champsresult);
            $champsresult->setFormulaireChamps($this);
        }

        return $this;
    }

    public function removeChampsresult(Champsresult $champsresult): static
    {
        if ($this->champsresults->removeElement($champsresult)) {
            // set the owning side to null (unless already changed)
            if ($champsresult->getFormulaireChamps() === $this) {
                $champsresult->setFormulaireChamps(null);
            }
        }

        return $this;
    }
    
}
