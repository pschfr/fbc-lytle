<?php
/*
 * Template Name: Bulletins
 * This template is used for the display of single pages.
 */

// Bail if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

get_header(); ?>

			<!-- Main -->
			<main role="main" class="content-wrap content-wrap-page baton-flex <?php echo ( baton_is_yoast_breadcrumbs_active() ) ? 'has-breadcrumbs' : 'no-breadcrumbs'; ?>">
				<!-- Page Content -->
				<div class="baton-col baton-col-content">
					<section class="content-container content-page-container">
						<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

						<?php get_template_part( 'page-templates/loop', 'page-bulletins' ); // Loop - Bulletins Page ?>

						<!-- Comments -->
						<?php comments_template(); // Comments ?>
						<!-- End Comments -->

						<div class="clear"></div>
					</section>
				</div>
				<!-- End Page Content -->

				<!-- Sidebar -->
				<?php get_sidebar(); ?>
				<!-- End Sidebar -->

				<div class="clear"></div>
			</main>
			<!-- End Main -->

<?php get_footer(); ?>