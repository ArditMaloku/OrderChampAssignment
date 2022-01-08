import CartService, { CartInterface } from '@/services/CartService';
import ProductInterface from '@/types/ProductInterface';
import { defineComponent, watch } from '@vue/runtime-core';
import { ref } from '@vue/reactivity';
import { mapMutations, mapState, useStore } from 'vuex';

export default defineComponent({
   name: 'CartComponent',
   setup() {
      const store = useStore();
      const cartId = 1;
      let cart = ref<CartInterface | []>([]);

      CartService.getCart(cartId).then((response: CartInterface) => {
         cart.value = response;
      });

      watch(
         () => store.state.cart.cart,
         (storeCart, prevCount) => {
            cart.value = storeCart;
         },
      );
      const totalNet = () => {
         let totalNet = 0;

         // cart.forEach((product) => {
         //    totalNet += product.price * this.currentExchangeRate * product.quantity;
         // });

         return totalNet;
      };

      return { cart };
   },
});
