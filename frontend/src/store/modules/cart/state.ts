import { CartItemInterface } from '@/services/CartService';

export type State = {
   cart: CartItemInterface[] | null;
};

export const state: State = {
   cart: null,
};
