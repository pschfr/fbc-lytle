<?php
	// Bail if accessed directly
	if ( ! defined( 'ABSPATH' ) )
		exit;

	global $multipage, $post;

	// Loop through posts
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
?>
		<?php if ( has_post_thumbnail() ): ?>
			<!-- Post Thumbnail/Featured Image -->
			<div class="article-thumbnail-wrap article-featured-image-wrap post-thumbnail-wrap featured-image-wrap cf">
				<?php sds_featured_image(); ?>
			</div>
			<!-- End Post Thumbnail/Featured Image -->
		<?php endif; ?>

		<!-- Article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( 'content content-' . $post->post_type  . ' cf' ) ); ?>>
			<!-- Article Header -->
			<header class="article-title-wrap">
				<h1 class="article-title"><?php the_title(); ?></h1>
			</header>
			<!-- End Article Header -->

			<!-- Article Content -->
			<div class="article-content cf">
				<?php the_content(); ?>

				<div class="clear"></div>

				<?php
					$bulletins = new WP_Query(array(
						'post_type' => array('bulletin')
					));
					// The Loop
					if ($bulletins->have_posts()) {
						while ($bulletins->have_posts()) {
							$bulletins->the_post();
							the_title('<h4>', '</h4>');
							echo "<em>" . get_the_date() . "</em><br/>\n";
							echo "<a href='" . esc_html(get_post_meta(get_the_ID(), '_cmb2_bulletin_file', true)) . "'>View</a>\n";
						}
					} else {
						echo "<p>No Bulletins Found</p>\n";
					}
					wp_reset_postdata();
					wp_reset_query();
				?>

				<?php if ( $multipage ) : ?>
					<div class="article-navigation article-pagination wp-link-pages">
						<?php wp_link_pages(); ?>
					</div>

					<div class="clear"></div>
				<?php endif; ?>

				<?php edit_post_link( __( 'Edit Post', 'baton' ) ); // Allow logged in users to edit ?>

				<div class="clear"></div>
			</div>
			<!-- End Article Content -->

			<div class="clear"></div>
		</article>
		<!-- End Article -->

		<div class="clear"></div>
<?php
		endwhile;
	endif;
?>