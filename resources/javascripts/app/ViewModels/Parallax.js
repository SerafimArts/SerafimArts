var Renderer = PIXI.WebGLRenderer;
var Blur = PIXI.filters.BlurFilter;
var Container = PIXI.Container;
var Sprite = PIXI.Sprite;
var Texture = PIXI.Texture;

/**
 * Class Parallax
 */
export default class Parallax {
    highQuality = 5;
    lowQuality = 1;

    /**
     * @type {void|KnockoutObservable<T>}
     */
    quality = ko.observable(this.lowQuality);

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
     * @type {PIXI.Container}
     */
    smoke = new Container();

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
            if (this._scrollY > this.renderer.height) {
                this._scrollY = this.renderer.height;
            }
        }, true);

        context.appendChild(this.renderer.view);

        this._load(this.stage);

        this.stage.addChild(this.smoke);

        this.quality.subscribe(value => {
            var i = 0, len = 0;
            for (i = 0, len = this.stage.children.length; i < len; i++) {
                var sprite = this.stage.getChildAt(i);

                if (sprite.blurFilter) {
                    sprite.blurFilter.passes = value;
                }
            }

            for (i = 0, len = this.smoke.children.length; i < len; i++) {
                this.smoke.getChildAt(i).visible = (value === this.highQuality || i < 10);
            }
        });

        var smoke1 = Texture.fromImage('/img/header/parallax/smoke/smoke-1.png');
        var smoke2 = Texture.fromImage('/img/header/parallax/smoke/smoke-2.png');

        for (var i = 0; i < 50; i++) {
            var sprite              = new Sprite(Math.random() > 0.5 ? smoke1 : smoke2);
            sprite.id               = i;
            sprite.x                = Math.random() * screen.width - 128;
            sprite.y                = Math.random() * 250 + this.renderer.height - 400;
            sprite.visible          = i < 10;
            sprite.movementSpeed    = (Math.random() + .5) * (Math.random() > 0.5 ? -1 : 1);

            this.smoke.addChild(sprite);
        }

        this.smoke.alpha = .5;
        this.smoke.depth = .6;
        this.smoke.shift = {x: 0, y: 0};

        this._render();
    }

    /**
     * @returns {Parallax}
     */
    setLowQuality() {
        this.quality(this.lowQuality);
        return this;
    }

    /**
     * @returns {Parallax}
     */
    setHighQuality() {
        this.quality(this.highQuality);
        return this;
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
        sprite.y = sprite.shift.y + this._scrollY * (sprite.depth - 1) * -1;

        if (sprite.blurFilter) {
            if (sprite.centrize) {
                sprite.x = (this.renderer.width - sprite.width) / 2;
            }
            var delta = Math.abs(this._scrollY * (1 - sprite.depth) / 50);

            if (this.quality() > this.lowQuality && this._scrollY < this.renderer.height) {
                sprite.blurFilter.blur = delta + sprite.depth * 5;
            } else if (this.quality() === this.lowQuality) {
                sprite.blurFilter.blur = 0;
            }
        }

        if (sprite instanceof Container) {
            for (var i = 0, len = sprite.children.length; i < len; i++) {
                var smoke = sprite.getChildAt(i);
                smoke.x += smoke.movementSpeed;

                if (smoke.movementSpeed > 0 && smoke.x > this.renderer.width) {
                    smoke.x = -smoke.width;
                } else if (smoke.movementSpeed < 0 && smoke.x < -smoke.width) {
                    smoke.x = this.renderer.width;
                }
            }
        }
    }

    /**
     * @private
     */
    _load(container:Container) {
        for (var i = 0, len = this.layers.length; i < len; i++) {
            var data = this.layers[i];

            data.item.shift = {x: data.x, y: data.y};
            data.item.depth = data.depth;

            data.item.blurFilter = new Blur;
            data.item.blurFilter.passes = this.quality();
            data.item.filters = [data.item.blurFilter];
            data.item.centrize = !!data.centrize;

            container.addChild(data.item);

            this._updatePosition(data.item);
        }
    }

    get layers() {
        return [
            {
                centrize: true,
                item: new Sprite(Texture.fromImage('/img/header/parallax/bg.jpg')),
                depth: 0,
                x: 0,
                y: 0
            },
            {
                centrize: true,
                item: new Sprite(Texture.fromImage('/img/header/parallax/1.png')),
                depth: .2,
                x: 0,
                y: 86
            },
            {
                centrize: true,
                item: new Sprite(Texture.fromImage('/img/header/parallax/2.png')),
                depth: .3,
                x: 0,
                y: 138
            },
            {
                centrize: true,
                item: new Sprite(Texture.fromImage('/img/header/parallax/3.png')),
                depth: .6,
                x: 0,
                y: 254
            },
            {
                centrize: true,
                item: new Sprite(Texture.fromImage('/img/header/parallax/4.png')),
                depth: .7,
                x: 0,
                y: 503
            },
            {
                centrize: true,
                item: new Sprite(Texture.fromImage('/img/header/parallax/5.png')),
                depth: .8,
                x: 0,
                y: 358
            },
            {
                centrize: true,
                item: new Sprite(Texture.fromImage('/img/header/parallax/6.png')),
                depth: 1,
                x: 0,
                y: 300
            },
            {
                centrize: false,
                item: new Sprite(Texture.fromImage('/img/header/parallax/sun.png')),
                depth: .1,
                x: 0,
                y: 0
            },
            {
                centrize: true,
                item: new Sprite(Texture.fromImage('/img/header/parallax/overlay.png')),
                depth: 1.2,
                x: 0,
                y: -140 // -280
            }
        ];
    }
}