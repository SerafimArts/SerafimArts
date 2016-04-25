export default class Parallax {
    /**
     * @param context
     */
    constructor(context) {
        this._bootScroll(context);
    }

    /**
     * @param context
     * @private
     */
    _bootScroll(context) {
        var prefixes = ['-webkit-transform', '-moz-transform', '-ms-transform', '-o-transform', 'transform'];
        var setTranslation = (layer, movement) => {
            var translate3d = `translate3d(0, ${movement}px, 0)`;
            for (var i = 0; i < prefixes.length; i++) {
                layer.style[prefixes[i]] = translate3d;
            }
        };

        window.addEventListener('scroll', event => {
            var distance = window.pageYOffset;
            var layers = context.querySelectorAll('[data-type=parallax]');

            for (var i = 0, len = layers.length; i < len; i++) {
                var layer = layers[i];
                var depth = layer.getAttribute('data-depth') || 1;
                setTranslation(layer, -(distance * (depth - 1)));
            }
        });
    }
}