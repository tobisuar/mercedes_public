<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProveedorRepository")
 */
class Proveedor
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
     * @ORM\Column(type="date")
     */
    private $Fecha;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Cuit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pedido", mappedBy="proveedor")
     */
    private $Pedidos;

    public function __construct()
    {
        $this->Pedidos = new ArrayCollection();
    }

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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getCuit(): ?string
    {
        return $this->Cuit;
    }

    public function setCuit(string $Cuit): self
    {
        $this->Cuit = $Cuit;

        return $this;
    }

    /**
     * @return Collection|Pedido[]
     */
    public function getPedidos(): Collection
    {
        return $this->Pedidos;
    }

    public function addPedido(Pedido $pedido): self
    {
        if (!$this->Pedidos->contains($pedido)) {
            $this->Pedidos[] = $pedido;
            $pedido->setProveedor($this);
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self
    {
        if ($this->Pedidos->contains($pedido)) {
            $this->Pedidos->removeElement($pedido);
            // set the owning side to null (unless already changed)
            if ($pedido->getProveedor() === $this) {
                $pedido->setProveedor(null);
            }
        }

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->getNombre();
    }

}
