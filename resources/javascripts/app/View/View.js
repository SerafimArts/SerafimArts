
export default class View {
    static DESCRIPTOR = 'data-vm';

    /**
     * @type {HTMLElement}
     */
    dom = null;

    /**
     * @type {Function}
     */
    controller = null;
    
    /**
     * @param {HTMLElement} node
     * @returns {View}
     */
    static create(node) {
        var name = node.getAttribute(this.DESCRIPTOR);
        return new this(node, require('ViewModels/' + name).default);
    }

    /**
     * @param {HTMLElement} dom
     * @param {Function} controller
     */
    constructor(dom, controller) {
        this.dom = dom;
        this.controller = controller;
    }

    /**
     * @returns {Promise}
     */
    join() {
        ko.applyBindings(new this.controller(this.dom), this.dom);
    }
}