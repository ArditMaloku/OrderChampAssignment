<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CartRepositoryInterface;
use App\Models\Cart;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    protected $model;

    public function  __construct(Cart $cart)
    {
        parent::__construct($cart);
    }

    public function findByIdWithItems($cartId)
    {
        return $this->model::with('items')->with(['items.product' => function ($query) {
            $query->select('id', 'name');
        }])->findOrFail($cartId);
    }

    public function findByIdWithCoupon($cartId)
    {
        return $this->model::with('coupon')->findOrFail($cartId);
    }
}
