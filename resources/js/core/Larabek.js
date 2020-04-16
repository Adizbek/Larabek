import LarabekNavigation from "./LarabekNavigation";

class Larabek {
    /** @type LarabekListener[] */
    listeners = [];

    /** @type LarabekNavigation */
    navigation = new LarabekNavigation();

    /**
     * @param {number} type
     * @param {function} handler
     */
    addListener(type, handler) {
        this.listeners.push({
            type,
            handler
        })
    }

    /**
     * @param {number} type
     * @param {function} handler
     */
    removeListener(type, handler) {
        this.listeners = this.listeners.filter(l => {
            return !(l.type === type && l.handler === handler)
        })
    }

    /**
     * @param {number} type
     * @param args
     */
    emit(type, ...args) {
        this.listeners
            .filter(l => l.type === type)
            .map(l => l.handler(...args))
    }
}

const larabek = new Larabek();

window.Larabek = larabek;

export default larabek;
