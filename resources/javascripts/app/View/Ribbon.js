class Point {
    /**
     * @type {number}
     */
    x = 0;

    /**
     * @type {number}
     */
    y = 0;

    /**
     * @type {number[]}
     */
    movementY = 0;

    /**
     * @type {number[]}
     */
    movementX = 0;

    /**
     * @type {boolean}
     */
    movement = true;

    /**
     * @param x
     * @param y
     * @param movement
     */
    constructor(x, y, movement = true) {
        this.x = x;
        this.y = y;
        this.movement = movement;
        this.randomizeMovement();
    }

    /**
     * @return void
     */
    randomizeMovement() {
        if (this.movement) {
            var movement   = (Math.random() - .5) * 5;
            this.movementY = movement < 0 ? movement - .1 : movement + .1;

            //movement       = (Math.random() - .5) * 5;
            //this.movementX = movement < 0 ? movement - .1 : movement + .1;
        }
    }

    /**
     * @param {float} min
     * @param {float} max
     * @return {float}
     */
    static rand(min, max) {
        return Math.random() * (max - min) + min;
    }

    /**
     * @param dist
     * @param theta
     * @return {*[]}
     */
    moved(dist, theta) {
        return [
            this.x + dist * Math.cos(theta),
            this.y + dist * Math.sin(theta),
        ];
    }
}


class Vector2 {
    /**
     * @type {number}
     */
    size = 80;

    /**
     * @type {Point}
     */
    point1 = null;

    /**
     * @type {Point}
     */
    point2 = null;

    /**
     * @param point1
     * @param point2
     */
    constructor(point1, point2) {
        this.point1 = point1;
        this.point2 = point2;
    }

    /**
     * @return {boolean}
     */
    nextRender() {
        return this.point1.y < this.point2.y;
    }

    /**
     * @param {CanvasRenderingContext2D} ctx
     */
    render(ctx) {
        var size1 = this.size,
            size2 = this.size,
            size3 = this.size,
            size4 = this.size;

        if (this.nextRender()) {
            ctx.fillStyle = '#f00';
        } else {
            ctx.fillStyle = '#a00';
        }

        if (!this.point1.movement) {
            size1 = 0;
            size2 = this.size * 2;
        }

        if (!this.point2.movement) {
            size4 = 0;
            size3 = this.size * 2;
        }

        ctx.beginPath();
        ctx.moveTo(this.point1.x - size2, this.point1.y);
        ctx.lineTo(this.point1.x - size2, this.point1.y);
        ctx.lineTo(this.point1.x + size1, this.point1.y);
        ctx.lineTo(this.point2.x + size3, this.point2.y);
        ctx.lineTo(this.point2.x - size4, this.point2.y);

        ctx.closePath();

        ctx.fill();
    }
}


export default class Ribbon {
    /**
     * @type {CanvasRenderingContext2D}
     */
    ctx = null;

    /**
     * @type {number}
     */
    width = 0;

    /**
     * @type {number}
     */
    height = 0;

    /**
     * @type {boolean}
     */
    rendered = false;

    /**
     * @type {Array|Point[]}
     */
    points = [];

    /**
     * @type {number}
     */
    pointsCount = 10;

    /**
     * @type {Array}
     */
    vectors = [];

    /**
     * @param canvas
     * @param width
     * @param height
     */
    constructor(canvas, width, height) {
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);

        this.ctx = canvas.getContext('2d');
        this.width = width;
        this.height = height;

        this.points = this._makePoints();
        this.vectors = this._makeVectors();
    }

    /**
     * @return {Array}
     * @private
     */
    _makePoints() {
        var points = [];
        var chunk = (this.width / this.pointsCount);

        points.push(new Point(0, this.height / 2, false));

        for (var i = 0; i < this.pointsCount; i++) {
            var point = new Point(Point.rand(chunk * i, chunk * (i + 1)), Point.rand(0, this.height));
            points.push(point);
        }

        points.push(new Point(this.width, this.height / 2, false));

        return points;
    }

    /**
     * @return {Array|Vector2[]}
     * @private
     */
    _makeVectors() {
        var vectors = [];

        for (var i = 1; i < this.points.length; i++) {
            var vector = new Vector2(this.points[i - 1], this.points[i]);
            vectors.push(vector);
        }

        return vectors;
    }

    /**
     * @return {Ribbon}
     */
    render() {
        if (this.rendered === false) {
            this.rendered = true;
            this._draw();
        }
        return this;
    }

    /**
     * @private
     */
    _draw() {
        var i = 0;
        this.ctx.clearRect(0, 0, this.width, this.height);

        for (i = 0; i < this.points.length; i++) {
            this.points[i].y += this.points[i].movementY;
            this.points[i].x += this.points[i].movementX;

            if (this.points[i].y < 0) {
                this.points[i].y = 1;
                this.points[i].randomizeMovement();
            } else if (this.points[i].y > this.height) {
                this.points[i].y = this.height - 1;
                this.points[i].randomizeMovement();
            }

            if (this.points[i].x < 0) {
                this.points[i].x = 1;
                this.points[i].randomizeMovement();
            } else if (this.points[i].x > this.width) {
                this.points[i].x = this.width - 1;
                this.points[i].randomizeMovement();
            }
        }

        for (i = 0; i < this.vectors.length; i++) {
            if (!this.vectors[i].nextRender()) {
                this.vectors[i].render(this.ctx);
            }
        }

        for (i = 0; i < this.vectors.length; i++) {
            if (this.vectors[i].nextRender()) {
                this.vectors[i].render(this.ctx);
            }
        }

        if (this.rendered) {
            requestAnimationFrame(() => this._draw());
        }
    }
}