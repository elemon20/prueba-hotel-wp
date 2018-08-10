<?php
/**
 * Template Name: Full Width
 *
 * @package WordPress
 * @subpackage steed
 * @since 1.0
 */
?>
<?php get_header(); ?>
	<?php steed_site_header(); ?>
    	<?php 
			while ( have_posts() ) : the_post();
				
				the_content();
				
							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'steed' ),
								'after'  => '</div>',
							) );
							
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; // End of the loop.
		?>
	<?php steed_site_footer(); ?>
<?php get_footer(); ?>