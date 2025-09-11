<?php 
	add_action('init','university_post_types');

function university_post_types(){
	// Campus post type
	register_post_type('campus', array(
		'labels' => array(
			'name' => 'Campuses',
			'add_new_item' => 'Add New Campus',
			'edit_item' => 'Edit Campus',
			'all_items' => 'All Campuses',
			'singular_name' => 'Campus',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-location-alt',
		'has_archive' => true,
		'supports' => array('title', 'editor', 'excerpt'),
		'rewrite' => array('slug' => 'campuses'),
	));
	// Event post type
	register_post_type('event', array(
		'capability_type' => 'event',
		'map_meta_cap' => true,
		'rewrite' => array('slug' => 'events'),
		'labels' => array(
			'name' => 'Events',
			'add_new_item' => 'Add New Event',
			'edit_item' => 'Edit Event',
			'all_items' => 'All Events',
			'singular_name' => 'Event',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-calendar',
		'has_archive' => true,
		'supports' => array('title', 'editor', 'excerpt'),
	));

	// Program post type
	register_post_type('program', array(
		'rewrite' => array('slug' => 'programs'),
		'labels' => array(
			'name' => 'Programs',
			'add_new_item' => 'Add New Program',
			'edit_item' => 'Edit Program',
			'all_items' => 'All Programs',
			'singular_name' => 'Program',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-awards',
		'has_archive' => true,
		'supports' => array('title'),
	));

	// Professor post type
	register_post_type('professor', array(
		'labels' => array(
			'name' => 'Professors',
			'add_new_item' => 'Add New Professor',
			'edit_item' => 'Edit Professor',
			'all_items' => 'All Professors',
			'singular_name' => 'Professor',
		),
		'public' => true,
		'show_in_rest' => true,
				'has_archive' => true,

		'menu_icon' => 'dashicons-welcome-learn-more',
		'supports' => array('title', 'editor','thumbnail'),
	));

	// Note post type
	register_post_type('note', array(
		'capability_type' => 'note',
		'map_meta_cap' => true,
		'public' => false,
		'show_ui' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'supports' => array('title', 'editor'),
		'labels' => array(
			'name' => 'Notes',
			'add_new_item' => 'Add New Note',
			'edit_item' => 'Edit Note',
			'all_items' => 'All Notes',
			'singular_name' => 'Note',
		),
	));

	// Like post type
	register_post_type('like', array(
		'public' => false,
		'show_ui' => true,
		'menu_icon' => 'dashicons-heart',
		'supports' => array('title'),
		'labels' => array(
			'name' => 'Likes',
			'add_new_item' => 'Add New Like',
			'edit_item' => 'Edit Like',
			'all_items' => 'All Likes',
			'singular_name' => 'Like',
		),
	));
}
?>