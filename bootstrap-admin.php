<?php

/*
Plugin Name: Bootstrap Admin
Plugin URI: http://shoestrap.org
Description: Bootstrap Admin Theme
Author: Aristeides Stathopoulos
Version: 1.13
Author URI: http://aristeides.com
*/

require_once 'includes/config.php'; // Includes some advanced configuration options such as enabling less to css compiling.

/*
 * This funcion takes care of less to css compiling
 */
function bootstrap_admin_phpless(){
	require_once( WP_PLUGIN_DIR . '/bootstrap-admin/includes/lessc.inc.php' );
	lessc::ccompile( WP_PLUGIN_DIR . '/bootstrap-admin/assets/css/global.less', WP_PLUGIN_DIR . '/bootstrap-admin/assets/css/compiled-style.css');
}

/*
 * Enqueue stylesheets.
 * If less to css compiling is enabled in the config.php file
 * then enable the compiler.
 */
function bootstrap_admin_styles() {
	$less_mode = BOOTSTRAP_ADMIN_LESS_MODE;
	if ($less_mode == 1){
		bootstrap_admin_phpless();
	}
  wp_register_style('customized_bootstrap', plugins_url('assets/css/compiled-style.css', __FILE__), false, '2.1.0');
  wp_enqueue_style('customized_bootstrap');
  
  // If chosen.js is enabled in the config.php file, then enqueue some extra styles.
	$chosen_mode = BOOTSTRAP_ADMIN_CHOSEN_JS;
	if ($chosen_mode == 1){
		wp_register_style('bootstrap_admin_chosen_css', plugins_url('assets/js/chosen/chosen.css', __FILE__), false, '0.9.8');
		wp_enqueue_style('bootstrap_admin_chosen_css');
	}
}
add_action('admin_enqueue_scripts', 'bootstrap_admin_styles');

/*
 * Enqueue the necessary scripts.
 */
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

  // If chosen.js is enabled in the config.php file, then enqueue some extra styles.
	$chosen_mode = BOOTSTRAP_ADMIN_CHOSEN_JS;
	if ($chosen_mode == 1){
		wp_register_script('bootstrap_admin_chosen_js', plugins_url('assets/js/chosen/chosen.jquery.min.js', __FILE__), false, '0.9.8');
    wp_register_script('bootstrap_admin_chosen_trigger', plugins_url('assets/js/chosen-trigger.js', __FILE__), false, '0.9.8');
		wp_enqueue_script('bootstrap_admin_chosen_js');
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

/*
 * Creates our settings in the options table in the database
 */
add_action( 'admin_init', 'bootstrap_admin_register_option', 11 );
function bootstrap_admin_register_option() {
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_wp_menu_navbar' );

  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_change_footer_check' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_change_footer_text' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_hide_footer_upgrade' );

  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_welcome_panel' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_browser_nag' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_right_now' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_recent_comments' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_incoming_links' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_plugins' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_quick_press' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_recent_drafts' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_primary' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_dashboard_secondary' );

  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_menu_media' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_menu_comments' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_menu_themes' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_menu_plugins' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_menu_users' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_menu_tools' );
  register_setting( 'bootstrap_admin_options', 'bootstrap_admin_remove_menu_settings' );
}

/*
 * Adds the Administration page for Bootstrap Admin.
 * This page will hold any option for the bootstrap Admin plugin.
 */
add_action( 'admin_menu', 'bootstrap_admin_admin_page' );
function bootstrap_admin_admin_page() {
  add_submenu_page('options-general.php', 'bootstrap_admin', 'Bootstrap Admin', 'manage_options', 'bootstrap_admin_menu', 'bootstrap_admin_admin_page_content');
}

/*
 * The content of the administration page for Bootstrap Admin.
 */
function bootstrap_admin_admin_page_content() { 
  $bootstrap_admin_remove_wp_menu_navbar            = get_option( 'bootstrap_admin_remove_wp_menu_navbar' );
  $bootstrap_admin_change_footer_check              = get_option( 'bootstrap_admin_change_footer_check' );
  $bootstrap_admin_change_footer_text               = get_option( 'bootstrap_admin_change_footer_text' );
  $bootstrap_admin_hide_footer_upgrade              = get_option( 'bootstrap_admin_hide_footer_upgrade' );
  $bootstrap_admin_remove_welcome_panel             = get_option( 'bootstrap_admin_remove_welcome_panel' );
  $bootstrap_admin_remove_dashboard_browser_nag     = get_option( 'bootstrap_admin_remove_dashboard_browser_nag' );
  $bootstrap_admin_remove_dashboard_right_now       = get_option( 'bootstrap_admin_remove_dashboard_right_now' );
  $bootstrap_admin_remove_dashboard_recent_comments = get_option( 'bootstrap_admin_remove_dashboard_recent_comments' );
  $bootstrap_admin_remove_dashboard_incoming_links  = get_option( 'bootstrap_admin_remove_dashboard_incoming_links' );
  $bootstrap_admin_remove_dashboard_plugins         = get_option( 'bootstrap_admin_remove_dashboard_plugins' );
  $bootstrap_admin_remove_dashboard_quick_press     = get_option( 'bootstrap_admin_remove_dashboard_quick_press' );
  $bootstrap_admin_remove_dashboard_recent_drafts   = get_option( 'bootstrap_admin_remove_dashboard_recent_drafts' );
  $bootstrap_admin_remove_dashboard_primary         = get_option( 'bootstrap_admin_remove_dashboard_primary' );
  $bootstrap_admin_remove_dashboard_secondary       = get_option( 'bootstrap_admin_remove_dashboard_secondary' );
  $bootstrap_admin_remove_menu_media                = get_option( 'bootstrap_admin_remove_menu_media' );
  $bootstrap_admin_remove_menu_comments             = get_option( 'bootstrap_admin_remove_menu_comments' );
  $bootstrap_admin_remove_menu_themes               = get_option( 'bootstrap_admin_remove_menu_themes' );
  $bootstrap_admin_remove_menu_plugins              = get_option( 'bootstrap_admin_remove_menu_plugins' );
  $bootstrap_admin_remove_menu_users                = get_option( 'bootstrap_admin_remove_menu_users' );
  $bootstrap_admin_remove_menu_tools                = get_option( 'bootstrap_admin_remove_menu_tools' );
  $bootstrap_admin_remove_menu_settings             = get_option( 'bootstrap_admin_remove_menu_settings' );
  ?>
  <div class="wrap">
    <h2><?php _e( 'Bootstrap Admin Configuration', 'bootstrap_admin' ); ?></h2>
    <div class="postbox">
      <h3 class="hndle" style="padding: 7px 10px;"><span><?php _e( 'Admin Bar', 'bootstrap_admin' ); ?></span></h3>
      <div class="inside">

        <form method="post" action="options.php">
          <?php settings_fields( 'bootstrap_admin_options' ); ?>

          <h4><?php _e( 'Admin Bar Settings', 'bootstrap_admin' ); ?></h4>

          <input id="bootstrap_admin_remove_wp_menu_navbar" name="bootstrap_admin_remove_wp_menu_navbar" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_wp_menu_navbar')); ?> />
          <label class="description" for="bootstrap_admin_remove_wp_menu_navbar">
            <?php _e( 'Hide WordPress menu from the Admin Bar', 'bootstrap_admin' ); ?>
          </label>

          <hr />

          <h4><?php _e( 'Footer Settings', 'bootstrap_admin' ); ?></h4>

          <input id="bootstrap_admin_change_footer_check" name="bootstrap_admin_change_footer_check" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_change_footer_check')); ?> />
          <label class="description" for="bootstrap_admin_change_footer_check">
            <?php _e( 'Change Footer Text', 'bootstrap_admin' ); ?>
          </label>
          
          <?php
          if ( $bootstrap_admin_change_footer_check != 1 ) {
            $bootstrap_admin_change_footer_check_disabled = 'disabled';
            echo '<div style="opacity: 0.7">';
          } else {
            $bootstrap_admin_change_footer_check_disabled = '';
            echo '<div>';
          } ?>

            <input type="text" name="bootstrap_admin_change_footer_text" size="45" <?php echo $bootstrap_admin_change_footer_check_disabled ?> value="<?php echo get_option('bootstrap_admin_change_footer_text'); ?>" />  
            <label class="description" for="bootstrap_admin_change_footer_text">
              <?php _e( 'New Footer text', 'bootstrap_admin' ); ?>
            </label>
          
          </div>

          <input id="bootstrap_admin_hide_footer_upgrade" name="bootstrap_admin_hide_footer_upgrade" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_hide_footer_upgrade')); ?> />
          <label class="description" for="bootstrap_admin_hide_footer_upgrade">
            <?php _e( 'Hide WordPress Version on the Footer', 'bootstrap_admin' ); ?>
          </label>
          
          <hr />

          <h4><?php _e( 'Remove Dashboard Widgets', 'bootstrap_admin' ); ?></h4>

          <input id="bootstrap_admin_remove_welcome_panel" name="bootstrap_admin_remove_welcome_panel" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_welcome_panel')); ?> />
          <label class="description" for="bootstrap_admin_remove_welcome_panel">
            <?php _e( 'Remove Default "Welcome" Panel Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_browser_nag" name="bootstrap_admin_remove_dashboard_browser_nag" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_browser_nag')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_browser_nag">
            <?php _e( 'Remove "Browser Nag" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_right_now" name="bootstrap_admin_remove_dashboard_right_now" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_right_now')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_right_now">
            <?php _e( 'Remove "Right Now" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_recent_comments" name="bootstrap_admin_remove_dashboard_recent_comments" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_recent_comments')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_recent_comments">
            <?php _e( 'Remove "Recent Comments" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_incoming_links" name="bootstrap_admin_remove_dashboard_incoming_links" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_incoming_links')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_incoming_links">
            <?php _e( 'Remove "Incoming Links" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_plugins" name="bootstrap_admin_remove_dashboard_plugins" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_plugins')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_plugins">
            <?php _e( 'Remove "Plugins" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_quick_press" name="bootstrap_admin_remove_dashboard_quick_press" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_quick_press')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_quick_press">
            <?php _e( 'Remove "Quick Press" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_recent_drafts" name="bootstrap_admin_remove_dashboard_recent_drafts" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_recent_drafts')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_recent_drafts">
            <?php _e( 'Remove "Recent Drafts" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_primary" name="bootstrap_admin_remove_dashboard_primary" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_primary')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_primary">
            <?php _e( 'Remove "Primary" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_dashboard_secondary" name="bootstrap_admin_remove_dashboard_secondary" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_dashboard_secondary')); ?> />
          <label class="description" for="bootstrap_admin_remove_dashboard_secondary">
            <?php _e( 'Remove "Secondary" Widget', 'bootstrap_admin' ); ?>
          </label>
          <br />

          <h4><?php _e( 'Remove Default Menu Items', 'bootstrap_admin' ); ?></h4>

          <input id="bootstrap_admin_remove_menu_media" name="bootstrap_admin_remove_menu_media" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_menu_media')); ?> />
          <label class="description" for="bootstrap_admin_remove_menu_media">
            <?php _e( 'Media', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_menu_comments" name="bootstrap_admin_remove_menu_comments" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_menu_comments')); ?> />
          <label class="description" for="bootstrap_admin_remove_menu_comments">
            <?php _e( 'Comments', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_menu_themes" name="bootstrap_admin_remove_menu_themes" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_menu_themes')); ?> />
          <label class="description" for="bootstrap_admin_remove_menu_themes">
            <?php _e( 'Appearance', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_menu_plugins" name="bootstrap_admin_remove_menu_plugins" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_menu_plugins')); ?> />
          <label class="description" for="bootstrap_admin_remove_menu_plugins">
            <?php _e( 'Plugins', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_menu_users" name="bootstrap_admin_remove_menu_users" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_menu_users')); ?> />
          <label class="description" for="bootstrap_admin_remove_menu_users">
            <?php _e( 'Users', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_menu_tools" name="bootstrap_admin_remove_menu_tools" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_menu_tools')); ?> />
          <label class="description" for="bootstrap_admin_remove_menu_tools">
            <?php _e( 'Tools', 'bootstrap_admin' ); ?>
          </label>
          <br />
          <input id="bootstrap_admin_remove_menu_settings" name="bootstrap_admin_remove_menu_settings" type="checkbox" value="1" <?php checked('1', get_option('bootstrap_admin_remove_menu_settings')); ?> />
          <label class="description" for="bootstrap_admin_remove_menu_settings">
            <?php _e( 'Settings', 'bootstrap_admin' ); ?>
          </label>
          <br />

          <?php submit_button(); ?>

        </form>
      </div>
    </div>
  </div>
  <?php
}

/*
 * Takes care of hiding the wordpress logo in the admin bar.
 */
add_action( 'admin_bar_menu', 'bootstrap_admin_remove_wp_menu_navbar', 999 );
function bootstrap_admin_remove_wp_menu_navbar( $wp_admin_bar ) {
  $bootstrap_admin_remove_wp_menu_navbar = get_option( 'bootstrap_admin_remove_wp_menu_navbar' );

  if ( $bootstrap_admin_remove_wp_menu_navbar == 1 ) {
    $wp_admin_bar->remove_node('wp-logo');
  }
}

/*
 * Changes Footer text according to our previous selection.
 */
function bootstrap_admin_change_footer_text () {
  $bootstrap_admin_change_footer_text = get_option( 'bootstrap_admin_change_footer_text' );
  
  echo $bootstrap_admin_change_footer_text;
}
// Only change the footer text if user selected to do so.
if ( get_option( 'bootstrap_admin_change_footer_check' ) == 1 ) {
  add_filter('admin_footer_text', 'bootstrap_admin_change_footer_text');
}

/*
 * Hide WordPress version on the Footer.
 */
function bootstrap_admin_hide_footer_upgrade() {
  echo '';
}
// Only change the footer text if user selected to do so.
if ( get_option( 'bootstrap_admin_hide_footer_upgrade' ) == 1 ) {
  add_filter('update_footer', 'bootstrap_admin_hide_footer_upgrade', 100);
}

/*
 * Removes Dashboard Widgets
 */
function bootstrap_admin_remove_dashboard_widgets() {
  $bootstrap_admin_remove_welcome_panel             = get_option( 'bootstrap_admin_remove_welcome_panel' );
  $bootstrap_admin_remove_dashboard_browser_nag     = get_option( 'bootstrap_admin_remove_dashboard_browser_nag' );
  $bootstrap_admin_remove_dashboard_right_now       = get_option( 'bootstrap_admin_remove_dashboard_right_now' );
  $bootstrap_admin_remove_dashboard_recent_comments = get_option( 'bootstrap_admin_remove_dashboard_recent_comments' );
  $bootstrap_admin_remove_dashboard_incoming_links  = get_option( 'bootstrap_admin_remove_dashboard_incoming_links' );
  $bootstrap_admin_remove_dashboard_plugins         = get_option( 'bootstrap_admin_remove_dashboard_plugins' );
  $bootstrap_admin_remove_dashboard_quick_press     = get_option( 'bootstrap_admin_remove_dashboard_quick_press' );
  $bootstrap_admin_remove_dashboard_recent_drafts   = get_option( 'bootstrap_admin_remove_dashboard_recent_drafts' );
  $bootstrap_admin_remove_dashboard_primary         = get_option( 'bootstrap_admin_remove_dashboard_primary' );
  $bootstrap_admin_remove_dashboard_secondary       = get_option( 'bootstrap_admin_remove_dashboard_secondary' );
  
  if ( $bootstrap_admin_remove_welcome_panel == 1 ) {
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
  }
  if ( $bootstrap_admin_remove_dashboard_browser_nag == 1 ) {
    remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );
  }
  if ( $bootstrap_admin_remove_dashboard_right_now == 1 ) {
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
  }
  if ( $bootstrap_admin_remove_dashboard_recent_comments == 1 ) {
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
  }
  if ( $bootstrap_admin_remove_dashboard_incoming_links == 1 ) {
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  }
  if ( $bootstrap_admin_remove_dashboard_plugins == 1 ) {
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  }
  if ( $bootstrap_admin_remove_dashboard_quick_press == 1 ) {
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  }
  if ( $bootstrap_admin_remove_dashboard_recent_drafts == 1 ) {
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
  }
  if ( $bootstrap_admin_remove_dashboard_primary == 1 ) {
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  }
  if ( $bootstrap_admin_remove_dashboard_secondary == 1 ) {
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
  }
}
add_action( 'wp_dashboard_setup', 'bootstrap_admin_remove_dashboard_widgets' );

/*
 * Removes Default WordPress menus
 */
function bootstrap_admin_remove_default_menus() {
  global $menu;
  $bootstrap_admin_remove_menu_media                = get_option( 'bootstrap_admin_remove_menu_media' );
  $bootstrap_admin_remove_menu_comments             = get_option( 'bootstrap_admin_remove_menu_comments' );
  $bootstrap_admin_remove_menu_themes               = get_option( 'bootstrap_admin_remove_menu_themes' );
  $bootstrap_admin_remove_menu_plugins              = get_option( 'bootstrap_admin_remove_menu_plugins' );
  $bootstrap_admin_remove_menu_users                = get_option( 'bootstrap_admin_remove_menu_users' );
  $bootstrap_admin_remove_menu_tools                = get_option( 'bootstrap_admin_remove_menu_tools' );
  $bootstrap_admin_remove_menu_settings             = get_option( 'bootstrap_admin_remove_menu_settings' );
  
  if ( $bootstrap_admin_remove_menu_media == 1 ) {
    remove_menu_page( 'upload.php' );
  }
  if ( $bootstrap_admin_remove_menu_comments == 1 ) {
    remove_menu_page( 'edit-comments.php' );
  }
  if ( $bootstrap_admin_remove_menu_themes == 1 ) {
    remove_menu_page( 'themes.php' );
  }
  if ( $bootstrap_admin_remove_menu_plugins == 1 ) {
    remove_menu_page( 'plugins.php' );
  }
  if ( $bootstrap_admin_remove_menu_users == 1 ) {
    remove_menu_page( 'users.php' );
  }
  if ( $bootstrap_admin_remove_menu_tools == 1 ) {
    remove_menu_page( 'tools.php' );
  }
  if ( $bootstrap_admin_remove_menu_settings == 1 ) {
    remove_menu_page( 'options-general.php' );
  }
}
add_action('admin_menu', 'bootstrap_admin_remove_default_menus');
