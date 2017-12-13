<?php
/**
 * Page class
 *
 * @package LightSlider
 */

namespace LightSlider;

/**
 * Class Page
 */
class Page extends PostType {
	/**
	 * Constructor.
	 *
	 * @param array $data Cata.
	 */
	public function __construct() {

		parent::__construct( $this->pd_register_post_type() );
	}

	/**
	 * Load Localisation files.
	 */
	public function pd_register_post_type() {

		$fields = array(
			'slug'               => 'lightslider',
			'name'               => __( 'Light Slider', 'lightslider' ),
			'singular_name'      => __( 'Light Slider', 'lightslider' ),
			'add_new'            => _x( 'Thêm mới', 'lightslider', 'lightslider' ),
			'add_new_item'       => __( 'Thêm mới', 'lightslider' ),
			'edit_item'          => __( 'Chỉnh sửa', 'lightslider' ),
			'new_item'           => __( 'Slider mới', 'lightslider' ),
			'view_item'          => __( 'Xem Slider', 'lightslider' ),
			'search_items'       => __( 'Tìm kiếm Slider', 'lightslider' ),
			'not_found'          => __( 'Không tìm thấy Slider nào', 'lightslider' ),
			'not_found_in_trash' => __( 'Không tìm thấy Slider trong kho chứa tạm', 'lightslider' ),
			'parent_item_colon'  => __( 'Parent Light Slider:', 'lightslider' ),
			'menu_name'          => __( 'Light Slider', 'lightslider' ),
			'menu_position'      => 6,
			'menu_icon'          => 'dashicons-images-alt',
			'rewrite'            => true,
			'supports'           => array(
				'title',
				'editor',
				'thumbnail',
				'revisions',
			),
		);

		return $fields;
	}
}
