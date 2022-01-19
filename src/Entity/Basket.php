<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BasketRepository::class)
 */
class Basket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $basket_id;

    /**
     * @ORM\OneToOne(targetEntity=Customer::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_id;

    public function getBasketId(): ?int
    {
        return $this->basket_id;
    }

    public function getCustomerId(): ?Customer
    {
        return $this->customer_id;
    }

    public function setCustomerId(Customer $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }
}
