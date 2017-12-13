<?php
/**
 * PostType class
 *
 * @package LightSlider
 */

namespace LightSlider;

/**
 * Class PostType
 */
class PostType {
	/**
	 * List of fields.
	 *
	 * @var array
	 */
	protected $fields = array();

	/**
	 * Constructor.
	 *
	 * @param array $fields Cata.
	 */
	public function __construct( $fields ) {

		$fields = $this->normalize( $fields );

		$this->fields = $fields;

		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * Registers a new post type
	 * @uses $wp_post_types Inserts new post type object into the list
	 *
	 * @param string  Post type key, must not exceed 20 characters
	 * @param array|string  See optional args description above.
	 * @return object|WP_Error the registered post type object, or an error object
	 */
	public function register_post_type() {

		$fields = $this->fields;

		$labels = array(
			'name'               => $fields['name'],
			'singular_name'      => $fields['singular_name'],
			'add_new'            => $fields['add_new'],
			'add_new_item'       => $fields['add_new_item'],
			'edit_item'          => $fields['edit_item'],
			'new_item'           => $fields['new_item'],
			'view_item'          => $fields['view_item'],
			'search_items'       => $fields['search_items'],
			'not_found'          => $fields['not_found'],
			'not_found_in_trash' => $fields['not_found_in_trash'],
			'parent_item_colon'  => $fields['parent_item_colon'],
			'menu_name'          => $fields['menu_name'],
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'description'         => 'description',
			'taxonomies'          => array(),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => $fields['menu_position'],
			'menu_icon'           => $fields['menu_icon'],
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => $fields['rewrite'],
			'capability_type'     => 'post',
			'supports'            => $fields['supports'],
		);

		register_post_type( $fields['slug'], $args );
	}

	/**
	 * Normalizes fields data.
	 *
	 * @param  array $fields Page data.
	 * @return array
	 */
	protected function normalize( $fields ) {
		$fields = wp_parse_args( $fields, array(
			'slug'               => 'example',
			'name'               => __( 'Plural Name', 'lightslider' ),
			'singular_name'      => __( 'Singular Name', 'lightslider' ),
			'add_new'            => _x( 'Add New Singular Name', 'lightslider', 'lightslider' ),
			'add_new_item'       => __( 'Add New Singular Name', 'lightslider' ),
			'edit_item'          => __( 'Edit Singular Name', 'lightslider' ),
			'new_item'           => __( 'New Singular Name', 'lightslider' ),
			'view_item'          => __( 'View Singular Name', 'lightslider' ),
			'search_items'       => __( 'Search Plural Name', 'lightslider' ),
			'not_found'          => __( 'No Plural Name found', 'lightslider' ),
			'not_found_in_trash' => __( 'No Plural Name found in Trash', 'lightslider' ),
			'parent_item_colon'  => __( 'Parent Singular Name:', 'lightslider' ),
			'menu_name'          => __( 'Plural Name', 'lightslider' ),
			'menu_position'      => null,
			'menu_icon'          => null,
			'rewrite'            => true,
			'supports'           => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'trackbacks',
				'comments',
				'revisions',
				'page-attributes',
				'post-formats',
			),
		) );

		return $fields;
	}
}
