<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="text")
     */
    private $Detalle;

    /**
     * @ORM\Column(type="float")
     */
    private $Deuda;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Estado;

    /**
     * @ORM\Column(type="date")
     */
    private $Fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PCompraPath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ValePath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FacturaPath;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proveedor", inversedBy="Pedidos")
     */
    private $proveedor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDetalle(): ?string
    {
        return $this->Detalle;
    }

    public function setDetalle(string $Detalle): self
    {
        $this->Detalle = $Detalle;

        return $this;
    }

    public function getDeuda(): ?float
    {
        return $this->Deuda;
    }

    public function setDeuda(float $Deuda): self
    {
        $this->Deuda = $Deuda;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->Estado;
    }

    public function setEstado(string $Estado): self
    {
        $this->Estado = $Estado;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getPCompraPath(): ?string
    {
        return $this->PCompraPath;
    }

    public function setPCompraPath(string $PCompraPath): self
    {
        $this->PCompraPath = $PCompraPath;

        return $this;
    }

    public function getValePath(): ?string
    {
        return $this->ValePath;
    }

    public function setValePath(?string $ValePath): self
    {
        $this->ValePath = $ValePath;

        return $this;
    }

    public function getFacturaPath(): ?string
    {
        return $this->FacturaPath;
    }

    public function setFacturaPath(?string $FacturaPath): self
    {
        $this->FacturaPath = $FacturaPath;

        return $this;
    }

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->getNombre();
    }

}
