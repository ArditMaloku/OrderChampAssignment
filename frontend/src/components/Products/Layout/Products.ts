import ProductInterface from '@/types/ProductInterface';
import ProductItem from '../Item/index.vue';
import { ref } from '@vue/reactivity';
import ProductService from '@/services/ProductService';
import { defineComponent } from '@vue/runtime-core';

export default defineComponent({
   name: 'ProductsLayout',
   setup() {
      const products = ref<ProductInterface[]>([]);

      ProductService.getAll()
         .then((response: any) => {
            products.value = response;
         })
         .catch((e: Error) => {
            console.log(e);
         });

      return { products };
   },
   components: {
      ProductItem,
   },
});
