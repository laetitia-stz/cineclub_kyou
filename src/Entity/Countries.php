<?php

namespace App\Entity;

use App\Repository\CountriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountriesRepository::class)]
class Countries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Movies>
     */
    #[ORM\ManyToMany(targetEntity: Movies::class, inversedBy: 'countries')]
    private Collection $id_country;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $country_name = null;

    public function __construct()
    {
        $this->id_country = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Movies>
     */
    public function getIdCountry(): Collection
    {
        return $this->id_country;
    }

    public function addIdCountry(Movies $idCountry): static
    {
        if (!$this->id_country->contains($idCountry)) {
            $this->id_country->add($idCountry);
        }

        return $this;
    }

    public function removeIdCountry(Movies $idCountry): static
    {
        $this->id_country->removeElement($idCountry);

        return $this;
    }

    public function getCountryName(): ?string
    {
        return $this->country_name;
    }

    public function setCountryName(?string $country_name): static
    {
        $this->country_name = $country_name;

        return $this;
    }
}
