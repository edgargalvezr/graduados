<?php

namespace App\Entity;

use App\Repository\EstudioPosteriorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstudioPosteriorRepository::class)]
class EstudioPosterior {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'estudiosPosteriores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Graduado $graduado = null;

    #[ORM\Column(length: 255)]
    private ?string $institucion = null;

    #[ORM\Column(length: 255)]
    private ?string $tituloObtenido = null;

    #[ORM\Column(length: 255)]
    private ?string $tipoEstudio = null;

    #[ORM\Column]
    private ?bool $enCurso = null;

    public function __toString(): string {
        return $this->institucion ?? '';
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getGraduado(): ?Graduado {
        return $this->graduado;
    }

    public function setGraduado(?Graduado $graduado): static {
        $this->graduado = $graduado;

        return $this;
    }

    public function getInstitucion(): ?string {
        return $this->institucion;
    }

    public function setInstitucion(string $institucion): static {
        $this->institucion = $institucion;

        return $this;
    }

    public function getTituloObtenido(): ?string {
        return $this->tituloObtenido;
    }

    public function setTituloObtenido(string $tituloObtenido): static {
        $this->tituloObtenido = $tituloObtenido;

        return $this;
    }

    public function getTipoEstudio(): ?string {
        return $this->tipoEstudio;
    }

    public function setTipoEstudio(string $tipoEstudio): static {
        $this->tipoEstudio = $tipoEstudio;

        return $this;
    }

    public function isEnCurso(): ?bool {
        return $this->enCurso;
    }

    public function setEnCurso(bool $enCurso): static {
        $this->enCurso = $enCurso;

        return $this;
    }
}
