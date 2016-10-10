<?php
/**
 * Template Name: Comissions
 * The template for displaying on Comissions list.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elisa_Murcia_Artengo
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php
			$args = array(
				'post_type'					=>		'comission',
				'order'							=> 		'DESC',
				'orderby'						=>		'date'
			);
			$loop = new WP_Query($args);
			while ( $loop->have_posts() ) : $loop->the_post();

				get_template_part( 'template-parts/thumb', 'publications' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
