<?php
/**
 * Template Name: One column
 * Custom template for pages with one page
 * 
 * @package Elisa_Murcia_Artengo
 */
if (is_page('Contacto') || is_page('Contact')) {
	if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
		wpcf7_enqueue_scripts();
	}

	if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
		wpcf7_enqueue_styles();
	}
}
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main one-column" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
