import router from "../router";

export default class LarabekNavigation {
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
}
