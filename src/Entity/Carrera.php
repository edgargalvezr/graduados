<?php

namespace App\Entity;

use App\Repository\CarreraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarreraRepository::class)]
class Carrera
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $codigo = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Graduado>
     */
    #[ORM\OneToMany(targetEntity: Graduado::class, mappedBy: 'carrera', orphanRemoval: true)]
    private Collection $graduados;

    public function __construct()
    {
        $this->graduados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Graduado>
     */
    public function getGraduados(): Collection
    {
        return $this->graduados;
    }

    public function addGraduado(Graduado $graduado): static
    {
        if (!$this->graduados->contains($graduado)) {
            $this->graduados->add($graduado);
            $graduado->setCarrera($this);
        }

        return $this;
    }

    public function removeGraduado(Graduado $graduado): static
    {
        if ($this->graduados->removeElement($graduado)) {
            // set the owning side to null (unless already changed)
            if ($graduado->getCarrera() === $this) {
                $graduado->setCarrera(null);
            }
        }

        return $this;
    }
}
