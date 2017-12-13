<?php
/**
 * Loader Class
 *
 * @package LightSlider
 */

/**
 * Class LightSlider
 */
class LightSlider {
	/**
	 * Class instance.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Gets class instance.
	 *
	 * @return object
	 */
	public static function get_instance() {
		if ( ! static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'lightslider_load_plugin_textdomain' ) );
		add_action( 'plugins_loaded', array( $this, 'init_hooks' ) );
	}

	/**
	 * Hook into actions and filters.
	 */
	public function init_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'widgets_init', array( $this, 'register_widget' ) );

		new \LightSlider\Page();
		new \LightSlider\Metabox();
		do_action( 'lightslider_loaded' );
	}

	/**
	 * Load Localisation files.
	 */
	public function lightslider_load_plugin_textdomain() {
		load_plugin_textdomain( 'lightslider', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Registers scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'lightslider', LIGHTSLIDER_URL . 'assets/css/lightslider.min.css', array(), '1.1.3' );

		wp_enqueue_style( 'main', LIGHTSLIDER_URL . 'assets/css/main.css', array(), '1.0.0' );

		wp_enqueue_script( 'lightslider', LIGHTSLIDER_URL . 'assets/js/lightslider.min.js', array( 'jquery' ), '1.1.6', true );

		wp_enqueue_script( 'main', LIGHTSLIDER_URL . 'assets/js/main.js', array( 'jquery' ), '1.0.0', true );
	}

	/**
	 * Registers Widget.
	 */
	public function register_widget() {
		register_widget( 'LightSlider\Widget' );
	}
}

/**
 * Gets lightslider instance.
 *
 * @return LightSlider
 */
function lightslider() {
	return LightSlider::get_instance();
}

// Global for backwards compatibility.
$GLOBALS['lightslider'] = lightslider();

