/**
 * Bind context
 *
 * @param fn
 * @param target
 * @returns {Function}
 */
export function bind(fn, target) {
    return function () {
        return fn.apply(target, arguments);
    };
}

/**
 * @param callback
 * @param element
 * @returns {*}
 */
export function requestAnimationFrame(callback, element) {
    var target = window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function (callback, element) {
            return window.setTimeout(callback, 1000 / 60);
        };

    return target(callback, element);
}