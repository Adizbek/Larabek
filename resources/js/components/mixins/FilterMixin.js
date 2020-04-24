export default {
    props: {
        value: {},
        filter: {}
    },

    data() {
        return {
            currentValue: [this.value, this.filter.value, this.filter.defaultValue].find(x => x !== null && x !== undefined)
        }
    },

    computed: {
        filterData() {
            return this.filter.data;
        }
    },

    watch: {
        currentValue: {
            deep: true,
            handler(val) {
                this.$emit('input', val)
            }
        }
    }
}
