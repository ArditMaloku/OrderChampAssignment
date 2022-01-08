import { ActionContext, ActionTree } from 'vuex';
import { Mutations } from './mutations';
import { State } from './state';

export enum CartActionTypes {
   SET_CART = 'SET_CART',
}

type ActionAugments = Omit<ActionContext<State, State>, 'commit'> & {
   commit<K extends keyof Mutations>(key: K, payload: Parameters<Mutations[K]>[1]): ReturnType<Mutations[K]>;
};

export type Actions = {
   [CartActionTypes.SET_CART](context: ActionAugments): void;
};

export const actions: ActionTree<State, State> = {
   [CartActionTypes.SET_CART]({ commit }): void {},
};
