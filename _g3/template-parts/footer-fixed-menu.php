<?php if (has_nav_menu('footer-nav')) : ?>
    <?php
    wp_nav_menu(
        array(
            'theme_location'  => 'footer-nav',
            'container'       => 'nav',
            'container_class' => 'nav_fix',
            'items_wrap'      => '<ul id="%1$s" class="%2$s ' . lightning_get_the_class_name('footer-nav-list') . ' nav nav--line cf">%3$s</ul>',
            'fallback_cb'     => '',
            'depth'           => 1,
        )
    );
    ?>
<?php endif; ?>