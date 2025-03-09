<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 *
 * Image Author: Greg Rakozy
 **/

?>
<div class="custom-header">

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/header.jpg" alt="">
		</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
