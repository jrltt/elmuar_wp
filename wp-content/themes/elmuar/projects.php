<?php
/**
 * Template Name: Projects
 * The template for displaying only project list.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elisa_Murcia_Artengo
 */

get_header(); ?>

	<div id="primary" class="content-area ">
		<!-- zoomViewport -->
		<main id="main" class="site-main projects  zoomContainer" role="main">

			<?php
			$args = array(
				'post_type'				=>		'project',
				'order'					=> 		'DESC',
				'orderby'				=>		'date',
				'posts_per_page'		=>		-1
			);
			$loop = new WP_Query($args);
			while ( $loop->have_posts() ) : $loop->the_post();

				get_template_part( 'template-parts/content', 'projects' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
