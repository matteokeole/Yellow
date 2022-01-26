<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $product_name;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $product_author;

    /**
     * @ORM\Column(type="integer")
     */
    private $product_date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $product_desc;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $product_cover;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=2)
     */
    private $product_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $product_stock;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $product_category;

    /**
     * @ORM\OneToMany(targetEntity=Content::class, mappedBy="product", orphanRemoval=true)
     */
    private $contents;

    /**
     * @ORM\OneToMany(targetEntity=ContentOrder::class, mappedBy="product", orphanRemoval=true)
     */
    private $contentOrders;

    public function __construct()
    {
        $this->contents = new ArrayCollection();
        $this->contentOrders = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->product_name . $this->product_category . $this->product_price;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getProductAuthor(): ?string
    {
        return $this->product_author;
    }

    public function setProductAuthor(string $product_author): self
    {
        $this->product_author = $product_author;

        return $this;
    }

    public function getProductDate(): ?int
    {
        return $this->product_date;
    }

    public function setProductDate(int $product_date): self
    {
        $this->product_date = $product_date;

        return $this;
    }

    public function getProductDesc(): ?string
    {
        return $this->product_desc;
    }

    public function setProductDesc(?string $product_desc): self
    {
        $this->product_desc = $product_desc;

        return $this;
    }

    public function getProductCover(): ?string
    {
        return $this->product_cover;
    }

    public function setProductCover(?string $product_cover): self
    {
        $this->product_cover = $product_cover;

        return $this;
    }

    public function getProductPrice(): ?string
    {
        return $this->product_price;
    }

    public function setProductPrice(string $product_price): self
    {
        $this->product_price = $product_price;

        return $this;
    }

    public function getProductStock(): ?int
    {
        return $this->product_stock;
    }

    public function setProductStock(int $product_stock): self
    {
        $this->product_stock = $product_stock;

        return $this;
    }

    public function getProductCategory(): ?string
    {
        return $this->product_category;
    }

    public function setProductCategory(?string $product_category): self
    {
        $this->product_category = $product_category;

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getContents(): Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): self
    {
        if (!$this->contents->contains($content)) {
            $this->contents[] = $content;
            $content->setProduct($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->contents->removeElement($content)) {
            // set the owning side to null (unless already changed)
            if ($content->getProduct() === $this) {
                $content->setProduct(null);
            }
        }

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
            $contentOrder->setProduct($this);
        }

        return $this;
    }

    public function removeContentOrder(ContentOrder $contentOrder): self
    {
        if ($this->contentOrders->removeElement($contentOrder)) {
            // set the owning side to null (unless already changed)
            if ($contentOrder->getProduct() === $this) {
                $contentOrder->setProduct(null);
            }
        }

        return $this;
    }
}
