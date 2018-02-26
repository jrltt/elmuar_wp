<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Elisa_Murcia_Artengo
 */

get_header(); ?>

	<div id="primary" class="content-area">
	<h2>hola</h2>
		<main id="main" class="site-main one-column" role="main">
		<?php

		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'images' );
			
			if (!in_category('Editions TROMPELOeIL')) :
				$argsPostNav = array (
					'excluded_terms' => getEdTromCatId()
				);
			else:
				$argsPostNav = array (
					'in_same_term' 	=> 		true,
					'taxonomy' 			=>		'category'
				);
			endif;
			
			the_post_navigation($argsPostNav);


		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
