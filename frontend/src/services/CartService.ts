import axios from '@/services/apiClient';

export interface AddToCartInputInterface {
   quantity: number;
   product_id: number;
}

export interface CartItemInterface {
   id: number;
   product_id: number;
   cart_id: number;
   quantity: number;
   price: number;
}

export interface CartInterface {
   id: number;
   user_id: number | null;
   coupon_id: string | null;
   total: string;
   status: string;
   items: CartItemInterface;
}

const cartApiUrl = 'carts/';

const addToCartApiUrl = 'addProductToCart/';

class CartService {
   addToCart(cartId: number, addToCartInput: AddToCartInputInterface): Promise<CartItemInterface[]> {
      return axios.post(cartApiUrl + addToCartApiUrl + cartId, addToCartInput);
   }
   getCart(cartId: number): Promise<CartInterface> {
      return axios.get(cartApiUrl + cartId);
   }
}

export default new CartService();
