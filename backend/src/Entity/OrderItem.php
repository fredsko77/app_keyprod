<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    private ?Order $commande = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column]
    private ?bool $is_complete = null;

    #[ORM\OneToMany(mappedBy: 'orderItem', targetEntity: Exemplaire::class)]
    private Collection $exemplaire;

    public function __construct()
    {
        $this->exemplaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getCommande(): ?Order
    {
        return $this->commande;
    }

    public function setCommande(?Order $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function isIsComplete(): ?bool
    {
        return $this->is_complete;
    }

    public function setIsComplete(bool $is_complete): self
    {
        $this->is_complete = $is_complete;

        return $this;
    }

    /**
     * @return Collection<int, Exemplaire>
     */
    public function getExemplaire(): Collection
    {
        return $this->exemplaire;
    }

    public function addExemplaire(Exemplaire $exemplaire): self
    {
        if (!$this->exemplaire->contains($exemplaire)) {
            $this->exemplaire->add($exemplaire);
            $exemplaire->setOrderItem($this);
        }

        return $this;
    }

    public function removeExemplaire(Exemplaire $exemplaire): self
    {
        if ($this->exemplaire->removeElement($exemplaire)) {
            // set the owning side to null (unless already changed)
            if ($exemplaire->getOrderItem() === $this) {
                $exemplaire->setOrderItem(null);
            }
        }

        return $this;
    }
}
