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
		<?php
		$columnStyle = (get_field('number_columns')) ? get_field('number_columns') : 'two-columns';
		?>
		<main id="main" class="site-main <?php echo $columnStyle; ?>" role="main">

			<?php
			$args = array(
				'post_type'					=>		'comission',
				'order'							=> 		'DESC',
				'orderby'						=>		'date',
				'posts_per_page'			=>		-1
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
