import { GetterTree } from 'vuex';
import { State } from './state';
import { CartItemInterface } from '@/services/CartService';

export type CartGetters = {
   getCart(state: State): () => CartItemInterface[] | null;
};

export const getters: GetterTree<State, State> & CartGetters = {
   getCart: (state) => () => {
      return state.cart;
   },
};
