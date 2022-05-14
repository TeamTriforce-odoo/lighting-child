<?php
/**
 * Sidebar for post
 *
 * This file is sidebar fot post.
 * But, if the widget or block is placed in the sitebar widget area (post),
 * This file will not be read.
 *
 * 投稿タイプ post 用のサイドバーです。
 * しかし、サイトバーウィジェットエリア（投稿）にウィジェットかブロックが配置されている場合、
 * このファイルは読み込まれなくなります。
 *
 * @package vektor-inc/lightning
 */

$post_loop = new WP_Query(
	array(
		'post_type'              => 'post',
		'posts_per_page'         => 5,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	)
);
?>

<?php if ( $post_loop->have_posts() ) : ?>

<!-- <aside class="widget widget_link_list"> -->
<!-- <h4 class="sub-section-title"><?php _e( 'Category', 'lightning' ); ?></h4> -->
<!-- <h4 class="sub-section-title">
	<span class="sub-section-title-en">CATEGORY</span>
	<span class="sub-section-title-jp">カテゴリー</span>
</h4>	 -->

<!-- <ul> -->
<!-- 	<?php
	$args = array(
		'show_count'      => true,
		'title_li'      => '',
	);
	wp_list_categories( $args );
	?> -->
<!-- </ul>
</aside> -->

<aside class="widget widget_link_list">

<h4 class="sub-section-title">
	<span class="sub-section-title-en">SALON</span>
	<span class="sub-section-title-jp">支店一覧</span>
</h4>	
<ul>
	<span class="tagcloud">
	<?php
	$args = array(
		'show_count'      => true,
	);
	wp_tag_cloud( $args );
	?>
	</span>

</ul>
</aside>



<aside class="widget widget_link_list">
<h4 class="sub-section-title">
	<span class="sub-section-title-en">ARCHIVE</span>
	<span class="sub-section-title-jp">アーカイブ</span>
</h4>
	
<ul>
<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
    <option value=""><?php esc_attr( _e( '月を選択', 'textdomain' ) ); ?></option> 
    <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
</select>
	
<!--<?php
	$args = array(
		'type'      => 'monthly',
		'post_type' => 'post',
		'show_post_count' => true,
	);
	wp_get_archives( $args );
	?>-->
</ul>
	
	
</aside>

<aside class="widget widget_media">
<!-- <h4 class="sub-section-title"><?php echo __( 'Recent posts', 'lightning' ); ?></h4> -->
<h4 class="sub-section-title">
	<span class="sub-section-title-en">NEW ARTICLE</span>
	<span class="sub-section-title-jp">新着情報</span>
</h4>	
	
<div class="vk_posts">
	<div class="vk_post_wrapper">
	<?php
	while ( $post_loop->have_posts() ) :
		$post_loop->the_post();

		$options = array(
			'layout'                     => 'media', // card , card-horizontal , media
			'display_image'              => true,
			'display_image_overlay_term' => false,
			'display_excerpt'            => false,
			'display_date'               => false,
			'display_new'                => true,
			'display_btn'                => false,
			'image_default_url'          => true,
			'overlay'                    => false,
			'btn_text'                   => __( 'Read more', 'lightning' ),
			'btn_align'                  => 'text-right',
 			
			'new_date'                   => 7,
			'class_outer'                => 'vk_post-col-xs-12 vk_post-col-sm-12 vk_post-col-lg-12 vk_post-col-xl-12',
			'class_title'                => '',
			'new_text'                   => __( 'New!!', 'lightning' ),
			'body_prepend'               => '',
			'body_append'                => '',
		);
		wp_kses_post( VK_Component_Posts::the_view( $post, $options ) );

endwhile;
	?>
	</div>
</div>
</aside>
<aside class="widget widget_media side-blank pd-b100"></aside>
<?php endif; ?>
<?php wp_reset_query(); ?>