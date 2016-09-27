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
		<a class="entry--header__link" href="<?php echo get_permalink(); ?>">
			<div class="entry--header__img-wrapper">
				<?php if( has_post_thumbnail() ) {
					the_post_thumbnail('pub-index');
				} ?>
			</div>
			<?php the_title( '<h1 class="entry-title entry--header__title">', '</h1>' ); ?>
			<div class="entry--header__meta">
				<?php echo build_category_year(); ?>
			</div>
		</a>
	</header><!-- .entry-header -->

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
