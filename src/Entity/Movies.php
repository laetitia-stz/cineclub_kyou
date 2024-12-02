<?php

namespace App\Entity;

use App\Repository\MoviesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: MoviesRepository::class)]
class Movies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $poster = null;

    #[Vich\UploadableField(mapping: 'uploads', fileNameProperty: 'poster')]
    private ?File $posterFile = null;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $french_title = null;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $original_title = null;

    #[ORM\Column(nullable: true)]
    private ?int $year = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $prod_countries = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pitch = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $review = null;

    /**
     * @var Collection<int, Awards>
     */
    #[ORM\ManyToMany(targetEntity: Awards::class, mappedBy: 'id_award')]
    private Collection $awards_won;

    /**
     * @var Collection<int, Countries>
     */
    #[ORM\ManyToMany(targetEntity: Countries::class, mappedBy: 'id_country')]
    private Collection $countries;

    /**
     * @var Collection<int, Casting>
     */
    #[ORM\ManyToMany(targetEntity: Casting::class, mappedBy: 'id_cast')]
    private Collection $castings;

    /**
     * @var Collection<int, Categories>
     */
    #[ORM\ManyToMany(targetEntity: Categories::class, mappedBy: 'id_category')]
    private Collection $id_categories;

    public function __construct()
    {
        $this->awards_won = new ArrayCollection();
        $this->countries = new ArrayCollection();
        $this->castings = new ArrayCollection();
        $this->id_categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function setPosterFile(?File $posterfile = null): void
    {
        $this->posterFile = $posterfile;
    }

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    public function getFrenchTitle(): ?string
    {
        return $this->french_title;
    }

    public function setFrenchTitle(?string $french_title): static
    {
        $this->french_title = $french_title;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->original_title;
    }

    public function setOriginalTitle(?string $original_title): static
    {
        $this->original_title = $original_title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getProdCountries(): ?string
    {
        return $this->prod_countries;
    }

    public function setProdCountries(?string $prod_countries): static
    {
        $this->prod_countries = $prod_countries;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPitch(): ?string
    {
        return $this->pitch;
    }

    public function setPitch(?string $pitch): static
    {
        $this->pitch = $pitch;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): static
    {
        $this->review = $review;

        return $this;
    }

    /**
     * @return Collection<int, Awards>
     */
    public function getAwardsWon(): Collection
    {
        return $this->awards_won;
    }

    public function addAwardsWon(Awards $awardsWon): static
    {
        if (!$this->awards_won->contains($awardsWon)) {
            $this->awards_won->add($awardsWon);
            $awardsWon->addIdAward($this);
        }

        return $this;
    }

    public function removeAwardsWon(Awards $awardsWon): static
    {
        if ($this->awards_won->removeElement($awardsWon)) {
            $awardsWon->removeIdAward($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Countries>
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Countries $country): static
    {
        if (!$this->countries->contains($country)) {
            $this->countries->add($country);
            $country->addIdCountry($this);
        }

        return $this;
    }

    public function removeCountry(Countries $country): static
    {
        if ($this->countries->removeElement($country)) {
            $country->removeIdCountry($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getCastings(): Collection
    {
        return $this->castings;
    }

    public function addCasting(Casting $casting): static
    {
        if (!$this->castings->contains($casting)) {
            $this->castings->add($casting);
            $casting->addIdCast($this);
        }

        return $this;
    }

    public function removeCasting(Casting $casting): static
    {
        if ($this->castings->removeElement($casting)) {
            $casting->removeIdCast($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getIdCategories(): Collection
    {
        return $this->id_categories;
    }

    public function addIdCategory(Categories $idCategory): static
    {
        if (!$this->id_categories->contains($idCategory)) {
            $this->id_categories->add($idCategory);
            $idCategory->addIdCategory($this);
        }

        return $this;
    }

    public function removeIdCategory(Categories $idCategory): static
    {
        if ($this->id_categories->removeElement($idCategory)) {
            $idCategory->removeIdCategory($this);
        }

        return $this;
    }
}
