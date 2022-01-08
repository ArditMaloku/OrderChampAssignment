import { State, state } from './state';
import { mutations } from './mutations';
import { getters } from './getters';
import { actions } from './actions';
import { Module } from 'vuex';

const CartModule: Module<State, State> = {
   namespaced: true,
   state,
   mutations,
   actions,
   getters,
};

export default CartModule;
