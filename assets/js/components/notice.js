import helpers from './helpers';

const notice = {

    init() {
        this.handleDisplay();
        this.handleClose();
    },

    /**
     * Handle displaying the notices if they are not set to be hidden with cookies.
     *
     * TODO: Streamline where the data-attribute should be, as the close button
     * feels a bit wonky.
     *
     * @return {[type]} [description]
     */
    handleDisplay() {
        $('.js-notice').each(function(i, obj) {
            let noticeID = $(this).find('.js-close-notice').data('notice-id');
            if (helpers.getCookie(noticeID) === null) {
                $(this).removeClass('is-hidden');
            }
        });
    },

    /**
     * Handle user attempts to close the notice.
     * @return {[type]} [description]
     */
    handleClose() {
        $('.js-close-notice').click(function() {
            notice.hideNotice($(this).data('notice-id'), 7);
        });
    },

    /**
     * Hide a notice by setting a cookie that will control its future display,
     * and hide the element from the DOM.
     * @param  {string} noticeID Unique ID to tell this notice apart from others
     * @param  {number} exprDays Number of days before the cookie should expire
     * @return {[type]}          [description]
     */
    hideNotice(noticeID, exprDays) {
        // Set cookie for this notice
        helpers.setCookie(noticeID, 'hidden', exprDays);

        // Hide from DOM
        $('.js-notice').hide();
    }

};

// finally boot the beast up
notice.init();