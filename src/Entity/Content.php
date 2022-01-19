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
     * @ORM\Column(type="integer")
     */
    private $content_product_quantity;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class)
     */
    private $product_id;

    /**
     * @ORM\ManyToMany(targetEntity=Basket::class)
     */
    private $basket_id;

    public function __construct()
    {
        $this->product_id = new ArrayCollection();
        $this->basket_id = new ArrayCollection();
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
     * @return Collection|Product[]
     */
    public function getProductId(): Collection
    {
        return $this->product_id;
    }

    public function addProductId(Product $productId): self
    {
        if (!$this->product_id->contains($productId)) {
            $this->product_id[] = $productId;
        }

        return $this;
    }

    public function removeProductId(Product $productId): self
    {
        $this->product_id->removeElement($productId);

        return $this;
    }

    /**
     * @return Collection|Basket[]
     */
    public function getBasketId(): Collection
    {
        return $this->basket_id;
    }

    public function addBasketId(Basket $basketId): self
    {
        if (!$this->basket_id->contains($basketId)) {
            $this->basket_id[] = $basketId;
        }

        return $this;
    }

    public function removeBasketId(Basket $basketId): self
    {
        $this->basket_id->removeElement($basketId);

        return $this;
    }
}
