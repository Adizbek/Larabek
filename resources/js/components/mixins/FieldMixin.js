import {LarabekEvents} from "../../core/consts";

export default {
    props: {
        value: {},
        field: {}
    },

    data() {
        return {
            initValue: Object.assign({}, this.value),
            localValue: this.value
        }
    },

    created() {
        Larabek.addListener(LarabekEvents.ResetField, this.onFormReset)
    },

    beforeDestroy() {
        Larabek.removeListener(LarabekEvents.ResetField, this.onFormReset);
    },

    methods: {
        onFormReset() {
            this.localValue = Object.assign({}, this.initValue);
        }
    },

    watch: {
        localValue(val) {
            this.$emit('input', val);
        }
    }
}
