import { CartItemInterface } from '@/services/CartService';
import { MutationTree } from 'vuex';
import { State } from './state';

export enum CartMutationType {
   SET_CART = 'SET_CART',
}

export type Mutations = {
   [CartMutationType.SET_CART](state: State, Cart: CartItemInterface[]): void;
};

export const mutations: MutationTree<State> & Mutations = {
   [CartMutationType.SET_CART](state, Cart) {
      state.cart = Cart;
   },
};
