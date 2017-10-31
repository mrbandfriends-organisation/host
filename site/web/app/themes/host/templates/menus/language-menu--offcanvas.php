<?php $languages = get_field('host_languages', 'option'); ?>

<?php if (!empty($languages)) : ?>
    <div id="google-translate-target-small">
        <select class="js-language-switcher">
            <option value>Select Language</option>
            <?php foreach ($languages as $language) : ?>

                <?php
                    $language_title = $language['language'];
                    $language_url = $language['url'];
                ?>
                    <option value="<?php echo esc_url($language_url); ?>"> <?php echo esc_html($language_title); ?> </option>

            <?php endforeach; ?>
        </select>
    </div>
<?php endif; ?>
