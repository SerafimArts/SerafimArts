
export default class Video {
    /**
     * @type {{mp4: string, ogg: string, webm: string}}
     */
    formats = {
        mp4: 'avc1.4D401E, mp4a.40.2',
        ogg: 'theora, vorbis',
        webm: 'vp8.0, vorbis'
    };

    /**
     * @type {HTMLVideoElement}
     */
    video = document.createElement('video');

    /**
     * @param path
     * @param width
     * @param height
     */
    constructor(path, width = 320, height = 240) {

        Object.keys(this.formats).forEach(ext => {
            var source = document.createElement('source');
            source.src  = `${path}.${ext}`;
            source.type = `video/${ext}; codecs="${this.formats[ext]}"`;
            this.video.appendChild(source);
        });

        this.video.width  = width;
        this.video.height = height;
    }

    /**
     * @returns {Video}
     */
    play() {
        this.video.play();
        return this;
    }

    /**
     * @returns {Video}
     */
    stop() {
        this.video.pause();
        this.video.currentTime = 0;
        return this;
    }

    /**
     * @returns {Video}
     */
    pause() {
        this.video.pause();
        return this;
    }

    /**
     * @returns {HTMLVideoElement}
     */
    get source() {
        return this.video;
    }

    /**
     * @returns {boolean}
     */
    get loop() {
        return this.video.loop;
    }

    /**
     * @param {boolean} value
     */
    set loop(value) {
        this.video.loop = !!value;
    }
}
