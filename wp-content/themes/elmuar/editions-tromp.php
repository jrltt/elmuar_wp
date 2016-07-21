<?php
/**
 * Template Name: Editions TROMPELOeIL
 * The template for displaying publicaitons only for Editions TROMPELOeIL.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elisa_Murcia_Artengo
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php
			$category = get_term_by('slug', 'editions-trompeloeil', 'category');
			$args = array(
				'post_type'					=>		'publication',
				'order'							=> 		'DESC',
				'orderby'						=>		'date',
				'category__in'			=>		$category->term_id
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