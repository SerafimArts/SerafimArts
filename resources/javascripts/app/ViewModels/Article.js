export default class Article {
    /**
     * @type {WeakSet}
     */
    highlightedBlocks = new WeakSet();

    /**
     * @type {WeakMap}
     */
    videoBlocks = new WeakMap();

    /**
     * Constructor
     */
    constructor() {
        var nodes = [];
        var i = 0;

        nodes = document.querySelectorAll('pre > code');
        for (i = 0; i < nodes.length; i++) {
            nodes[i].setAttribute('class', (nodes[i].classList[0] || '').replace('language-', ''));
            nodes[i].setAttribute('data-bind', 'inview: function(state, value) { highlight(state, value); }')
        }

        nodes = document.querySelectorAll('iframe');
        for (i = 0; i < nodes.length; i++) {
            this.videoBlocks.set(nodes[i], nodes[i].getAttribute('src'));
            nodes[i].setAttribute('src', '');
            nodes[i].setAttribute('data-bind', 'inview: function(state, value) { loadVideo(state, value); }')
        }
    }

    /**
     * @param {HTMLElement} node
     * @param {bool} state
     */
    highlight(node, state) {
        if (state && !this.highlightedBlocks.has(node)) {
            this.highlightedBlocks.add(node);
            hljs.highlightBlock(node);
        }
    }

    /**
     * @param {HTMLElement} node
     * @param {bool} state
     */
    loadVideo(node, state) {
        if (state && !node.getAttribute('src')) {
            node.setAttribute('src', this.videoBlocks.get(node));
        }
    }
}
