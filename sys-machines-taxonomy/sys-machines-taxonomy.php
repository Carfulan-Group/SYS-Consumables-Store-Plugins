<?php
	/*
	 * Plugin Name: SYS Machines Product Taxonomy
	 * Description: This plugin adds "Machines" taxonomy to the "Products" post type. This is then used for some theme functions and sorting.
	 * Version: 1.0.0
	 * Author: Sam Mckay
	 * Author URI: http://github.com/sammckay10
	*/

	add_action ( 'init', 'machines' );

	function machines ()
	{
		$labels = array (
			'name'                  => _x ( 'Machines', 'Machines', 'machines' ),
			'singular_name'         => _x ( 'Machine', 'Machine', 'machines' ),
			'search_items'          => __ ( 'Search Machines', 'machines' ),
			'popular_items'         => __ ( 'Popular Machines', 'machines' ),
			'all_items'             => __ ( 'All Machines', 'machines' ),
			'parent_item'           => __ ( 'Parent Machine', 'machines' ),
			'parent_item_colon'     => __ ( 'Parent Machine', 'machines' ),
			'edit_item'             => __ ( 'Edit Machine', 'machines' ),
			'update_item'           => __ ( 'Update Machine', 'machines' ),
			'add_new_item'          => __ ( 'Add New Machine', 'machines' ),
			'new_item_name'         => __ ( 'New Machine Name', 'machines' ),
			'add_or_remove_items'   => __ ( 'Add or remove Machines', 'machines' ),
			'choose_from_most_used' => __ ( 'Choose from most used machines', 'machines' ),
			'menu_name'             => __ ( 'Machine', 'machines' ),
		);
		$args   = array (
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'hierarchical'      => false,
			'show_tagcloud'     => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => true,
			'capabilities'      => array (),
		);
		register_taxonomy ( 'taxonomy-machines', array ( 'product' ), $args );
	}