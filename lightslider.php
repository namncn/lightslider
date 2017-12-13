<?php
/**
 * Plugin Name: Light Slider
 * Plugin URI: http://phoenixdigi.vn
 * Description: A simple slider plugin for Wordpress.
 * Version: 1.0.0
 * Author: Nam NCN
 * Author URI: http://namncn.com
 * Requires at least: 4.9
 * Tested up to: 4.9
 *
 * Text Domain: lightslider
 * Domain Path: /languages/
 *
 * @package LightSlider
 * @link http://phoenixdigi.vn/plugins/light-slider/
 * @author PhoenixDigiVietNam
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define LIGHTSLIDER_PATH.
if ( ! defined( 'LIGHTSLIDER_PATH' ) ) {
	define( 'LIGHTSLIDER_PATH', plugin_dir_path( __FILE__ ) );
}

// Define LIGHTSLIDER_URL.
if ( ! defined( 'LIGHTSLIDER_URL' ) ) {
	define( 'LIGHTSLIDER_URL', plugin_dir_url( __FILE__ ) );
}

require_once LIGHTSLIDER_PATH . 'vendor/autoload.php';
