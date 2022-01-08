import { shallowMount } from '@vue/test-utils';
import HomeComponent from '@/views/Home/index.vue';

describe('HomeComponent', () => {
    it('renders without crashing', () => {
        const comp = shallowMount(HomeComponent);
        expect(comp.html()).toMatchSnapshot();
    });
});
