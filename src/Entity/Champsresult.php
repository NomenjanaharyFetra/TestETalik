<?php

namespace App\Entity;

use App\Repository\ChampsresultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampsresultRepository::class)]
class Champsresult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $data = [];

    #[ORM\ManyToOne(inversedBy: 'champsresults')]
    private ?Formulaire $FormulaireChamps = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getFormulaireChamps(): ?Formulaire
    {
        return $this->FormulaireChamps;
    }

    public function setFormulaireChamps(?Formulaire $FormulaireChamps): static
    {
        $this->FormulaireChamps = $FormulaireChamps;

        return $this;
    }
}
