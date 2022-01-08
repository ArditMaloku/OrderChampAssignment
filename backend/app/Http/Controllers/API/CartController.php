<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartAddProductRequest;
use App\Http\Requests\CartCheckoutRequest;
use App\Interfaces\Services\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        return response()->json($this->cartService->create($request), JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $cartId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($cartId)
    {
        $cart = $this->cartService->findByIdWithItems($cartId);

        return response()->json($cart, JsonResponse::HTTP_OK);
    }

    /**
     * Add product to cart.
     *
     * @param  int  $cartId
     * @param  CartAddProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function addProductToCart($cartId, CartAddProductRequest $request)
    {
        return response()->json($this->cartService->addProductToCart($cartId, $request), JsonResponse::HTTP_OK);
    }

    /**
     * Checkout the cart
     * 
     * @param  int  $cartId
     * @param  CartCheckoutRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout($cartId, CartCheckoutRequest $request)
    {
        return response()->json($this->cartService->checkout($cartId, $request), JsonResponse::HTTP_CREATED);
    }
}
