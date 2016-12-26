<?php
function my_theme_enqueue_styles() {
	// Enqueues my custom JS
	wp_enqueue_script('my-scripts', get_stylesheet_directory_uri() . '/scripts.js', '', '', true);
	// Enqueues Google Maps JS API
	wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA3qMD5e6ox4vSJRiiUVUITQXd9Da5zCik&callback=initMap', array('my-scripts'), '', true);
	// Enqueues my smooth scroll JS
	wp_enqueue_script('smooth-scroll', get_stylesheet_directory_uri() . '/smoothscroll.min.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Displays Custom Post Types in At a Glance widget in admin
// https://github.com/pschfr/wp-plugins/
function cpad_at_glance_content_table_end() {
	$post_types = get_post_types(array(
		'public'   => true,
		'_builtin' => false
	), 'object', 'and');

	if (current_user_can('edit_posts')) {
		echo "<style>
			#dashboard_right_now li a:before { content: ''; }
			#dashboard_right_now li div.wp-menu-image { display: inline; }
			#dashboard_right_now li div.wp-menu-image:before { color: #a0a5aa; padding: 0; }
		</style>\n";
	}

	foreach ($post_types as $post_type) {
		$num_posts = wp_count_posts($post_type->name);
		$num = number_format_i18n($num_posts->publish);
		$text = _n($post_type->labels->singular_name, $post_type->labels->name, intval($num_posts->publish));
		if (current_user_can('edit_posts')) {
			$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
			echo '<li><div class="wp-menu-image dashicons-before ' . $post_type->menu_icon . '"></div>' . $output . '</li>';
		}
	}
}
add_action('dashboard_glance_items', 'cpad_at_glance_content_table_end');

// Generates Custom Post Type for Weekly Bulletins and Sermons
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

// Initiates CMB2 metaboxes for weekly bulletin and sermon
function cmb2_metaboxes() {
	$cmb = new_cmb2_box(array(
		'id'           => 'bulletin_metabox',
		'title'        => 'Bulletin File',
		'object_types' => array('bulletin'),
		'show_names'   => false
	));
	$cmb->add_field(array(
		'name' => 'Bulletin File',
		'desc' => 'PDF or DOC of this week\'s bulletin',
		'id'   => '_cmb2_bulletin_file',
		'type' => 'file'
	));

	$cmb = new_cmb2_box(array(
		'id'           => 'sermon_metabox',
		'title'        => 'Sermon File',
		'object_types' => array('sermon'),
		'show_names'   => false
	));
	$cmb->add_field(array(
		'name' => 'Sermon File',
		'desc' => 'Audio of this week\'s sermon',
		'id'   => '_cmb2_sermon_file',
		'type' => 'file'
	));
}
add_action('cmb2_admin_init', 'cmb2_metaboxes');

function sds_social_media() {
	global $sds_theme_options;

	if ( ! empty( $sds_theme_options['social_media'] ) ) {
		// Map the correct values for social icon display (FontAwesome webfont, i.e. 'fa-rss' = RSS icon)
		$social_font_map = array(
			'facebook_url' => array(
				'icon' => 'fa fa-facebook',
				'label' => __( 'Facebook', 'baton' )
			),
			'twitter_url' => array(
				'icon' => 'fa fa-twitter',
				'label' => __( 'Twitter', 'baton' )
			),
			'linkedin_url' => array(
				'icon' => 'fa fa-linkedin',
				'label' => __( 'LinkedIn', 'baton' )
			),
			'google_plus_url' => array(
				'icon' => 'fa fa-google-plus',
				'label' => __( 'Google+', 'baton' )
			),
			'youtube_url' => array(
				'icon' => 'fa fa-youtube',
				'label' => __( 'YouTube', 'baton' )
			),
			'vimeo_url' => array(
				'icon' => 'fa fa-vimeo-square',
				'label' => __( 'Vimeo', 'baton' )
			),
			'pinterest_url' => array(
				'icon' => 'fa fa-pinterest',
				'label' => __( 'Pinterest', 'baton' )
			),
			'instagram_url' => array(
				'icon' => 'fa fa-instagram',
				'label' => __( 'Instagram', 'baton' )
			),
			'flickr_url' => array(
				'icon' => 'fa fa-flickr',
				'label' => __( 'Flickr', 'baton' )
			),
			'foursquare_url' => array(
				'icon' => 'fa fa-foursquare',
				'label' => __( 'Foursquare', 'baton' )
			),
			'rss_url' => array(
				'icon' => 'fa fa-rss',
				'label' => __( 'RSS', 'baton' )
			),
		);

		$social_font_map = apply_filters( 'sds_social_icon_map', $social_font_map );
		?>

		<div class="social-media-icons baton-flex baton-flex-5-columns baton-flex-social-media">
			<?php
				foreach( $sds_theme_options['social_media'] as $key => $url ) :
					// RSS (use site RSS feed, $url is Boolean this case)
					if ( $key === 'rss_url_use_site_feed' && $url ) :
				?>
						<a href="<?php esc_attr( bloginfo( 'rss2_url' ) ); ?>" class="rss-url baton-col baton-col-social-media" target="_blank">
							<span class="social-media-icon <?php echo esc_attr( $social_font_map['rss_url']['icon'] ); ?>"></span>
							<br />
							<span class="social-media-label rss-url-label"><?php echo $social_font_map['rss_url']['label']; ?></span>
						</a>
				<?php
					// RSS (use custom RSS feed)
					elseif ( $key === 'rss_url' && ! $sds_theme_options['social_media']['rss_url_use_site_feed'] && ! empty( $url ) ) :
				?>
						<a href="<?php echo esc_attr( $url ); ?>" class="rss-url baton-col baton-col-social-media" target="_blank">
							<span class="social-media-icon <?php echo esc_attr( $social_font_map['rss_url']['icon'] ); ?>"></span>
							<br />
							<span class="social-media-label rss-url-label"><?php echo $social_font_map['rss_url']['label']; ?></span>
						</a>
				<?php
					// All other networks
					elseif ( $key !== 'rss_url_use_site_feed' && $key !== 'rss_url' && ! empty( $url ) ) :
						$css_class = str_replace( '_', '-', $key ); // Replace _ with -
				?>
						<a href="<?php echo esc_attr( $url ); ?>" class="<?php echo esc_attr( $css_class ); ?> baton-col baton-col-social-media" target="_blank">
							<span class="social-media-icon <?php echo esc_attr( $social_font_map[$key]['icon'] ); ?>"></span>
							<br />
							<span class="social-media-label <?php echo esc_attr( $css_class ); ?>-label"><?php echo $social_font_map[$key]['label']; ?></span>
						</a>
				<?php
					endif;
				endforeach;
			?>
			<a class="to-top baton-col baton-col-social-media" href="#header">
				<span class="fa fa-chevron-circle-up" aria-hidden="true"></span>
				<br>
				<span class="social-media-label rss-url-label">To Top</span>
			</a>
		</div>
	<?php
	}
}
