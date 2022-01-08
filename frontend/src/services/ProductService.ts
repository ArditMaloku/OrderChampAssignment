import axios from '@/services/apiClient';
import ProductResponse from '@/types/ProductResponse';

const getProductsApiUrl = 'products';

class ProductService {
   getAll(): Promise<ProductResponse> {
      return axios.get(`${getProductsApiUrl}`);
   }
}

export default new ProductService();
