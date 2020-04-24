import Vue from 'vue';


class LToast {
    toaster;

    show(variant, title, text) {
        this.toaster.$bvToast.toast(text, {
            title,
            variant: variant,
            solid: true
        })
    }
}

export default new LToast()
