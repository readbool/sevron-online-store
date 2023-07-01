<?php

declare(strict_types=1);

namespace App\Services\Product\Resources;

final class ProductResource
{
    private ?string $id = null;
    private ?string $name = null;
    private ?string $detail = null;
    private ?string $sku = null;
    private ?string $price = null;

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setDetail(?string $detail): void
    {
        $this->detail = $detail;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }

    public function setSku(?string $sku): void
    {
        $this->sku = $sku;
    }
}
