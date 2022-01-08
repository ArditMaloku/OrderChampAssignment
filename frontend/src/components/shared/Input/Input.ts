import { defineComponent } from '@vue/runtime-core';
import { useField } from 'vee-validate';

export default defineComponent({
    name: 'InputComponent',
    props: {
        type: {
            type: String,
            default: 'text',
        },
        value: {
            type: String,
            default: '',
        },
        name: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
        successMessage: {
            type: String,
            default: '',
        },
        placeholder: {
            type: String,
            default: '',
        },
    },
    setup(props) {
        const {
            value: inputValue,
            errorMessage,
            handleBlur,
            handleChange,
            meta,
        } = useField(props.name, undefined, {
            initialValue: props.value,
        });

        return {
            handleChange,
            handleBlur,
            errorMessage,
            inputValue,
            meta,
        };
    },
});
