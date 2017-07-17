<?php
/* 
Plugin Name: TWB Woocommerce Reviews
Plugin URI: http://theweb-designs.com/plugins/
Description: This plugin let's you add Woocommerce product reviews on a page/post using shortcode. You can specify reviews per product basis, exclude specific reviews, limit the number of reviews displayed and more. There are three layouts. Slider and List and Masonry. The plugin is responsive and easily customizable.
Author: Abu Bakar
Author URI: http://www.theweb-designs.com
Version: 1.6
License: GPLv2

Copyright 2015 TWB Woocommerce Reviews developer@theweb-designs.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

==============================================================*/

// Exit if accessed directly
if (!defined('ABSPATH')) {  echo "Oops! No direct access please :)"; exit; }

//Define Directory Separator
if (!defined('DS')) { define('DS','/');  }

// Check if woocommerce is installed
add_action('admin_notices', 'twb_wcr_admin_notice');
function twb_wcr_admin_notice() {
	if (! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		echo '<div class="error"><p>'; 
        printf('TWB Woocommerce Reviews plugin requires WooCommerce plugin to be installed and activated.');
        echo "</p></div>";
	}
}

//Define plugin path
define('TWB_WC_REVIEWS_DIR', plugin_dir_path( __FILE__ ));
define('TWB_WC_REVIEWS_URL', plugin_dir_url( __FILE__ ));

//register admin script
add_action( 'admin_enqueue_scripts', 'twb_wc_reviews_admin_scripts' );
function twb_wc_reviews_admin_scripts( $hook_suffix ) {
	if ( 'settings_page_twb-woocommerce-reviews/admin/options' !== $hook_suffix )
	return;
	
    //enqueue iris colorpicker
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'twb_wcr_admin_js', TWB_WC_REVIEWS_URL . 'admin/js/admin_js.js', array('jquery', 'wp-color-picker'), null, true);
}

// Register Frontend styles
add_action('wp_enqueue_scripts', 'twb_wc_reviews_scripts');
function twb_wc_reviews_scripts() {
		wp_enqueue_style( 'twb_wc_reviews_styles', TWB_WC_REVIEWS_URL. 'inc/css/twb_wc_reviews_main.css', array(), null, null, 'all' );
		//wp_enqueue_style( 'twb_wc_reviews_dynamic_styles', TWB_WC_REVIEWS_URL. 'inc/css/twb_wc_reviews_dynamic.php', array(), null, null, 'all' );
		wp_enqueue_style( 'twb_wc_reviews_slick_css', TWB_WC_REVIEWS_URL . 'inc/css/slick.css', array(), null, null, 'all' );
		wp_enqueue_script( 'twb_wc_reviews_slick_js', TWB_WC_REVIEWS_URL . 'inc/js/slick.min.js', array(), '1.5.7', true);
		//wp_enqueue_script( 'twb_wc_reviews_custom_js', TWB_WC_REVIEWS_URL . 'inc/js/twb_wc_reviews_custom.php', array(), null, true);
		
		$options =   get_option( 'twb_wc_reviews_option' );
		if( isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'List')  {
			wp_dequeue_style( 'twb_wc_reviews_slick_css' );
			wp_dequeue_script( 'twb_wc_reviews_slick_js' );
		}
		if( isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'Masonry')  {	
			wp_dequeue_style( 'twb_wc_reviews_slick_css' );
			wp_dequeue_script( 'twb_wc_reviews_slick_js' );
			wp_enqueue_script( 'masonry' );	
		
			if(isset ($options['twb_wcr_ms_external_lib']) ) :
				wp_enqueue_script( 'twb_wc_ms_external_lib', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.1/masonry.pkgd.min.js', array('imagesloaded'), null, true );
			endif;
		}
	}
//include files
require TWB_WC_REVIEWS_DIR . 'twb-output.php';
require TWB_WC_REVIEWS_DIR . 'twb_wc_reviews_functions.php';
require TWB_WC_REVIEWS_DIR . 'admin/options.php';