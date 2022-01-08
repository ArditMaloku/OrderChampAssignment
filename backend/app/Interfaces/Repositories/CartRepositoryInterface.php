<?php

namespace App\Interfaces\Repositories;

interface CartRepositoryInterface
{
    public function findByIdWithItems($cartId);
    public function findByIdWithCoupon($cartId);
}
