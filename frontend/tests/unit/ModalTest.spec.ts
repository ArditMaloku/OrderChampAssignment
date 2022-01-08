import { mount, shallowMount } from '@vue/test-utils';
import ModalComponent from '@/components/shared/Modal/index.vue';
import LoginComponent from '@/components/Login/index.vue';
import { Form } from 'vee-validate';

describe('LoginComponent', () => {
    it('renders modal', async () => {
        const wrapper = mount(LoginComponent);
        await wrapper.find('a').trigger('click');

        expect(wrapper.text()).toContain('Welcome Back');
    });
    it('renders form', async () => {
        const wrapper = mount(LoginComponent);
        await wrapper.find('a').trigger('click');

        expect(wrapper.findAll('form')).toHaveLength(1);
    });
});
