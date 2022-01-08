<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CouponRepositoryInterface;
use App\Models\Coupon;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{
    protected $model;

    public function  __construct(Coupon $coupon)
    {
        parent::__construct($coupon);
    }

    public function getCouponByCode($code)
    {
        return $this->model->where('code', $code)->first();
    }

    public function getCouponByCodeOrFail($code)
    {
        return $this->model->where('code', $code)->firstOrFail();
    }
}
