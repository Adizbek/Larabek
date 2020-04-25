import router from "../router";

export default class LarabekNavigation {
    resolveDetails(entity, id) {
        return router.resolve({
            name: 'details',
            params: {entity, id}
        })
    }

    async openDetails(entity, id) {
        return router.push({
            name: 'details',
            params: {entity, id}
        })
    }

    async openForm(entity, id) {
        return router.push({
            name: 'form',
            params: {entity, id}
        })
    }

    async openSheet(entity) {
        return router.push({
            name: 'sheet',
            params: {entity}
        })
    }
}
