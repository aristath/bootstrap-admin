<?php

/*
Plugin Name: Bootstrap Admin
Plugin URI: http://aristeides.com
Description: Bootstrap Admin Theme - Upload and Activate.
Author: Aristeides Stathopoulos
Version: 0.1
Author URI: http://aristeides.com
*/

function bootstrap_admin() {
	echo '<script type="text/javascript" src="' .plugins_url('js/bootstrap.min.js', __FILE__). '"></script>';
	echo '<script type="text/javascript" src="' .plugins_url('js/script.js', __FILE__). '"></script>';
	echo '<link rel="stylesheet" type="text/less" href="' .plugins_url('css/style.css', __FILE__). '">';
}

add_action('admin_head', 'bootstrap_admin');

?>
    

