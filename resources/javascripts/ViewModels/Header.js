
export default class Header {
    /**
     * @type {KnockoutObservable<T>}
     */
    fixed = ko.observable(false);

    /**
     * @constructor
     */
    constructor() {
        window.addEventListener('scroll', event => {
            this.fixed(window.pageYOffset > 100);
        });
    }
}