<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CartItemRepositoryInterface;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemRepository extends BaseRepository implements CartItemRepositoryInterface
{
    protected $model;

    public function  __construct(CartItem $cartItem)
    {
        parent::__construct($cartItem);
    }
}
