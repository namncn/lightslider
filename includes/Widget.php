<?php
/**
 * Metabox class
 *
 * @package LightSlider
 */

namespace LightSlider;

use WP_Widget;
use WP_Query;

class Widget extends WP_Widget {
	/**
	 * Constructor.
	 *
	 * @param array $fields //.
	 */
	public function __construct() {

		$widget_ops = array(
			'description'                 => __( 'Add a Slider to your sidebar.', 'lightslider' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'lightslider', __( 'Light Slider', 'lightslider' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Slider widget instance.
	 *
	 * @since 3.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Slider widget instance.
	 */
	public function widget( $args, $instance ) {
		$number = isset( $instance['title'] ) ? $instance['title'] : '';

		echo $args['before_widget'];

		$post_args = array(
			'post_type'           => 'lightslider',
			'post_per_page'       => $instance['number'],
			'ignore_sticky_posts' => 1,
		);

		$the_query = new WP_Query( $post_args );
		?>

		<?php if ( $the_query->have_posts() ) : ?>
		<ul class="lightslider cS-hidden">
			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<li>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="slide-images"><?php the_post_thumbnail(); ?></div>
			<?php endif; ?>
				<div class="slide-content">
					<div class="container">
					<?php echo get_the_content(); ?>
					</div>
				</div>
			</li>
			<?php endwhile;
			wp_reset_postdata(); ?>
	</ul>
	<?php endif; ?>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Slider widget instance.
	 *
	 * @since 3.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = (array) $old_instance;
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['number'] ) ) {
			$instance['number'] = $new_instance['number'];
		}

		return $instance;
	}

	/**
	 * Outputs the settings form for the Slider widget.
	 *
	 * @since 3.0.0
	 *
	 * @param array $instance Current settings.
	 * @global WP_Customize_Manager $wp_customize
	 */
	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? $instance['number'] : '';

		// If no menus exists, direct the user to go and create some.
		?>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Chọn số Slider muốn hiển thị', 'lightslider' ); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
		<?php
	}
}
