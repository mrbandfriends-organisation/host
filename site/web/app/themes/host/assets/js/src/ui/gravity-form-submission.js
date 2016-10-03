/**
 * SHOW GRAVITY FORMS VALIDATION MESSAGES
 * by default the window won't scroll down to show any
 * error messages display
 */
(function() {
    'use strict';

    // Check for a validation notice (success / fail)
    // .add() adds an additional selector to the result set thereby
    // allowing us to test for x2 selectors due to GForm variations
    var validationNotice = $('.gform_confirmation_message').add('form .validation_error');

    if ( validationNotice.length ) {

        // Get the closest parent "div" - only way to be consistent with GForms
        var formWrapper = validationNotice.parent().closest('div');

        var id  = formWrapper.attr('id');

        // If the form is within a toogled element then show that element
        var toggleWrapper = validationNotice.parents('.js-toggle-form');

        if (toggleWrapper.length) {
            toggleWrapper.show();
        }

        // Skip to the document point
        if (id !== undefined) {
            window.location.hash = id;
        }
    }

}());
