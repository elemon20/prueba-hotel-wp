<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Steed
 */
?>
<?php get_header(); ?>
	<?php steed_site_header(); ?>
    <?php steed_before_site_content(array('in_class' => 'container-width')); ?>

		<?php steed_before_primary_content(); ?>
        
			<?php do_action('steed_content_404'); ?>

		<?php steed_after_primary_content(); ?>

		<?php get_sidebar(); ?>
        
	<?php steed_after_site_content(); ?>
	<?php steed_site_footer(); ?>
<?php get_footer(); ?>