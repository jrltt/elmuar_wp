<?php
/**
 * Template part for displaying thumbs on template publication.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elisa_Murcia_Artengo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry--header__img-wrapper">
			<?php 
			if ( has_post_gallery() ) {
				build_gallery('full');
			} else if ( has_post_thumbnail() ) {
				the_post_thumbnail('full', array('class' => 'img-responsive'));
			} else {
				echo_first_image($post->ID);
			} ?>
		</div>
	</header><!-- .entry-header -->
	<div class="entry--content">
		<div class="entry--content__text">
			<?php the_title( '<h1 class="entry-title entry--content__title">', '</h1>' ); ?>
		</div>
		<div class="entry--content__custom">
			<?php echo get_field('custom_content', $post->ID); ?>
		</div>
		<div class="entry--content__meta">
			<?php echo build_category_year(); ?>
		</div>
	</div>
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'elmuar' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
