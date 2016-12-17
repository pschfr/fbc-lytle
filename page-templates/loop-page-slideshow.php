<?php
	// Bail if accessed directly
	if ( ! defined( 'ABSPATH' ) )
		exit;

	global $multipage, $post;

	// Loop through posts
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();

		echo do_shortcode("[metaslider id=126]");
		?>
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