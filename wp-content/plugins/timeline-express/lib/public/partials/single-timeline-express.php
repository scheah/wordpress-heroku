<?php
/**
 * The template for displaying all single announcements via Timeline Express
 *
 * To customize this template, copy it into a directory 'timeline-express' in your theme root
 * For full instructions, see https://www.wp-timelineexpress.com
 *
 * @package Timeline Express
 * @since Twenty Sixteen 1.2.5
 */

get_header(); ?>

<div id="primary" class="content-area timeline-express-content-area">
	<main id="main" class="site-main timeline-express-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
			<?php
				// Include the single post content template.
				get_timeline_express_template( 'single-announcement' );
			?>
			</div>

		<?php
		// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
