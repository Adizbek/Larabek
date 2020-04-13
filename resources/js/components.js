import Vue from 'vue'
import kebabCase from 'lodash/kebabCase'

const requireComponent = require.context(
    './components/listFields',
    false,
    /[A-Z]\w+\.(vue|js)$/
);

requireComponent.keys().forEach(fileName => {
    const componentConfig = requireComponent(fileName);


    const componentName = kebabCase(
        fileName
            .split('/')
            .pop()
            .replace(/\.\w+$/, '')
    );

    Vue.component(
        componentName,
        componentConfig.default || componentConfig
    )
});
