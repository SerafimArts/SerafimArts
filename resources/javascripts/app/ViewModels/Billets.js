
export default class Billets {
    constructor(dom) {
        var nodes = document.querySelectorAll('[data-id=billet]');
        for (var i = 0; i < nodes.length; i++) {
            ((i) => {
                setTimeout(() => {
                    nodes[i].classList.add('visible');
                }, i * 300);
            })(i);
        }

        var list = dom.querySelector('[data-id=billets-list]');
        var nav = dom.querySelector('[data-id=billets-nav]');

        window.addEventListener('scroll', event => {
            Billets.checkScroll(list, nav);
        }, true);
        Billets.checkScroll(list, nav);
    }

    /**
     * @param {HTMLElement} list
     * @param {HTMLElement} nav
     */
    static checkScroll(list, nav) {
        var scrollY = window.pageYOffset - 300;

        if (scrollY > 0) {
            if (nav.getBoundingClientRect().height + scrollY < nav.parentElement.getBoundingClientRect().height) {
                list.style.marginTop = `-${scrollY / 2}px`;
                nav.style.marginTop = `${scrollY}px`;
            }
        }
    }
}