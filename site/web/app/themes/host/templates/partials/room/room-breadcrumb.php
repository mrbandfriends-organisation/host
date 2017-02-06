<?php if ( !empty($parent_url) ): ?>

    <nav class="breadcrumbs island">
        <ul class="container grid">
            <li class="breadcrumbs__item">
                <a href="<?= esc_attr($parent_url); ?>" class="breadcrumbs__link">
                    < Back to building
                </a>
            </li>
        </ul>
    </nav>

<?php endif; ?>
