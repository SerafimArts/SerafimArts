const RIBBON_SIZE = 120;
const RIBBON_COUNT = 5;

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
    movementY = .5;

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
    size = RIBBON_SIZE;

    /**
     * @type {Point}
     */
    point1 = null;

    /**
     * @type {Point}
     */
    point2 = null;

    /**
     * @type {number}
     */
    percentage = 0;


    /**
     * @param point1
     * @param point2
     * @param percentage
     */
    constructor(point1, point2, percentage) {
        this.point1 = point1;
        this.point2 = point2;
        this.percentage = percentage;
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

        var delta = Math.floor((Math.abs(this.point1.y - this.point2.y) / this.percentage) * 100);

        if (this.nextRender()) {
            ctx.fillStyle = `rgb(255, ${delta}, ${delta})`;
        } else {
            ctx.fillStyle = `rgb(${delta + 100}, 0, 0)`;
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
     * @type {Array|Point[]}
     */
    points = [];

    /**
     * @type {number}
     */
    pointsCount = RIBBON_COUNT;

    /**
     * @type {Array}
     */
    vectors = [];

    /**
     * @type {number}
     */
    minTop = 0;

    /**
     * @type {number}
     */
    maxTop = 0;

    /**
     * @param canvas
     * @param width
     * @param height
     */
    constructor(canvas, width, height) {
        this.ctx = canvas.getContext('2d');
        this.width = width;
        this.height = height;

        this.minTop = height / 2 - (height / 10);
        this.maxTop = height / 2 + (height / 10);

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

        points.push(new Point(-RIBBON_SIZE * 2, this.height / 2, false));

        for (var i = 0; i < this.pointsCount; i++) {
            var point = new Point(
                Point.rand(chunk * i, chunk * (i + 1)),
                Point.rand(this.minTop, this.maxTop)
            );
            points.push(point);
        }

        points.push(new Point(this.width + RIBBON_SIZE * 2, this.height / 2, false));

        return points;
    }

    /**
     * @return {Array|Vector2[]}
     * @private
     */
    _makeVectors() {
        var vectors = [];

        for (var i = 1; i < this.points.length; i++) {
            var vector = new Vector2(this.points[i - 1], this.points[i], this.maxTop - this.minTop);
            vectors.push(vector);
        }

        return vectors;
    }

    /**
     * @private
     */
    render() {
        var i = 0;
        for (i = 0; i < this.points.length; i++) {
            this.points[i].y += this.points[i].movementY;
            this.points[i].x += this.points[i].movementX;

            if (this.points[i].y < this.minTop) {
                this.points[i].y = this.minTop + 1;
                this.points[i].randomizeMovement();
            } else if (this.points[i].y > this.maxTop) {
                this.points[i].y = this.maxTop - 1;
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
            this.vectors[i].render(this.ctx);
        }
    }
}