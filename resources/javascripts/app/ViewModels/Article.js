export default class Article {
    /**
     * @type {WeakSet}
     */
    highlightedBlocks = new WeakSet();

    /**
     * Constructor
     */
    constructor() {
        var nodes = document.querySelectorAll('pre > code');
        for (var i = 0; i < nodes.length; i++) {
            nodes[i].setAttribute('class', (nodes[i].classList[0] || '').replace('language-', ''));
            nodes[i].setAttribute('data-bind', 'inview: function(state, value) { highlight(state, value); }')
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
}
