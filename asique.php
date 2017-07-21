<?php

/*
Plugin Name: Asique
Plugin URI: http://asique.me
Description: A WordPress Plugin to help developer building WordPress Theme easily.
Author: asikur22
Version: 1.0.0
Author URI: http://asique.me/
 */

/*
 * Add IE conditional html5 shiv to header
 */
if (!function_exists('asique_ie_html5_shiv')) {

	function asique_ie_html5_shiv() {
		echo '<!--[if lt IE 9]>' . PHP_EOL;
		echo '<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>' . PHP_EOL;
		echo '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>' . PHP_EOL;
		echo '<![endif]-->' . PHP_EOL;
	}

}
add_action('wp_head', 'asique_ie_html5_shiv');

/*
 * Add Plug-in link to Frond End admin bar.
 */

if (!is_admin() && is_admin_bar_showing()) {
	add_action('admin_bar_menu', 'add_toolbar_items', 100);

	function add_toolbar_items($admin_bar) {
		$admin_bar->add_node(array(
			'parent' => 'site-name',
			'id' => 'plugins',
			'title' => 'Plugins',
			'href' => esc_url(admin_url('plugins.php')),
			'meta' => false,
		));

		$admin_bar->add_node(array(
			'parent' => 'site-name',
			'id' => 'edit-theme',
			'title' => __('Edit Theme'),
			'href' => esc_url(admin_url('theme-editor.php')),
			'meta' => false,
		));

	}

}

/*
 * Adding Bootstrap Responsive CSS Class for all Image.
 */

function asique_bt_img_responsive_class($classes) {
	$classes .= ' img-responsive';
	return $classes;
}

add_filter('get_image_tag_class', 'asique_bt_img_responsive_class');

// Enable font size & font family selects in the editor
if (!function_exists('asique_mce_buttons')) {

	function asique_mce_buttons($buttons) {
//        array_unshift($buttons, 'fontselect'); // Add Font Select
		array_unshift($buttons, 'fontsizeselect'); // Add Font Size Select
		return $buttons;
	}

}
add_filter('mce_buttons_2', 'asique_mce_buttons');

// Customize mce editor font sizes
if (!function_exists('asique_mce_text_sizes')) {

	function asique_mce_text_sizes($initArray) {
		$initArray['fontsize_formats'] = "10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 32px 36px";
		return $initArray;
	}

}
add_filter('tiny_mce_before_init', 'asique_mce_text_sizes');
