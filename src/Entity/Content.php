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
     * @ORM\OneToOne(targetEntity=Basket::class)
     */
    private $basket;

    /**
     * @ORM\OneToOne(targetEntity=Product::class)
     */
    private $product;

    public function __construct()
    {
        $this->basket = new ArrayCollection();
        $this->product = new ArrayCollection();
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

    /**
     * @return Collection|Basket[]
     */
    public function getBasketId(): Collection
    {
        return $this->basket;
    }

    public function addBasketId(Basket $basketId): self
    {
        if (!$this->basket->contains($basketId)) {
            $this->basket[] = $basketId;
        }

        return $this;
    }

    public function removeBasketId(Basket $basketId): self
    {
        $this->basket->removeElement($basketId);

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProductId(): Collection
    {
        return $this->product;
    }

    public function addProductId(Product $productId): self
    {
        if (!$this->product->contains($productId)) {
            $this->product[] = $productId;
        }

        return $this;
    }

    public function removeProductId(Product $productId): self
    {
        $this->product->removeElement($productId);

        return $this;
    }
}
