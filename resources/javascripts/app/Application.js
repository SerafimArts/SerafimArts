import View from "View/View";

export default class Application {
    constructor() {
        this._boot();
    }

    /**
     * @private
     */
    _boot() {
        var nodes = document.querySelectorAll(`[${View.DESCRIPTOR}]`);
        for (var i = 0; i < nodes.length; i++) {
            View.create(nodes[i]).join();
        }
    }
}