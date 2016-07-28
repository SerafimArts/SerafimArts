
export default class Header {
    /**
     * @type {KnockoutObservable<T>}
     */
    fixed = ko.observable(false);

    /**
     * @constructor
     */
    constructor() {
        var height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

        window.addEventListener('scroll', event => {
            this.fixed(window.pageYOffset > (height - 300));
        });
    }
}