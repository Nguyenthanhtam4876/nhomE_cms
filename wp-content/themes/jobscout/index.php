<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout
 */

 get_header(); ?>


 
 <?php
 $blog_heading = get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'jobscout' ) );
 ?>

  <div id="primary" class="content-area">
	  
	  <?php 
	  /**
	   * Before Posts hook
	  */
	  do_action( 'jobscout_before_posts_content' );
	  ?>
	<div class="image-container">
    <img src="../wp-content/themes/jobscout/images/banner_new.jpg" alt=""class="image-style">
    <div class="text-overlay">FDS NEWS</div>
  	</div>
	 
	
	  <main id="main" class="site-main index-main">
	  <?php 
			 if( $blog_heading ) echo '<h2 class="section-title index-title">' . esc_html( $blog_heading ) . '</h2>';
		 ?>
	  <div class="row">

	  <?php
	  if ( have_posts() ) :
		  while ( have_posts() ) : the_post();?>
 
		  <div class="col-md-6 blog-format">
			
			   
			   <?php
			  get_template_part( 'template-parts/content', get_post_format() );
			  ?>
			  </div>
			  <?php
			 endwhile;
	  else :
 
		  get_template_part( 'template-parts/content', 'none' );
 
	  endif; ?>
 </div>
	  </main><!-- #main -->
	  
	  <?php
	  /**
	   * After Posts hook
	   * @hooked jobscout_navigation - 15
	  */
	  do_action( 'jobscout_after_posts_content' );
	  ?>
	  
  </div><!-- #primary -->
 
 <?php
//  get_sidebar();
 get_footer();