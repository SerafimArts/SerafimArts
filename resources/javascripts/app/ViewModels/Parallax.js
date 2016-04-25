import Video from "/Render/Video";

var Renderer = PIXI.WebGLRenderer;
var Blur = PIXI.filters.BlurFilter;
var ColorMatrix = PIXI.filters.ColorMatrixFilter;
var Container = PIXI.Container;
var Sprite = PIXI.Sprite;
var Texture = PIXI.Texture;

/**
 * Class Parallax
 */
export default class Parallax {
    /**
     * @type {Renderer}
     */
    renderer = PIXI.autoDetectRenderer(this.width, 800);

    /**
     * @type {Container}
     */
    stage = new Container;

    /**
     * @type {number}
     * @private
     */
    _scrollY = 0;

    /**
     * @type {number}
     */
    width = 1100;
    
    /**
     * @param context
     */
    constructor(context:HTMLElement) {
        PIXI.utils._saidHello = true;
        this.renderer.backgroundColor = 0x7f776b;

        window.addEventListener('scroll', event => {
            this._scrollY = window.pageYOffset;
        }, true);

        context.appendChild(this.renderer.view);

        this._load(this.stage);

        this._render();
    }

    /**
     * @private
     */
    _render() {
        var i = 0, len = 0;

        requestAnimationFrame(::this._render);

        this.renderer.resize(
            document.body.getBoundingClientRect().width,
            this.renderer.height
        );

        for (i = 0, len = this.stage.children.length; i < len; i++) {
            this._updatePosition(this.stage.getChildAt(i));
        }

        this.renderer.render(this.stage);
    }

    /**
     * @param sprite
     * @private
     */
    _updatePosition(sprite:Sprite) {
        sprite.x = (this.renderer.width - sprite.width) / 2;
        sprite.y = sprite.shift.y + this._scrollY * (sprite.depth - 1) * -1;

        if (sprite.blurFilter && this._scrollY < this.renderer.height) {
            sprite.blurFilter.blur = Math.abs(this._scrollY * (1 - sprite.depth) / 50);
        }
    }

    /**
     * @private
     */
    _load(container:Container) {
        var colorMatrix = new ColorMatrix;
        colorMatrix.matrix = [
            1, 0, 0, .5,
            0, 1, 0, .5,
            0, 0, 1, .5,
            0, 0, 0, 1
        ];

        for (var i = 0, len = this.layers.length; i < len; i++) {
            var data = this.layers[i];

            data.item.shift = {x: data.x, y: data.y};
            data.item.depth = data.depth;

            data.item.blurFilter = new Blur;
            data.item.blurFilter.passes = 2;
            data.item.filters = [data.item.blurFilter];

            container.addChild(data.item);

            this._updatePosition(data.item);
        }
    }

    get layers() {
        return [
            {
                item: new Sprite(Texture.fromImage('/img/header/parallax/bg.jpg')),
                depth: 0,
                x: 0,
                y: 0
            },
            {
                item: new Sprite(Texture.fromImage('/img/header/parallax/1.png')),
                depth: .2,
                x: 0,
                y: 86
            },
            {
                item: new Sprite(Texture.fromImage('/img/header/parallax/2.png')),
                depth: .3,
                x: 0,
                y: 138
            },
            {
                item: new Sprite(Texture.fromImage('/img/header/parallax/3.png')),
                depth: .6,
                x: 0,
                y: 254
            },
            {
                item: new Sprite(Texture.fromImage('/img/header/parallax/4.png')),
                depth: .7,
                x: 0,
                y: 503
            },
            {
                item: new Sprite(Texture.fromImage('/img/header/parallax/5.png')),
                depth: .8,
                x: 0,
                y: 358
            },
            {
                item: new Sprite(Texture.fromImage('/img/header/parallax/6.png')),
                depth: 1,
                x: 0,
                y: 300
            },
            {
                item: new Sprite(Texture.fromImage('/img/header/parallax/overlay.png')),
                depth: 1.2,
                x: 0,
                y: -140 // -280
            }
        ];
    }
}