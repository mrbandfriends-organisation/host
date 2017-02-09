<?php 
    use Roots\Sage\Extras;

    $btn_modifiers = ( !empty($btn_modifiers) ) ? $btn_modifiers : '';
?>

<?php if ( $can_book ): ?>
    <?php $booking_url = get_field('booking_url', 'option'); ?>
    <a href="<?= esc_attr($booking_url); ?>" class="btn btn--red <?=esc_attr($btn_modifiers);?>" <?php Extras\link_open_new_tab_attrs(); ?>>
        Book now
    </a>
<?php endif ?>

<?php if ( $can_join_waiting_list ): ?>
    <?php 

        // JS is listening to prepopulate the Contact form!
        $query_string = http_build_query(array(
            'enquiry-type' => WAITING_LIST_FIELD,
            'enquiry-hall' => $enquiry_hall_name
        ));

    ?>

    <a href="/contact/?<?php echo esc_attr($query_string);?>#contact-form-section" class="btn btn--red <?=esc_attr($btn_modifiers);?>">
        Join The Waiting List
    </a>
<?php endif ?>