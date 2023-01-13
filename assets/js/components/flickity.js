import Flickity from 'flickity-imagesloaded';
// http://flickity.metafizzy.co/options.html


// an example using an object liternal notation to encapsulate into a nice package
const flkty = {

    // create some properties
    elements: document.querySelectorAll('.js-flickity'),
    postElements: document.querySelectorAll('.js-post-slider'),

    init() {
        this.setup();
    },

    setup() {
        this.setupGeneral();
        this.setupPostSlider();
    },

    setupGeneral() {
        if (this.elements.length > 0) {
            let flky = new Flickity('.js-flickity', {
                pageDots: false,
                wrapAround: true,
                adaptiveHeight: true,
                imagesLoaded: true
            });
        }
    },

    setupPostSlider() {
        if (this.postElements.length > 0) {
            let flky = new Flickity('.js-post-slider', {
                pageDots: false,
                wrapAround: false,
                adaptiveHeight: true,
                imagesLoaded: true,
                cellAlign: 'left',
                groupCells: true
            });
        }
    }

};

// finally boot the beast up
flkty.init();
