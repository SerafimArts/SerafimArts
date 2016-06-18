import View from "View/View";
import InView from "Ko/Inview";

export default class Application {
    constructor() {
        ko.bindingHandlers.inview = InView(ko);

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