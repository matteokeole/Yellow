<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContentRepository::class)
 */
class Content
{
    /**
    * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $content_product_quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Basket::class, inversedBy="contents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $basket;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentProductQuantity(): ?int
    {
        return $this->content_product_quantity;
    }

    public function setContentProductQuantity(int $content_product_quantity): self
    {
        $this->content_product_quantity = $content_product_quantity;

        return $this;
    }

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): self
    {
        $this->basket = $basket;

        return $this;
    }
}
