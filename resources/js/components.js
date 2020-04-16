import Vue from 'vue'
import kebabCase from 'lodash/kebabCase'


Vue.component('details-field', require('./components/fields/DetailsField'))
Vue.component('form-field', require('./components/fields/FormField'))

const requireComponent = require.context(
    './components/fields/',
    true,
    /[A-Z]\w+\.(vue|js)$/
);

requireComponent.keys().forEach(fileName => {
    const componentConfig = requireComponent(fileName);

    const componentName = kebabCase(
        componentConfig.default.name
    );

    Vue.component(
        componentName,
        componentConfig.default || componentConfig
    )
});
