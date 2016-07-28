import Ribbon from '/View/Ribbon';

/**
 * Class Parallax
 */
export default class Parallax {
    /**
     * @type {KnockoutObservable<T>}
     */
    height = ko.observable(0);

    /**
     * @type {KnockoutObservable<T>}
     */
    visible = ko.observable(false);

    /**
     * @type {boolean}
     */
    scrollDown = true;

    /**
     * @type {number}
     */
    scrollPosition = 0;

    /**
     * @type {boolean}
     */
    scrolledToContent = false;

    /**
     * @type {HTMLDivElement}
     */
    scrollToNode = null;

    /**
     * @type {Array}
     */
    ribbons = [];

    /**
     * @constructor
     */
    constructor(dom) {
        this.height(this.clientHeight);
        this.scrollToNode = dom.querySelector('[data-id=scrollTo]');

        var canvas = dom.querySelector('[data-id=ribbon]');

        canvas.setAttribute('width', this.clientWidth);
        canvas.setAttribute('height', this.clientHeight);

        this.ribbons = [
            new Ribbon(canvas, this.clientWidth, this.clientHeight),
            new Ribbon(canvas, this.clientWidth, this.clientHeight),
            new Ribbon(canvas, this.clientWidth, this.clientHeight),
            new Ribbon(canvas, this.clientWidth, this.clientHeight),
            new Ribbon(canvas, this.clientWidth, this.clientHeight)
        ];

        this.render();

        setTimeout(i => this.visible(true), 500);

        window.addEventListener('scroll', e => {
            var scrollPosition  = window.pageYOffset || document.documentElement.scrollTop;
            this.scrollDown     = this.scrollPosition <= scrollPosition;
            this.scrollPosition = scrollPosition;

            this._checkScroll();
        }, false);
    }

    render() {
        this.ribbons[0].ctx.clearRect(0, 0, this.ribbons[0].width, this.ribbons[0].height);
        this.ribbons[0].ctx.globalAlpha = .9;
        this.ribbons[0].ctx.globalCompositeOperation = 'lighter';
        for (var i = 0; i < this.ribbons.length; i++) {
            this.ribbons[i].render();
        }
        requestAnimationFrame(() => this.render());
    }

    /**
     * @private
     */
    _checkScroll() {
        var padding = 100;

        if (this.scrollPosition > padding && this.scrollDown && !this.scrolledToContent) {
            this.scrolledToContent = true;
            //this._scrollTo(document.body, this.clientHeight, 300);
        } else if (this.scrollPosition < this.clientHeight - padding && !this.scrollDown && this.scrolledToContent) {
            this.scrolledToContent = false;
            //this._scrollTo(document.body, 0, 300);
        }
    }

    /**
     * @param element
     * @param to
     * @param duration
     * @private
     */
    _scrollTo(element, to, duration) {
        var start     = element.scrollTop,
            change    = to - start,
            increment = 20;

        var animateScroll = function (elapsedTime) {
            elapsedTime += increment;
            element.scrollTop = Parallax._easeInOut(elapsedTime, start, change, duration);
            if (elapsedTime < duration) {
                setTimeout(function () {
                    animateScroll(elapsedTime);
                }, increment);
            }
        };

        animateScroll(0);
    }

    /**
     * @param currentTime
     * @param start
     * @param change
     * @param duration
     * @return {*}
     * @private
     */
    static _easeInOut(currentTime, start, change, duration) {
        currentTime /= duration / 2;
        if (currentTime < 1) {
            return change / 2 * currentTime * currentTime + start;
        }
        currentTime -= 1;
        return -change / 2 * (currentTime * (currentTime - 2) - 1) + start;
    }

    /**
     * @return {Number|number}
     */
    get clientHeight() {
        return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    }

    /**
     * @return {Number|number}
     */
    get clientWidth() {
        return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    }
}