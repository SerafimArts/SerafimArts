import Ribbon from "/View/Ribbon";

/**
 * Class Parallax
 */
export default class Parallax {
    /**
     * @type {KnockoutObservable<T>}
     */
    height = ko.observable(0);

    /**
     * @constructor
     */
    constructor(dom) {
        this.height(this.clientHeight);

        var ribbon = new Ribbon(dom.querySelector('[data-id=ribbon]'), this.clientWidth, this.clientHeight);
        ribbon.render();
    }

    get clientHeight() {
        return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    }

    get clientWidth() {
        return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    }
}