import axios, { AxiosError, AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios';

const apiClient: AxiosInstance = axios.create({
   baseURL: process.env.VUE_APP_BACKEND_URL,
   headers: {
      'Content-type': 'application/json',
   },
});

const onRequest = (config: AxiosRequestConfig): AxiosRequestConfig => {
   const authToken = localStorage.getItem('authToken');
   if (config.headers && authToken) config.headers.Authorization = `Bearer ${authToken}`;

   return config;
};

const onRequestError = (error: AxiosError): Promise<AxiosError> => {
   return Promise.reject(error);
};

const onResponse = (response: AxiosResponse): AxiosResponse => {
   return response.data;
};

const onResponseError = (error: AxiosError): Promise<AxiosError> => {
   return Promise.reject(error);
};

apiClient.interceptors.request.use(onRequest, onRequestError);
apiClient.interceptors.response.use(onResponse, onResponseError);

export default apiClient;
