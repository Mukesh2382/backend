<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mukesh.com
 * @since      1.0.0
 *
 * @package    Backend
 * @subpackage Backend/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Backend
 * @subpackage Backend/admin
 * @author     Mukesh <mukesh@mukesh.com>
 */
class Backend_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Backend_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Backend_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/backend-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Backend_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Backend_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/backend-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function create_books_post_type() {
		$labels = array(
			'name'               => __( 'Books', 'twentyseventeen' ),
			'singular_name'      => __( 'Book', 'twentyseventeen' ),
			'add_new'            => __( 'Add New Book', 'twentyseventeen' ),
			'add_new_item'       => __( 'Add New Book', 'twentyseventeen' ),
			'edit_item'          => __( 'Edit Book', 'twentyseventeen' ),
			'new_item'           => __( 'New Book', 'twentyseventeen' ),
			'view_item'          => __( 'View Book', 'twentyseventeen' ),
			'search_items'       => __( 'Search Books', 'twentyseventeen' ),
			'not_found'          => __( 'No books found', 'twentyseventeen' ),
			'not_found_in_trash' => __( 'No books found in Trash', 'twentyseventeen' ),
			'parent_item_colon'  => __( 'Parent Book:', 'twentyseventeen' ),
			'menu_name'          => __( 'Books', 'twentyseventeen' ),
		);
	
		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'has_archive'         => true,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => 'books' ),
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-book',
			'single'      		  => true,
			'show_in_rest' 		  => true,
		);
	
		register_post_type( 'book', $args );
	}
}
