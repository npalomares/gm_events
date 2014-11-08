<?
function create_event() {
	$labels = array(
		'name'                => 'Event',
		'singular_name'       => 'Event',
		'menu_name'           => 'Event',
		'parent_item_colon'   => 'Parent Event:',
		'all_items'           => 'All Event Items',
		'view_item'           => 'View Events',
		'add_new_item'        => 'Add New Event',
		'add_new'             => 'New Event',
		'edit_item'           => 'Edit Event',
		'update_item'         => 'Update Event',
		'search_items'        => 'Search Events',
		'not_found'           => 'No Events found',
		'not_found_in_trash'  => 'No Event found in Trash',
	);

	$args = array(
		'label'               => 'Events',
		'description'         => 'Event post type',
		'labels'              => $labels,
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor'),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'capability_type'     => 'page',
		'menu_icon' => plugins_url( 'gm_icon_bw.png', __FILE__ ),
		'rewrite'            => array( 'slug' => 'events' ),
	);

	register_post_type( 'events', $args );
}

// Hook into the 'init' action
add_action( 'init', 'create_event', 0 );

  // Custom image size for Event pages

  add_image_size('event-thumb', 720, 460, true);

?>