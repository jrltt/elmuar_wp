<?php
/**
 * Template Name: Infomation
 * The template for displaying information page with child items.
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
					'parent' 				=> get_the_ID(),
					'post_type' 		=> 'page',
					'post_status' 	=> 'publish'
				); 
				$pages = get_pages($args);
				foreach ($pages as  $key => $value) {
					$image = get_the_post_thumbnail($value->ID);
					$image = (strlen($image) <= 0) ? defaultImages() : $image; ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<a href="<?php echo get_the_permalink($value->ID); ?>">
								<div class="entry--header__img-wrapper"><?php print_r($image); ?></div>
								<h1 class="entry-title entry--header__title"><?php echo $value->post_title;?></h1>
							</a>
						</header>
					</article>
					<?php
				}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
