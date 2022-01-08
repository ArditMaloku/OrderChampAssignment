<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CheckoutRepositoryInterface;
use App\Models\Checkout;

class CheckoutRepository extends BaseRepository implements CheckoutRepositoryInterface
{
    protected $model;

    public function  __construct(Checkout $checkout)
    {
        parent::__construct($checkout);
    }
}
