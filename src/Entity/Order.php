<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $order_date;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $order_total;

    /**
     * @ORM\Column(type="integer")
     */
    private $order_status;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=ContentOrder::class, mappedBy="order", orphanRemoval=true)
     */
    private $contentOrders;

    public function __construct()
    {
        $this->contentOrders = new ArrayCollection();
    }

    public function __toString(): string
	{
			return $this->id;
	}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->order_date;
    }

    public function setOrderDate(\DateTimeInterface $order_date): self
    {
        $this->order_date = $order_date;

        return $this;
    }

    public function getDate(): string
    {
        return  $this->order_date->format("d/m/Y");
    }

    public function getOrderTotal(): ?string
    {
        return $this->order_total;
    }

    public function setOrderTotal(string $order_total): self
    {
        $this->order_total = $order_total;

        return $this;
    }

    public function getOrderStatus(): ?int
    {
        return $this->order_status;
    }

    public function setOrderStatus(int $order_status): self
    {
        $this->order_status = $order_status;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection|ContentOrder[]
     */
    public function getContentOrders(): Collection
    {
        return $this->contentOrders;
    }

    public function addContentOrder(ContentOrder $contentOrder): self
    {
        if (!$this->contentOrders->contains($contentOrder)) {
            $this->contentOrders[] = $contentOrder;
            $contentOrder->setCommande($this);
        }

        return $this;
    }

    public function removeContentOrder(ContentOrder $contentOrder): self
    {
        if ($this->contentOrders->removeElement($contentOrder)) {
            // set the owning side to null (unless already changed)
            if ($contentOrder->getCommande() === $this) {
                $contentOrder->setCommande(null);
            }
        }

        return $this;
    }
}
