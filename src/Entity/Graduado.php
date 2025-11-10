<?php

namespace App\Entity;

use App\Repository\GraduadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GraduadoRepository::class)]
class Graduado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'graduados')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carrera $carrera = null;

    #[ORM\Column(length: 10, unique: true)]
    private ?string $cedula = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $nombres = null;

    #[ORM\Column(length: 50)]
    private ?string $cohorte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroRegistro = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $telefono = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $paisResidencia = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ciudadResidencia = null;

    #[ORM\Column]
    private ?bool $buscaEmpleo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cvPath = null;

    #[ORM\Column]
    private ?bool $interesadoColaborar = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $logrosDestacados = null;

    // Metadatos
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, ExperienciaLaboral>
     */
    #[ORM\OneToMany(targetEntity: ExperienciaLaboral::class, mappedBy: 'graduado', orphanRemoval: true)]
    private Collection $experienciaLaboral;

    /**
     * @var Collection<int, EstudioPosterior>
     */
    #[ORM\OneToMany(targetEntity: EstudioPosterior::class, mappedBy: 'graduado', orphanRemoval: true)]
    private Collection $estudiosPosteriores;

    public function __construct()
    {
        $this->experienciaLaboral = new ArrayCollection();
        $this->estudiosPosteriores = new ArrayCollection();
    } // Importante para saber qué tan frescos son los datos

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarrera(): ?Carrera
    {
        return $this->carrera;
    }

    public function setCarrera(?Carrera $carrera): static
    {
        $this->carrera = $carrera;

        return $this;
    }

    public function getCedula(): ?string
    {
        return $this->cedula;
    }

    public function setCedula(string $cedula): static
    {
        $this->cedula = $cedula;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): static
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getCohorte(): ?string
    {
        return $this->cohorte;
    }

    public function setCohorte(?string $cohorte): static
    {
        $this->cohorte = $cohorte;

        return $this;
    }

    public function getNumeroRegistro(): ?string
    {
        return $this->numeroRegistro;
    }

    public function setNumeroRegistro(?string $numeroRegistro): static
    {
        $this->numeroRegistro = $numeroRegistro;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getPaisResidencia(): ?string
    {
        return $this->paisResidencia;
    }

    public function setPaisResidencia(?string $paisResidencia): static
    {
        $this->paisResidencia = $paisResidencia;

        return $this;
    }

    public function getCiudadResidencia(): ?string
    {
        return $this->ciudadResidencia;
    }

    public function setCiudadResidencia(?string $ciudadResidencia): static
    {
        $this->ciudadResidencia = $ciudadResidencia;

        return $this;
    }

    public function isBuscaEmpleo(): ?bool
    {
        return $this->buscaEmpleo;
    }

    public function setBuscaEmpleo(bool $buscaEmpleo): static
    {
        $this->buscaEmpleo = $buscaEmpleo;

        return $this;
    }

    public function getCvPath(): ?string
    {
        return $this->cvPath;
    }

    public function setCvPath(?string $cvPath): static
    {
        $this->cvPath = $cvPath;

        return $this;
    }

    public function isInteresadoColaborar(): ?bool
    {
        return $this->interesadoColaborar;
    }

    public function setInteresadoColaborar(bool $interesadoColaborar): static
    {
        $this->interesadoColaborar = $interesadoColaborar;

        return $this;
    }

    public function getLogrosDestacados(): ?string
    {
        return $this->logrosDestacados;
    }

    public function setLogrosDestacados(?string $logrosDestacados): static
    {
        $this->logrosDestacados = $logrosDestacados;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt(): static
    {
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * @return Collection<int, ExperienciaLaboral>
     */
    public function getExperienciaLaboral(): Collection
    {
        return $this->experienciaLaboral;
    }

    public function addExperienciaLaboral(ExperienciaLaboral $experienciaLaboral): static
    {
        if (!$this->experienciaLaboral->contains($experienciaLaboral)) {
            $this->experienciaLaboral->add($experienciaLaboral);
            $experienciaLaboral->setGraduado($this);
        }

        return $this;
    }

    public function removeExperienciaLaboral(ExperienciaLaboral $experienciaLaboral): static
    {
        if ($this->experienciaLaboral->removeElement($experienciaLaboral)) {
            // set the owning side to null (unless already changed)
            if ($experienciaLaboral->getGraduado() === $this) {
                $experienciaLaboral->setGraduado(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EstudioPosterior>
     */
    public function getEstudiosPosteriores(): Collection
    {
        return $this->estudiosPosteriores;
    }

    public function addEstudiosPosteriore(EstudioPosterior $estudiosPosteriore): static
    {
        if (!$this->estudiosPosteriores->contains($estudiosPosteriore)) {
            $this->estudiosPosteriores->add($estudiosPosteriore);
            $estudiosPosteriore->setGraduado($this);
        }

        return $this;
    }

    public function removeEstudiosPosteriore(EstudioPosterior $estudiosPosteriore): static
    {
        if ($this->estudiosPosteriores->removeElement($estudiosPosteriore)) {
            // set the owning side to null (unless already changed)
            if ($estudiosPosteriore->getGraduado() === $this) {
                $estudiosPosteriore->setGraduado(null);
            }
        }

        return $this;
    }
}
