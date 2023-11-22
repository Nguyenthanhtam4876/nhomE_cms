<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
        /**
         * 
         * @hooked jobscout_entry_header - 10
         * @hooked jobscout_post_thumbnail - 15
        */
        do_action( 'jobscout_before_page_entry_content' );
    
        /**
         * Entry Content
         * 
         * @hooked jobscout_entry_content - 15
         * @hooked jobscout_entry_footer  - 20
        */
        do_action( 'jobscout_page_entry_content' );    
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
