<?php if (has_nav_menu('slide-fixed-nav')) : ?>
    <?php
    wp_nav_menu(
        array(
            'theme_location'  => 'slide-fixed-nav',
            'container'       => 'nav',
            'container_class' => 'slide-fixed',
            'items_wrap'      => '<ul id="%1$s" class="%2$s fixing-btn">%3$s</ul>',
            'fallback_cb'     => '',
            'depth'           => 1,
        )
    );
    ?>
<?php endif; ?>