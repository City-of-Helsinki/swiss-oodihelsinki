import helpers from './helpers';

const siteSearch = {

    init() {
        this.setup();
        this.handleClose();
    },

    setup() {
        $('.js-site-search-toggle').on('click', function(e) {
            e.preventDefault();
            $('.js-site-search').toggleClass('is-active');

            setTimeout(function () {
                $('.js-site-search-input').focus();
            }, 300);

            // Mark toggler element itself as active
            helpers.toggleAttr($(this), 'aria-expanded');
        });

        $('.js-site-search-close').on('click', function(e) {
            e.preventDefault();
            $('.js-site-search').removeClass('is-active');

            // Mark toggler element itself as active
            helpers.toggleAttr($(this), 'aria-expanded');
        });
    },

    handleClose() {
        // on esc press close everything down
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                $('.js-site-search-toggle').focus();
                $('.js-site-search').removeClass('is-active');
            }
        });
    }

};

// finally boot the beast up
siteSearch.init();
