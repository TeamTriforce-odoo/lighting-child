<?php
/**
 * Lightning Child theme functions
 *
 * @package lightning
 */

/************************************************
 * 独自CSSファイルの読み込み処理
 *
 * 主に CSS を SASS で 書きたい人用です。 素の CSS を直接書くなら style.css に記載してかまいません.
 */

// 独自のCSSファイル（assets/css/）を読み込む場合は true に変更してください.
$my_lightning_additional_css = true;

if ( $my_lightning_additional_css ) {
	// 公開画面側のCSSの読み込み.
	add_action(
		'wp_enqueue_scripts',
		function() {
			wp_enqueue_style(
				'my-lightning-custom',
				get_stylesheet_directory_uri() . '/assets/css/style.css',
				array( 'lightning-design-style' ),
				filemtime( dirname( __FILE__ ) . '/assets/css/style.css' )
			);
		}
	);
	// 編集画面側のCSSの読み込み.
	add_action(
		'enqueue_block_editor_assets',
		function() {
			wp_enqueue_style(
				'my-lightning-editor-custom',
				get_stylesheet_directory_uri() . '/assets/css/editor.css',
				array( 'wp-edit-blocks', 'lightning-gutenberg-editor' ),
				filemtime( dirname( __FILE__ ) . '/assets/css/editor.css' )
			);
		}
	);
}

/************************************************
 * 独自の処理を必要に応じて書き足します
 */

/*---------------------------------------------------------------------------
 * クラスの読み込み
 *---------------------------------------------------------------------------*/
if (file_exists($f = __DIR__ . '/lib/contact_form.php')) require_once($f);

/*---------------------------------------------------------------------------
 * JS読み込み
 *---------------------------------------------------------------------------*/
function add_scripts_js()
{
	wp_enqueue_script('ajaxzip3-js', get_theme_file_uri() . '/assets/js/ajaxzip3.js', array('jquery', 'jquery-form'), filemtime(__DIR__ . '/assets/js/ajaxzip3.js'), true);
	wp_enqueue_script('wpcf7c-scripts-js', get_theme_file_uri() . '/assets/js/wpcf7c-scripts.js', array('jquery', 'jquery-form'), filemtime(__DIR__ . '/assets/js/wpcf7c-scripts.js'), true);
}
add_action('wp_enqueue_scripts', 'add_scripts_js', 100);

/*---------------------------------------------------------------------------
 * CSS読み込み  
 *---------------------------------------------------------------------------*/
// function add_scripts_css()
// {
// 	wp_enqueue_style('app-style', get_theme_file_uri('/app.css'), [], filemtime(__DIR__ . '/app.css'));
// }
// add_action('init', 'add_scripts_css', 10);

