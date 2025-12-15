<?php

namespace App\Entity;

use App\Repository\ExperienciaLaboralRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExperienciaLaboralRepository::class)]
class ExperienciaLaboral {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'experienciaLaboral')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Graduado $graduado = null;

    #[ORM\Column(length: 50)]
    private ?string $estadoLaboral = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $empresa = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cargo = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $sector = null;

    #[ORM\Column(nullable: true)]
    private ?bool $relacionadoCarrera = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $fechaInicio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $fechaFin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombreJefeDirecto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emailContactoTthh = null;

    #[ORM\Column(nullable: true)]
    private ?bool $permitirContactoTthh = null;

    public function __toString(): string {
        return $this->empresa ?? '';
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

    public function getEstadoLaboral(): ?string {
        return $this->estadoLaboral;
    }

    public function setEstadoLaboral(string $estadoLaboral): static {
        $this->estadoLaboral = $estadoLaboral;

        return $this;
    }

    public function getEmpresa(): ?string {
        return $this->empresa;
    }

    public function setEmpresa(?string $empresa): static {
        $this->empresa = $empresa;

        return $this;
    }

    public function getCargo(): ?string {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): static {
        $this->cargo = $cargo;

        return $this;
    }

    public function getSector(): ?string {
        return $this->sector;
    }

    public function setSector(?string $sector): static {
        $this->sector = $sector;

        return $this;
    }

    public function isRelacionadoCarrera(): ?bool {
        return $this->relacionadoCarrera;
    }

    public function setRelacionadoCarrera(bool $relacionadoCarrera): static {
        $this->relacionadoCarrera = $relacionadoCarrera;

        return $this;
    }

    public function getFechaInicio(): ?\DateTime {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTime $fechaInicio): static {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTime {
        return $this->fechaFin;
    }

    public function setFechaFin(?\DateTime $fechaFin): static {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getNombreJefeDirecto(): ?string {
        return $this->nombreJefeDirecto;
    }

    public function setNombreJefeDirecto(?string $nombreJefeDirecto): static {
        $this->nombreJefeDirecto = $nombreJefeDirecto;

        return $this;
    }

    public function getEmailContactoTthh(): ?string {
        return $this->emailContactoTthh;
    }

    public function setEmailContactoTthh(?string $emailContactoTthh): static {
        $this->emailContactoTthh = $emailContactoTthh;

        return $this;
    }

    public function isPermitirContactoTthh(): ?bool {
        return $this->permitirContactoTthh;
    }

    public function setPermitirContactoTthh(?bool $permitirContactoTthh): static {
        $this->permitirContactoTthh = $permitirContactoTthh;

        return $this;
    }
}
