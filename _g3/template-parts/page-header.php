<?php

/**
 * Page Header
 *
 * @package Lightning G3
 */

/*********************************************
 * Set Html Tag
 */
$post_top_info  = VK_Helpers::get_post_top_info();
$post_type_info = VK_Helpers::get_post_type_info();

// Use post top page（ Archive title wrap to div ）.
if ($post_top_info['use']) {
    if (is_category() || is_tag() || is_tax() || is_single() || is_date()) {
        $page_title_tag = 'div';
    } else {
        $page_title_tag = 'h1';
    }
    // Don't use post top（　Archive title wrap to h1　）.
} else {
    if (!is_single()) {
        $page_title_tag = 'h1';
    } else {
        $page_title_tag = 'div';
    }
}

/*********************************************
 * Set display title name
 */

$page_header_title = '';
$page_header_image = '';
$page_header_title_en = '';

if (is_search()) {
    if (!empty(get_search_query())) {
        $search_text = sprintf(__('Search Results for : %s', 'lightning'), get_search_query());
    } else {
        $search_text = __('Search Results', 'lightning');
    }
    $page_header_title = $search_text;
} elseif (!empty($wp_query->query_vars['bbp_search'])) {
    $bbp_search        = esc_html(urldecode($wp_query->query_vars['bbp_search']));
    $page_header_title = sprintf(__('Search Results for : %s', 'lightning'), $bbp_search);
} elseif (is_404()) {
    $page_header_title = __('Not found', 'lightning');
} elseif (is_author()) {
    $page_header_title = get_the_archive_title();
} elseif (is_category()) {
    $category = get_the_category();
    $term = get_queried_object();
    $page_header_image = get_field('category_cover_img', $term);;
    $title_jp = get_field('category_title_jp', $term);
    $page_header_title = $title_jp == '' ? $title_jp: $category[0]->name;
    $title_en = get_field('category_title_en', $term);
    $page_header_title_en = $title_en;
} elseif (is_tag() || is_tax() || is_home() || is_author() || is_archive() || is_single()) {
    
    // Case of post type == 'post'.
    if ('post' === $post_type_info['slug']) {
        // Case of use post top page.
        if ($post_top_info['use']) {
            $page_header_title = $post_top_info['name'];

            // Case of don't use post top page.
        } else {

            if (is_single()) {
                $taxonomies = get_the_taxonomies();
                if ($taxonomies) {
                    $taxonomy_slug     = key($taxonomies);
                    $taxo_cates        = get_the_terms(get_the_ID(), $taxonomy_slug);
                    $page_header_title = esc_html($taxo_cates[0]->name);
                } else {
                    // Case of no category.
                    $page_header_title = $post_type_info['name'];
                }
            } else {
                $page_header_title = get_the_archive_title();
            }
        } 
        // Case of custom post type.
    } else {
        $page_header_title = $post_type_info['name'];
    }
} elseif (is_page() || is_attachment()) {
    $page_header_title = get_field('page_title_jp') == ''? get_field('page_title_jp'):get_the_title();
    $page_header_image = get_field('page_cover_img');
    $page_header_title_en = get_field('page_title_en');
}

$page_header_title_html = '<' . $page_title_tag . ' class="page-header-title">' . $page_header_title . '</' . $page_title_tag . '>';

$allowed_html = array(
    'h1'     => array(
        'class' => array(),
    ),
    'div'    => array(
        'class' => array(),
    ),
    'span'   => array(
        'class' => array(),
    ),
    'img'    => array(
        'class'   => array(),
        'src'     => array(),
        'alt'     => array(),
        'height'  => array(),
        'width'   => array(),
        'loading' => array(),
    ),
    'i'      => array(
        'class' => array(),
    ),
    'br'     => array(),
    'strong' => array(),
    'ruby'   => array(),
    'rt'     => array(),
);
?>
<section class="header-wrapper pd-t140 pd-b140 mg-b60" style="background-image: url('<?php echo $page_header_image; ?>'); background-position: center center; background-size: cover;">
    <h1 class="center">
        <p class="tx-32 tx-darkgray lighter ls-2 tx-header normal mg-b60"><?php echo $page_header_title_en; ?></p>
        <p class="tx-18 tx-darkgray lighter letter-spacing20"><?php echo $page_header_title; ?></p>
    </h1>
</section>



<!-- [ /.page-header ] -->