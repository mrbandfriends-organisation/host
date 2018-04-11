<?php

namespace Roots\Sage\GravityForms;

use Roots\Sage\Setup;
use Roots\Sage\Utils;

function gravity_form_exists( $form_id ){
    $forms = \GFFormsModel::get_forms();
    //var_dump($forms);

    foreach($forms as &$form){
        if ($form->id == $form_id) {
            return true;
        }
    }

    return false;
}



// Test for Gravity Forms being active
if ( class_exists( 'GFCommon' ) ) {

    /**
     * MODIFY GRAVITY FORMS INPUTS
     *
     * modifies the default markup for Gravity Forms' inputs
     */
    function modify_gform_inputs( $content, $field, $value, $lead_id, $form_id ) {

        $content = '<div class="form-control-group">' . $content . '</div>';

        // Select elements
        if($field["type"] == 'select') {


          $content = str_replace('class=\'ginput_container ginput_container_select', 'class=\'form-select-custom ginput_container ginput_container_select', $content);
        }
        return $content;
    }
    add_filter( 'gform_field_content',  __NAMESPACE__ . '\\modify_gform_inputs', 10, 5 );


    /**
     * MODIFY GRAVITY FORMS SUBMIT BUTTON
     *
     * modifies the default markup for Gravity Forms' submit buttons
     */
    function modify_gform_submit_btn($button, $form){
        return '<button class="gf-field--btn btn btn--grape">' . esc_html( $form["button"]["text"] ) . '</button>';
    }
    add_filter("gform_submit_button", __NAMESPACE__ . '\\modify_gform_submit_btn', 10, 2);


    /**
     * FORCE GFORM SCRIPTS INLINE
     *
     * see strip_inline_gform_scripts which strips the inline
     * scripts to avoid random calls to jQuery!
     */
    function force_gform_inline_scripts() {
        return false;
    }
    add_filter("gform_init_scripts_footer", __NAMESPACE__ . "\\force_gform_inline_scripts");


    /**
     * STRIP GRAVITY FORMS SCRIPT TAGS
     *
     * note: this diables post and pre render hooks which are triggered
     */
    function strip_inline_gform_scripts( $form_string, $form ) {
      return $form_string = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $form_string);
    }

    add_filter("gform_get_form_filter", __NAMESPACE__ . "\\strip_inline_gform_scripts", 10, 2);
    add_filter( 'gform_tabindex', '__return_false' );



    add_filter( 'gform_field_css_class', __NAMESPACE__ . '\\custom_class', 10, 3 );
    function custom_class( $classes, $field, $form ) {
        if ( $form['id'] === 1 ) {

            // Adding class to all fields
            if( !empty($field) ) {
                $classes .= ' gf-field-container';
            }

            // Adding sizing class
            // ====================
            if ( $field->type == 'text' || $field->type == 'email' || $field->type == 'select' ) {
                $classes .= ' gf-field-container--half';
            }

            // Adding aligment classes
            // ====================
            if ( !empty($form) ) {
                $number_fields = count($form['fields']);

                // Left aligned
                if($field->id === 1 || $field->id === 3 || $field->id === 6) {
                    $classes .= ' gf-field-container--left';
                }
                // Right aligned
                elseif ($field->id === 2 || $field->id === 4) {
                    $classes .= ' gf-field-container--right';
                }
            }

            return $classes;
        }

    }

    /**
     * DISABLE IP ADDRESS COLLECTION
     *
     * Prevents GF from saving a form submitter's IP address
     */

    add_filter( 'gform_ip_address', '__return_empty_string' );

} // end test for Gravity Forms being active
