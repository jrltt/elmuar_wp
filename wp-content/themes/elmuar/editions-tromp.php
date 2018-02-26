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
		<?php
		$columnStyle = (get_field('number_columns')) ? get_field('number_columns') : 'two-columns';
		?>
		<main id="main" class="site-main <?php echo $columnStyle; ?>" role="main">
			
			<?php

			while ( have_posts() ) : the_post();
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(array('type-edtromp__header')); ?>>
					<?php the_content(); ?>
				</article>
			<?php
			endwhile;
			
			wp_reset_postdata();

			$args = array(
				'post_type'					=>		'edtromp',
				'order'							=> 		'DESC',
				'orderby'						=>		'date',
				'posts_per_page'		=>		-1
			);
			$loop = new WP_Query($args);
			while ( $loop->have_posts() ) : $loop->the_post();

				get_template_part( 'template-parts/thumb', 'images' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
