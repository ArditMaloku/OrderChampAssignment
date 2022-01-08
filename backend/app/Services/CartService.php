<?php

namespace App\Services;

use App\Events\CheckoutCompletedEvent;
use App\Exceptions\CartEmptyException;
use App\Exceptions\ProductOutOfStockException;
use App\Http\Requests\CartAddProductRequest;
use App\Http\Requests\CartCheckoutRequest;
use App\Interfaces\Repositories\CartItemRepositoryInterface;
use App\Interfaces\Repositories\CartRepositoryInterface;
use App\Interfaces\Repositories\CheckoutRepositoryInterface;
use App\Interfaces\Repositories\CouponRepositoryInterface;
use App\Interfaces\Repositories\ProductRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\CartServiceInterface;
use Illuminate\Http\Request;

class CartService implements CartServiceInterface
{
    private $cartRepository;
    private $cartItemRepository;
    private $productRepository;
    private $userRepository;
    private $checkoutRepository;
    private $couponRepository;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CartItemRepositoryInterface $cartItemRepository,
        ProductRepositoryInterface $productRepository,
        UserRepositoryInterface $userRepository,
        CheckoutRepositoryInterface $checkoutRepository,
        CouponRepositoryInterface $couponRepository,
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->checkoutRepository = $checkoutRepository;
        $this->couponRepository = $couponRepository;
    }

    public function create(Request $request)
    {
        return $this->cartRepository->create($request->all());
    }

    public function findByIdWithItems($id)
    {
        return $this->cartRepository->findByIdWithItems($id);
    }

    public function addProductToCart($cartId, CartAddProductRequest $request)
    {
        $product = $this->productRepository->findOrFail($request->product_id);
        $quantity = $request->quantity;

        if ($product->stock == 0 || $product->stock < $quantity) {
            throw new ProductOutOfStockException('Product out of stock!');
        }

        $productPrice = $product->sale_price * $quantity;

        $this->updateCartTotal($cartId, $productPrice);

        $existingData = [
            'product_id' => $request->product_id,
            'cart_id' => $cartId,
        ];

        $dataForUpdate = [
            'price' => $productPrice,
            'quantity' => $quantity
        ];

        $this->cartItemRepository->updateOrCreate($existingData, $dataForUpdate);

        return $this->cartRepository->findByIdWithItems($cartId);
    }

    public function checkout($cartId, CartCheckoutRequest $request)
    {
        $user = $this->userRepository->first();
        $couponCode = $request->coupon_code;

        $cart = $this->cartRepository->findByIdWithItems($cartId);

        if ($cart->items->count() <= 0) {
            throw new CartEmptyException('Cart is empty');
        }

        foreach ($cart->items as $key => $cartItem) {
            $product = $this->productRepository->findById($cartItem->product_id);

            if ($product->stock < $cartItem->quantity) {
                throw new ProductOutOfStockException('Product out of stock!');
            }
        }

        $cartUpdateData = array();
        if ($couponCode) {
            $couponId = $this->couponRepository->getCouponByCodeOrFail($couponCode)->id;
            $this->couponRepository->update($couponId, ['used' => true]);
            $cartUpdateData['coupon_id'] = $couponId;
        }

        $cartUpdateData['status'] = 'complete';
        $this->cartRepository->update($cartId, $cartUpdateData);

        $checkout = $this->createCheckout($cart, $user);
        event(new CheckoutCompletedEvent($checkout));

        return $checkout;
    }

    private function updateCartTotal($cartId, $newProductPrice)
    {
        $cart = $this->cartRepository->findByIdWithCoupon($cartId);
        $cartTotal = $this->calculateCartTotal($cart, $newProductPrice);
        $this->cartRepository->update($cartId, ['total' => $cartTotal]);
    }

    private function calculateCartTotal($cart, $newProductPrice)
    {
        $cartTotal = $cart->total + $newProductPrice;

        if (!empty($cart->coupon)) {
            $cartTotal = max(0, $cartTotal - $cart->coupon->amount);
        }

        return $cartTotal;
    }

    private function createCheckout($cart, $user)
    {
        $checkoutObj = [
            'cart_id' => $cart->id,
            'user_id' => $user->id,
            'billing_name' => $user->name,
            'billing_address' => $user->address,
        ];

        return $this->checkoutRepository->create($checkoutObj);
    }
}
