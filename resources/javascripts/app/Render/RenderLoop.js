import {requestAnimationFrame as animationFrame} from "/Support/helpers";

/**
 * Main render loop object
 */
export default class RenderLoop {
    /**
     * @constructor
     */
    constructor() {
        this.speed              = 1;
        this.callbacks          = [];
        this.lastTimeSnapshot   = 0;
        this.delta              = 0;
        this.paused             = true;
    }

    /**
     * @returns {RenderLoop}
     */
    start() {
        this.updateDelta();
        this.paused = false;
        this.loop();
        return this;
    }

    /**
     * @returns {RenderLoop}
     */
    stop() {
        this.paused = true;
        return this;
    }

    /**
     * @returns {number}
     */
    getFps() {
        if (this.delta <= 0) { return 0; }
        var fps = 0;
        var sum = 0;

        while (sum < 1000) {
            sum += this.delta;
            fps += 1;

            if (fps > 120) {
                return fps;
            }
        }

        return Math.round(fps / sum * 1000);
    }

    /**
     * @returns {number}
     */
    static getTimeSnapshot() {
        return (new Date).getTime();
    }

    /**
     * @param callback
     * @returns {RenderLoop}
     */
    subscribe(callback) {
        this.callbacks.push(callback);
        return this;
    }

    /**
     * Main render loop
     */
    loop() {
        if (this.paused) { return; }

        animationFrame(() => {
            this.updateDelta();
            this.callbacks.forEach( callback => callback(this.getDelta()) );
            this.loop();
        });
    }

    /**
     * @returns {RenderLoop}
     */
    updateDelta() {
        var current = RenderLoop.getTimeSnapshot();
        this.delta  = current - this.lastTimeSnapshot;
        this.lastTimeSnapshot = current;
        return this;
    }

    /**
     * @returns {number}
     */
    getDelta() {
        return this.delta * this.speed;
    }
}