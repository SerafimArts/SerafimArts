
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
    }
}