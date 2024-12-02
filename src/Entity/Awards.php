<?php

namespace App\Entity;

use App\Repository\AwardsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AwardsRepository::class)]
class Awards
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $award_name = null;

    #[ORM\Column(nullable: true)]
    private ?int $award_year = null;

    /**
     * @var Collection<int, Movies>
     */
    #[ORM\ManyToMany(targetEntity: Movies::class, inversedBy: 'awards_won')]
    private Collection $id_award;

    public function __construct()
    {
        $this->id_award = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAwardName(): ?string
    {
        return $this->award_name;
    }

    public function setAwardName(?string $award_name): static
    {
        $this->award_name = $award_name;

        return $this;
    }

    public function getAwardYear(): ?int
    {
        return $this->award_year;
    }

    public function setAwardYear(?int $award_year): static
    {
        $this->award_year = $award_year;

        return $this;
    }

    /**
     * @return Collection<int, Movies>
     */
    public function getIdAward(): Collection
    {
        return $this->id_award;
    }

    public function addIdAward(Movies $idAward): static
    {
        if (!$this->id_award->contains($idAward)) {
            $this->id_award->add($idAward);
        }

        return $this;
    }

    public function removeIdAward(Movies $idAward): static
    {
        $this->id_award->removeElement($idAward);

        return $this;
    }
}
