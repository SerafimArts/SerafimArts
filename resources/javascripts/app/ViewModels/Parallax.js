/**
 * Class Parallax
 */
export default class Parallax {
    /**
     * @type {number}
     */
    height = 800;

    /**
     * @type {Map}
     */
    nodes = new Map();

    /**
     * @type {string}
     */
    text = ko.observable('');

    /**
     * @type {Array}
     */
    lines = ko.observableArray([]);

    /**
     * @param context
     */
    constructor(context:HTMLElement) {
        var nodes = context.querySelectorAll('[data-depth]');
        for (var i = 0; i < nodes.length; i++) {
            var node = nodes[i];
            this.nodes.set(node, parseFloat(node.getAttribute('data-depth')));
        }

        window.addEventListener('scroll', event => {
           this.checkScroll();
        }, true);
        this.checkScroll();

        setTimeout(() => {
            for (var i = 0; i < 20; i++) {
                this.lines.push(Math.random());
            }
        }, 100);

        setTimeout(() => {
            var message  = ' In Laravel we trust ';
            var interval = setInterval(() => {
                if (this.text().length < message.length) {
                    this.text(this.text() + message.charAt(this.text().length));
                } else {
                    setTimeout(() => {
                        this.text(this.text() + '=');
                        setTimeout(() => {
                            this.text(this.text() + ')');

                            setTimeout(() => {
                                this.text('/' + this.text());
                                setTimeout(() => { this.text('/' + this.text()); }, 200);
                            }, 700);

                        }, 200);
                    }, 500);
                    clearInterval(interval);
                }
            }, 100);
        }, 2000);
    }

    /**
     * @return {void}
     */
    checkScroll() {
        var scrollY = window.pageYOffset;
        if (scrollY > this.height) {
            scrollY = this.height;
        }

        this.setPosition(scrollY);
    }

    /**
     * @param y
     * @return {void}
     */
    setPosition(y) {
        this.nodes.forEach((depth, node) => {
            node.style.top = `${y * depth}px`;
        });
    }
}