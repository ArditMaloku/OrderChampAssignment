<?php

namespace App\Interfaces\Repositories;

interface CouponRepositoryInterface
{
    public function getCouponByCode($code);
    public function getCouponByCodeOrFail($code);
}
