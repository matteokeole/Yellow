<?php

namespace App\Entity;

use App\Repository\OrderRepository;
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
    private $order_id;

    /**
     * @ORM\Column(type="json")
     */
    private $order_content = [];

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
     * @ORM\OneToOne(targetEntity=Basket::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $basket_id;

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function getOrderContent(): ?array
    {
        return $this->order_content;
    }

    public function setOrderContent(array $order_content): self
    {
        $this->order_content = $order_content;

        return $this;
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

    public function getBasketId(): ?Basket
    {
        return $this->basket_id;
    }

    public function setBasketId(Basket $basket_id): self
    {
        $this->basket_id = $basket_id;

        return $this;
    }
}
