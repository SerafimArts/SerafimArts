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
     * @type {KnockoutObservable<T>}
     */
    hidden = ko.observable(false);

    /**
     * @type {HTMLVideoElement}
     */
    video = null;

    /**
     * @type {CanvasRenderingContext2D}
     */
    ctx = null;

    /**
     * @type {Image}
     */
    bg = null;

    /**
     * @constructor
     */
    constructor(dom) {
        this.video = dom.querySelector('[data-id=video]');
        this.video.play();
        this.video.loop = true;

        this.height(this.clientHeight);
        this.scrollToNode = dom.querySelector('[data-id=scrollTo]');

        var canvas = dom.querySelector('[data-id=ribbon]');

        canvas.setAttribute('width', this.clientWidth);
        canvas.setAttribute('height', this.clientHeight);

        this.ctx = canvas.getContext('2d');

        this.bg = document.createElement('img');
        this.bg.src = '/img/parallax/bg.png';

        this.ribbons = [
            new Ribbon(canvas, this.clientWidth, this.clientHeight),
            new Ribbon(canvas, this.clientWidth, this.clientHeight),
            new Ribbon(canvas, this.clientWidth, this.clientHeight),
            new Ribbon(canvas, this.clientWidth, this.clientHeight),
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
        //this.ribbons[0].ctx.clearRect(0, 0, this.ribbons[0].width, this.ribbons[0].height);
        this.ctx.drawImage(this.bg, 0, 0, this.ctx.canvas.width, this.ctx.canvas.height);

        this.ctx.save();
        this.ctx.globalAlpha = .9;
        for (var i = 0; i < this.ribbons.length; i++) {
            if (i > 1) {
                this.ctx.globalCompositeOperation = 'lighter';
            }
            this.ribbons[i].render();
        }
        this.ctx.restore();

        this.ctx.save();
        this.ctx.globalCompositeOperation = 'lighter';
        this.ctx.drawImage(this.video, 0, 0, this.ctx.canvas.width, this.ctx.canvas.height);
        this.ctx.restore();

        requestAnimationFrame(() => this.render());
    }

    /**
     * @private
     */
    _checkScroll() {
        var padding = 10;

        if (this.scrollPosition > padding && this.scrollDown && !this.scrolledToContent) {
            setTimeout(() => {
                this.scrolledToContent = true;
            }, 500);
            this.hidden(this.clientHeight - 250);
        } else if (this.scrollPosition < 10 && !this.scrollDown && this.scrolledToContent) {
            setTimeout(() => {
                this.scrolledToContent = false;
            }, 500);
            this.hidden(0);
        }
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