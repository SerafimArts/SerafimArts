
export default class Billets {
    /**
     * @type {WeakSet}
     */
    billetsList = new WeakSet();

    /**
     * @param dom
     */
    constructor(dom) {
        var list = dom.querySelector('[data-id=billets-list]');
        var nav = dom.querySelector('[data-id=billets-nav]');

        window.addEventListener('scroll', event => {
            window.requestAnimationFrame(() => Billets.checkScroll(list, nav));
        }, true);
        Billets.checkScroll(list, nav);
    }

    /**
     * @param {HTMLElement} list
     * @param {HTMLElement} nav
     */
    static checkScroll(list, nav) {
        var scrollY = window.pageYOffset - 50;

        if (
            scrollY > 0 &&
            nav.getBoundingClientRect().height + scrollY < nav.parentElement.getBoundingClientRect().height
        ) {
            list.style.marginTop = `-${parseInt(scrollY / 2)}px`;
            nav.style.marginTop = `${scrollY}px`;
        } else if (scrollY <= 0) {
            list.style.marginTop = `0px`;
            nav.style.marginTop = `0px`;
        }
    }

    /**
     * @param {HTMLElement} node
     * @param {bool} state
     */
    showBillet(node, state) {
        if (state && !this.billetsList.has(node)) {
            this.billetsList.add(node);
            node.classList.add('visible');
        }
    }

    /**
     * @param node
     * @returns {boolean}
     */
    isVisible(node) {
        return this.billetsList.has(node);
    }
}