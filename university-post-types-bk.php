<?php 
	add_action('init','university_post_types');

function university_post_types(){
	// Event post type
	register_post_type('event', array(
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
		'supports' => array('title', 'editor'),
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
		'supports' => array('title', 'editor'),
	));
}
?>