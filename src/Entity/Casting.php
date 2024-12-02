<?php

namespace App\Entity;

use App\Repository\CastingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CastingRepository::class)]
class Casting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Movies>
     */
    #[ORM\ManyToMany(targetEntity: Movies::class, inversedBy: 'castings')]
    private Collection $id_cast;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $role = null;

    public function __construct()
    {
        $this->id_cast = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Movies>
     */
    public function getIdCast(): Collection
    {
        return $this->id_cast;
    }

    public function addIdCast(Movies $idCast): static
    {
        if (!$this->id_cast->contains($idCast)) {
            $this->id_cast->add($idCast);
        }

        return $this;
    }

    public function removeIdCast(Movies $idCast): static
    {
        $this->id_cast->removeElement($idCast);

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): static
    {
        $this->role = $role;

        return $this;
    }
}
