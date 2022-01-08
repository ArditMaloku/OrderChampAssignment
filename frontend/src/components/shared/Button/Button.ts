import { defineComponent } from '@vue/runtime-core';

export default defineComponent({
    name: 'ButtonComponent',
    props: {
        buttonText: {
            type: String,
            required: true,
        },
        loading: {
            type: Boolean,
            default: false,
        },
    },
});
