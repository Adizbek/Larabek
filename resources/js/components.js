import Vue from 'vue'
import kebabCase from 'lodash/kebabCase'
import * as path from 'path'

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
