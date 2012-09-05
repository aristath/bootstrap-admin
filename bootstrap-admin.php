<?php

/*
Plugin Name: Bootstrap Admin
Plugin URI: http://aristeides.com
Description: Bootstrap Admin Theme - Upload and Activate.
Author: Aristeides Stathopoulos
Version: 0.2
Author URI: http://aristeides.com
*/

// Go to includes/config.php to switch modes.
// Less mode is mainly for development purposes.
require_once 'includes/config.php';


function bootstrap_admin_phpless(){
	require_once( WP_PLUGIN_DIR . '/bootstrap-admin/includes/lessc.inc.php' );
	lessc::ccompile( WP_PLUGIN_DIR . '/bootstrap-admin/css/global.less', WP_PLUGIN_DIR . '/bootstrap-admin/css/style.css');
}

function bootstrap_admin_styles() {
	$less_mode = BOOTSTRAP_ADMIN_LESS_MODE;
	if ($less_mode == 1){
		bootstrap_admin_phpless();
	}
	wp_register_style('customized_bootstrap', plugins_url('css/style.css', __FILE__), false, '2.1.0');
	wp_enqueue_style('customized_bootstrap');
}
add_action('admin_enqueue_scripts', 'bootstrap_admin_styles');

function bootstrap_admin_scripts(){
	wp_register_script('bootstrap_main_js', plugins_url('js/bootstrap.min.js', __FILE__), false, null, false);
	wp_enqueue_script('bootstrap_main_js');

	wp_register_script('bootstrap_admin_script', plugins_url('js/script.js', __FILE__), false, null, false);
	wp_enqueue_script('bootstrap_admin_script');
}
add_action('admin_enqueue_scripts', 'bootstrap_admin_scripts');
