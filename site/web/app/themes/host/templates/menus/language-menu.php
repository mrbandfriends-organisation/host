<?php $languages = get_field('host_languages', 'option'); ?>

<?php if (!empty($languages)) : ?>
    <li class="menu-item menu-item--banner-language-switcher">
        <div>
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
    </li>
<?php endif; ?>
