import helpers from './helpers';

const languageSwitcher = {

    init() {
        this.handleNavigation();
        this.handleClose();
    },

    handleNavigation() {
        $('.js-language-switcher-toggle').on('keypress click', function(e) {
            // On enter/space or click/tap..
            if (e.which === 13 || e.which === 32 || e.type === 'click') {
                // Mark toggler element itself as active
                helpers.toggleAttr($(this), 'aria-expanded');

                // Mark corresponding submenu as visible
                $(this).next('.js-language-switcher-dropdown').toggleClass('is-visible');
            }
        });
    },

    handleClose() {
        // on esc press close everything down
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                $('.js-language-switcher-dropdown').removeClass('is-visible');
                $('.js-language-switcher-toggle').attr('aria-expanded', 'false');
            }
        });
    }

};

// finally boot the beast up
languageSwitcher.init();