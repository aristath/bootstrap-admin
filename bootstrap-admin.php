<?php

/*
Plugin Name: Bootstrap Admin
Plugin URI: http://aristeides.com
Description: Bootstrap Admin Theme - Upload and Activate.
Author: Aristeides Stathopoulos
Version: 0.1
Author URI: http://aristeides.com
*/

function bootstrap_admin_styles() {
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