<?php

namespace App\Interfaces\Services;

use App\Http\Requests\CartAddProductRequest;
use App\Http\Requests\CartCheckoutRequest;
use Illuminate\Http\Request;

interface CartServiceInterface
{
    public function create(Request $request);
    public function findByIdWithItems($id);
    public function addProductToCart($cartId, CartAddProductRequest $request);
    public function checkout($cartId, CartCheckoutRequest $request);
}
