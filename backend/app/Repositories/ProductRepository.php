<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $model;

    public function  __construct(Product $product)
    {
        parent::__construct($product);
    }
}
