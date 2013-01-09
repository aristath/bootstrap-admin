<?php

/*
Plugin Name: Bootstrap Admin
Plugin URI: http://shoestrap.org
Description: Bootstrap Admin Theme
Author: Aristeides Stathopoulos
Version: 1.12
Author URI: http://aristeides.com
*/

// Go to includes/config.php to switch modes.
// Less mode is mainly for development purposes.

require_once 'includes/config.php';

function bootstrap_admin_phpless(){
	require_once( WP_PLUGIN_DIR . '/bootstrap-admin/includes/lessc.inc.php' );
	lessc::ccompile( WP_PLUGIN_DIR . '/bootstrap-admin/assets/css/global.less', WP_PLUGIN_DIR . '/bootstrap-admin/assets/css/compiled-style.css');
}

function bootstrap_admin_styles() {
	$less_mode = BOOTSTRAP_ADMIN_LESS_MODE;
	if ($less_mode == 1){
		bootstrap_admin_phpless();
	}
  wp_register_style('customized_bootstrap', plugins_url('assets/css/compiled-style.css', __FILE__), false, '2.1.0');
  wp_enqueue_style('customized_bootstrap');

	$chosen_mode = BOOTSTRAP_ADMIN_CHOSEN_JS;
	if ($chosen_mode == 1){
		wp_register_style('bootstrap_admin_chosen_css', plugins_url('assets/js/chosen/chosen.css', __FILE__), false, '0.9.8');
		wp_enqueue_style('bootstrap_admin_chosen_css');
	}
}
add_action('admin_enqueue_scripts', 'bootstrap_admin_styles');

function bootstrap_admin_scripts(){
	wp_register_script('bootstrap_main_js', plugins_url('assets/js/bootstrap.min.js', __FILE__), false, null, false);
	wp_enqueue_script('bootstrap_main_js');

	wp_register_script('bootstrap_admin_script', plugins_url('assets/js/script.js', __FILE__), false, null, false);
	wp_enqueue_script('bootstrap_admin_script');

  // use custom icon32 icons when "WPMU DEV Dashboard" plugin is NOT installed
  if ( !class_exists( 'WPMUDEV_Update_Notifications' ) ) {
    wp_register_script('bootstrap_admin_icon32', plugins_url('assets/js/icon32.js', __FILE__), false, null, false);
    wp_enqueue_script('bootstrap_admin_icon32');
  }

	$chosen_mode = BOOTSTRAP_ADMIN_CHOSEN_JS;
	if ($chosen_mode == 1){
		wp_register_script('bootstrap_admin_chosen_js', plugins_url('assets/js/chosen/chosen.jquery.min.js', __FILE__), false, '0.9.8');
		wp_enqueue_script('bootstrap_admin_chosen_js');

		wp_register_script('bootstrap_admin_chosen_trigger', plugins_url('assets/js/chosen-trigger.js', __FILE__), false, '0.9.8');
		wp_enqueue_script('bootstrap_admin_chosen_trigger');
	}
}
add_action('admin_enqueue_scripts', 'bootstrap_admin_scripts');

/*
 * The below is a replacement of the wp_default_styles
 * function found in wp-includes/script-loader.php.
 */
function bootstrap_admin_wp_default_styles( &$styles ) {

  if ( ! $guessurl = site_url() )
    $guessurl = wp_guess_url();

  $styles->base_url = $guessurl;
  $styles->content_url = defined('WP_CONTENT_URL')? WP_CONTENT_URL : '';
  $styles->default_version = get_bloginfo( 'version' );
  $styles->text_direction = function_exists( 'is_rtl' ) && is_rtl() ? 'rtl' : 'ltr';
  $styles->default_dirs = array('/wp-admin/', '/wp-includes/css/');

  $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

  $rtl_styles = array( 'wp-admin', 'ie', 'media', 'admin-bar', 'customize-controls', 'media-views', 'wp-color-picker' );
  // Any rtl stylesheets that don't have a .min version
  $no_suffix = array( 'farbtastic' );

  $styles->add( 'wp-admin', "/wp-admin/css/wp-admin$suffix.css" );

  $styles->add( 'ie', "/wp-admin/css/ie$suffix.css" );
  $styles->add_data( 'ie', 'conditional', 'lte IE 7' );

  // Register "meta" stylesheet for admin colors. All colors-* style sheets should have the same version string.
  $styles->add( 'colors', true, array('wp-admin', 'buttons') );

  // do not refer to these directly, the right one is queued by the above "meta" colors handle
  // $styles->add( 'colors-fresh', "/wp-admin/css/colors-fresh$suffix.css", array('wp-admin', 'buttons') );
  // $styles->add( 'colors-classic', "/wp-admin/css/colors-classic$suffix.css", array('wp-admin', 'buttons') );

  $styles->add( 'media', "/wp-admin/css/media$suffix.css" );
  $styles->add( 'install', "/wp-admin/css/install$suffix.css", array('buttons') );
  $styles->add( 'thickbox', '/wp-includes/js/thickbox/thickbox.css', array(), '20121105' );
  $styles->add( 'farbtastic', '/wp-admin/css/farbtastic.css', array(), '1.3u1' );
  $styles->add( 'wp-color-picker', "/wp-admin/css/color-picker$suffix.css" );
  $styles->add( 'jcrop', "/wp-includes/js/jcrop/jquery.Jcrop.min.css", array(), '0.9.10' );
  $styles->add( 'imgareaselect', '/wp-includes/js/imgareaselect/imgareaselect.css', array(), '0.9.8' );
  $styles->add( 'admin-bar', "/wp-includes/css/admin-bar$suffix.css" );
  $styles->add( 'wp-jquery-ui-dialog', "/wp-includes/css/jquery-ui-dialog$suffix.css" );
  $styles->add( 'editor-buttons', "/wp-includes/css/editor$suffix.css" );
  $styles->add( 'wp-pointer', "/wp-includes/css/wp-pointer$suffix.css" );
  $styles->add( 'customize-controls', "/wp-admin/css/customize-controls$suffix.css", array( 'wp-admin', 'colors', 'ie' ) );
  $styles->add( 'media-views', "/wp-includes/css/media-views$suffix.css", array( 'buttons' ) );
  // $styles->add( 'buttons', "/wp-includes/css/buttons$suffix.css" );
  $styles->add( 'buttons', plugins_url( 'assets/css/buttons.css', __FILE__ ) );

  foreach ( $rtl_styles as $rtl_style ) {
    $styles->add_data( $rtl_style, 'rtl', true );
    if ( $suffix && ! in_array( $rtl_style, $no_suffix ) )
      $styles->add_data( $rtl_style, 'suffix', $suffix );
  }
}
remove_action( 'wp_default_styles', 'wp_default_styles' );              // removes the default wp_default_styles function
add_action( 'wp_default_styles', 'bootstrap_admin_wp_default_styles' ); // adds our customized bootstrap_admin_wp_default_styles function
