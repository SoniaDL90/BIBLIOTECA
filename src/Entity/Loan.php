<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
class Loan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $fechaPrestamo = null;

    #[ORM\Column]
    private ?\DateTime $fechaDevolucionPrevista = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $fechaDevolucionReal = null;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\ManyToOne(inversedBy: 'book')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $Book = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaPrestamo(): ?\DateTime
    {
        return $this->fechaPrestamo;
    }

    public function setFechaPrestamo(\DateTime $fechaPrestamo): static
    {
        $this->fechaPrestamo = $fechaPrestamo;

        return $this;
    }

    public function getFechaDevolucionPrevista(): ?\DateTime
    {
        return $this->fechaDevolucionPrevista;
    }

    public function setFechaDevolucionPrevista(\DateTime $fechaDevolucionPrevista): static
    {
        $this->fechaDevolucionPrevista = $fechaDevolucionPrevista;

        return $this;
    }

    public function getFechaDevolucionReal(): ?\DateTime
    {
        return $this->fechaDevolucionReal;
    }

    public function setFechaDevolucionReal(?\DateTime $fechaDevolucionReal): static
    {
        $this->fechaDevolucionReal = $fechaDevolucionReal;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->Book;
    }

    public function setBook(?Book $Book): static
    {
        $this->Book = $Book;

        return $this;
    }
}
