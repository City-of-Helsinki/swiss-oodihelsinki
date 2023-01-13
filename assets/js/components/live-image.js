const liveImage = {

    // the live-updating img elements
    elements: [],

    init() {
        this.capture();
    },

    capture() {
        this.elements = Array.from(document.querySelectorAll('.js-live-image'));
        if (this.elements.length > 0) {
            setInterval(liveImage.handleUpdates, 5000);
        }
    },

    handleUpdates() {
        liveImage.elements.forEach(function (el) {
            liveImage.updateImageSrc(el);
        });
    },

    /**
     * Updates the src attribute of a given image element by changing a given
     * parameter, effectively making the browser re-download the updated image.
     * @param  {[type]} el The img element to update the `src` value of.
     * @return {[type]}    [description]
     */
    updateImageSrc(el) {
        let key = 'rand';
        let value = Math.random();
        let uri = el.src;
        let re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        let separator = uri.indexOf('?') !== -1 ? "&" : "?";

        if (uri.match(re)) {
            el.src = uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            el.src = uri + separator + key + "=" + value;
        }
    }

};

// finally boot the beast up
liveImage.init();
