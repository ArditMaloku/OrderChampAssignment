import ChangeQuantityType from '@/types/ChangeQuantityType';
import ProductInterface from '@/types/ProductInterface';
import { defineComponent, watch } from '@vue/runtime-core';
import { ref } from '@vue/reactivity';
import CartService, { AddToCartInputInterface } from '@/services/CartService';
import { useStore } from 'vuex';
import StoreNames from '@/store/enums/StoreNames';

export default defineComponent({
   name: 'FlowerComponent',
   props: {
      product: {
         type: Object as () => ProductInterface,
         required: true,
      },
   },
   setup(props) {
      let quantity = ref(0);

      const store = useStore();

      const changeQuantity = (action: ChangeQuantityType) => {
         if (action == ChangeQuantityType.INCREASE) quantity.value++;
         else quantity.value--;

         let addToCartInput: AddToCartInputInterface = {
            quantity: quantity.value,
            product_id: props.product.id,
         };

         const cartId = 1;

         CartService.addToCart(cartId, addToCartInput)
            .then((response: any) => {
               store.state[StoreNames.CART].cart = response;
            })
            .catch((e: Error) => {
               console.log(e);
            });

         localStorage.setItem('cart', JSON.stringify(addToCartInput));
      };

      return { quantity, changeQuantity, ChangeQuantityType };
   },
});
