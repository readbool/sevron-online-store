<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Product extends Model
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'detail',
        'sku',
        'price',
    ];

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getDetail(): string
    {
        return $this->getAttribute('detail');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getPrice(): string
    {
        return $this->getAttribute('price');
    }

    public function getSKU(): string
    {
        return $this->getAttribute('sku');
    }

    public function setDetail(string $detail): self
    {
        $this->setAttribute('detail', $detail);

        return $this;
    }

    public function setName(string $name): self
    {
        $this->setAttribute('name', $name);

        return $this;
    }

    public function setPrice(string $price): self
    {
        $this->setAttribute('price', $price);

        return $this;
    }

    public function setSKU(string $sku): self
    {
        $this->setAttribute('sku', $sku);

        return $this;
    }
}
