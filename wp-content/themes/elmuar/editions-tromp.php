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
		<div class="site-main two-columns custom-content__edtromp">
			<?php if (get_field('column_one', $post->ID)) { ?>
				<article class="image__type--gallery edtromp type-edtromp hentry custom-content__edtromp--image">
					<?php
						 if ( has_post_gallery() ) {
							build_gallery('full', $post->post_content, true);
						} else if ( has_post_thumbnail() ) {
							the_post_thumbnail('full', array('class' => 'img-responsive'));
						} else {
							echo_first_image($post->ID);
						} 
					?>
				</article>
			<?php } ?>
			<?php if (get_field('column_two', $post->ID)) { ?>
				<article class="image__type--gallery edtromp type-edtromp hentry custom-content__edtromp--text">
					<?php echo get_field('column_two', $post->ID); ?>
				</article>
			<?php } ?>
		</div>
		<?php $columnStyle = (get_field('number_columns')) ? get_field('number_columns') : 'two-columns'; ?>
		<main id="main" class="site-main <?php echo $columnStyle; ?>" role="main">
			<?php
			$args = array(
				'post_type' => 'edtromp',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => -1
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
