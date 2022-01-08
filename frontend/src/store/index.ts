import { createStore } from 'vuex';
import StoreNames from './enums/StoreNames';
import CartModule from './modules/cart';

export default createStore({
   modules: {
      [StoreNames.CART]: CartModule,
   },
});
