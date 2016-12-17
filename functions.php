<?php
function my_theme_enqueue_styles() {
	// Enqueues the parent theme styles
	wp_enqueue_style('baton-style', get_template_directory_uri() . '/style.css');
	// Enqueues my child styles
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('baton-style'), wp_get_theme()->get('Version'));

	// Enqueues my custom JS
	wp_enqueue_script('my-scripts', get_stylesheet_directory_uri() . '/scripts.js', '', '', true);
	// Enqueues Google Maps JS API
	wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA3qMD5e6ox4vSJRiiUVUITQXd9Da5zCik&callback=initMap', array('my-scripts'), '', true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Disables edit links when logged in
add_filter('edit_post_link', '__return_false');

// Displays Custom Post Types in At a Glance widget in admin
// http://wordpress.stackexchange.com/a/138823
function cpad_at_glance_content_table_end() {
	$args = array(
		'public' => true,
		'_builtin' => false
	);
	$output = 'object';
	$operator = 'and';
	$post_types = get_post_types($args, $output, $operator);
	foreach ($post_types as $post_type) {
		$num_posts = wp_count_posts($post_type->name);
		$num = number_format_i18n($num_posts->publish);
		$text = _n($post_type->labels->singular_name, $post_type->labels->name, intval($num_posts->publish));
		if (current_user_can('edit_posts')) {
			$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
			echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
		}
	}
}
add_action('dashboard_glance_items', 'cpad_at_glance_content_table_end');

// Generates Custom Post Type for Bulletins
function bulletins_post_type() {
	$labels = array(
		'name'                  => 'Bulletins',
		'singular_name'         => 'Bulletin',
		'menu_name'             => 'Bulletins',
		'name_admin_bar'        => 'Bulletin',
		'archives'              => 'Bulletin Archives',
		'attributes'            => 'Bulletin Attributes',
		'parent_item_colon'     => 'Parent Bulletin:',
		'all_items'             => 'All Bulletins',
		'add_new_item'          => 'Add New Bulletin',
		'add_new'               => 'Add New',
		'new_item'              => 'New Bulletin',
		'edit_item'             => 'Edit Bulletin',
		'update_item'           => 'Update Bulletin',
		'view_item'             => 'View Bulletin',
		'view_items'            => 'View Bulletins',
		'search_items'          => 'Search Bulletins',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into bulletin',
		'uploaded_to_this_item' => 'Uploaded to this bulletin',
		'items_list'            => 'Bulletins list',
		'items_list_navigation' => 'Bulletins list navigation',
		'filter_items_list'     => 'Filter bulletins list',
	);
	$args = array(
		'label'                 => 'Bulletin',
		'description'           => 'PDF of this week\\\'s bulletin',
		'labels'                => $labels,
		'supports'              => array('title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-media-document',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type('bulletin', $args);
}
add_action('init', 'bulletins_post_type', 0);

// Generates Custom Post Type for Sermons
function sermons_post_type() {
	$labels = array(
		'name'                  => 'Sermons',
		'singular_name'         => 'Sermon',
		'menu_name'             => 'Sermons',
		'name_admin_bar'        => 'Sermon',
		'archives'              => 'Sermon Archives',
		'attributes'            => 'Sermon Attributes',
		'parent_item_colon'     => 'Parent Sermon:',
		'all_items'             => 'All Sermons',
		'add_new_item'          => 'Add New Sermon',
		'add_new'               => 'Add New',
		'new_item'              => 'New Sermon',
		'edit_item'             => 'Edit Sermon',
		'update_item'           => 'Update Sermon',
		'view_item'             => 'View Sermon',
		'view_items'            => 'View Sermons',
		'search_items'          => 'Search Sermons',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into sermon',
		'uploaded_to_this_item' => 'Uploaded to this sermon',
		'items_list'            => 'Sermons list',
		'items_list_navigation' => 'Sermons list navigation',
		'filter_items_list'     => 'Filter sermon list',
	);
	$args = array(
		'label'                 => 'Sermon',
		'description'           => 'Audio of this week\\\'s sermon',
		'labels'                => $labels,
		'supports'              => array('title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type('sermon', $args);
}
add_action('init', 'sermons_post_type', 0);

function cmb2_metaboxes() {
	$prefix = '_cmb2_';
	// Initiates a CMB2 box for this week's bulletin
	$cmb = new_cmb2_box(array(
		'id'           => 'bulletin_metabox',
		'title'        => 'Bulletin File',
		'object_types' => array('bulletin'),
		'show_names'   => false
	));
	$cmb->add_field(array(
		'name' => 'Bulletin File',
		'desc' => 'PDF or DOC of this week\'s bulletin',
		'id'   => $prefix . 'bulletin_file',
		'type' => 'file'
	));

	// Initiates a CMB2 box for this week's sermon
	$cmb = new_cmb2_box(array(
		'id'           => 'sermon_metabox',
		'title'        => 'Sermon File',
		'object_types' => array('sermon'),
		'show_names'   => false
	));
	$cmb->add_field(array(
		'name' => 'Sermon File',
		'desc' => 'Audio of this week\'s sermon',
		'id'   => $prefix . 'sermon_file',
		'type' => 'file'
	));
}
add_action('cmb2_admin_init', 'cmb2_metaboxes');
