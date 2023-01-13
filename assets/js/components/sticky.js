import Stickyfill from 'stickyfilljs';

// an sticky using an object liternal notation to encapsulate into a nice package
const sticky = {

    // create some properties
    elements: [],

    init: function () {
        this.capture();
    },

    capture: function () {
        this.elements = document.querySelectorAll('.js-sticky');
    },

    setup: function () {
        Stickyfill.add(this.elements);
    }
    
};

// finally boot the beast up
sticky.init();
