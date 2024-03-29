<?php
/**
 * Plugin Name: wc-admin-example-page
 *
 * @package WC_Admin
 */

/**
 * Register the JS.
 */
function add_wc_admin_sales_by_country_register_script()
{

	if (!class_exists('Automattic\WooCommerce\Admin\Loader')) {
		return;
	}

	$script_path = '/build/index.js';
	$script_asset_path = dirname(__FILE__) . '/build/index.asset.php';
	$script_asset = file_exists($script_asset_path)
		? require ($script_asset_path)
		: array('dependencies' => array(), 'version' => filemtime($script_path));
	$script_url = plugins_url($script_path, __FILE__);

	wp_register_script(
		'wc-admin-example-page',
		$script_url,
		$script_asset['dependencies'],
		$script_asset['version'],
		true
	);

	wp_register_style(
		'wc-admin-example-page',
		plugins_url('/build/style.css', __FILE__),
		// Add any dependencies styles may have, such as wp-components.
		array(),
		filemtime(dirname(__FILE__) . '/build/style.css')
	);

	wp_enqueue_script('wc-admin-example-page');
	wp_enqueue_style('wc-admin-example-page');
}


add_action('admin_enqueue_scripts', 'add_wc_admin_sales_by_country_register_script');

add_action('init', function () {
	wp_set_script_translations('wc-admin-example-page', 'wc-admin-example-page');
});

if (!function_exists('YOUR_PREFIX_add_extension_register_page')) {
	function YOUR_PREFIX_add_extension_register_page()
	{

		if (!function_exists('wc_admin_register_page')) {
			return;
		}

		wc_admin_register_page(
			array(
				'id' => 'my-example-page',
				'title' => __('WC Admin example page', 'wc-admin-example-page'),
				'parent' => 'woocommerce',
				'path' => '/example',
				'nav_args' => array(
					'order' => 10,
					'parent' => 'woocommerce',
				),
			)
		);
	}
}

add_action('admin_menu', 'YOUR_PREFIX_add_extension_register_page');

