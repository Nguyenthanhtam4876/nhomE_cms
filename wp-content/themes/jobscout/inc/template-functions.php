<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<?php
/**
 * JobScout Template Functions which enhance the theme by hooking into WordPress
 *
 * @package JobScout
 */

if( ! function_exists( 'jobscout_doctype' ) ) :
/**
 * Doctype Declaration
*/
function jobscout_doctype(){ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
}
endif;
add_action( 'jobscout_doctype', 'jobscout_doctype' );

if( ! function_exists( 'jobscout_head' ) ) :
/**
 * Before wp_head 
*/
function jobscout_head(){ ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php
}
endif;
add_action( 'jobscout_before_wp_head', 'jobscout_head' );

if( ! function_exists( 'jobscout_responsive_header' ) ) :
/**
 * Responsive Header
*/
function jobscout_responsive_header(){ 
    $post_job_label  = get_theme_mod( 'post_job_label', __( 'Post Jobs', 'jobscout' ) );
    $post_job_url    = get_theme_mod( 'post_job_url', '#' );
    ?>
<div class="responsive-nav">
    <div class="nav-top">
        <?php jobscout_site_branding( true ); ?>
    </div>


    <nav id="mobile-site-navigation" class="main-navigation mobile-navigation">
        <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal"
                data-toggle-body-class="showing-main-menu-modal" aria-expanded="false"
                data-set-focus=".main-menu-modal"></button>
            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'jobscout' ); ?>">
                <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'mobile-primary-menu',
                            'menu_class'     => 'nav-menu main-menu-modal',
                            'container'      => false,
                            'fallback_cb'    => 'jobscout_primary_menu_fallback',
                        ) );

                        wp_nav_menu( array(
                            'theme_location' => 'secondary',
                            'menu_class'     => 'nav-menu',
                            'menu_id'        => 'secondary-menu',
                            'container'      => false,
                            'fallback_cb'    => 'jobscout_secondary_menu_fallback',
                        ) );
                    ?>

                <?php if( $post_job_label || $post_job_url ){ ?>
                <div class="btn-wrap">
                    <a class="btn"
                        href="<?php echo esc_url( $post_job_url ) ?>"><?php echo esc_html( $post_job_label ) ?></a>
                </div>
                <?php } ?>
            </div>
        </div>
    </nav><!-- #mobile-site-navigation -->
</div> <!-- .responsive-nav -->
<?php
}
endif;
add_action( 'jobscout_before_header', 'jobscout_responsive_header', 15 );

if( ! function_exists( 'jobscout_page_start' ) ) :
/**
 * Page Start
*/
function jobscout_page_start(){ ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text"
        href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'jobscout' ); ?></a>
    <?php
}
endif;
add_action( 'jobscout_before_header', 'jobscout_page_start', 20 );

if( ! function_exists( 'jobscout_header' ) ) :
/**
 * Header Start
*/
function jobscout_header(){ 
    ?>
    <header id="masthead" class="site-header header-one" itemscope itemtype="https://schema.org/WPHeader">
        <?php if( has_nav_menu( 'secondary' ) || current_user_can( 'manage_options' ) ) jobscout_secondary_navigation(); ?>
        <div class="header-main">
            <div class="container">
                <?php 
                    jobscout_site_branding( false );
                    echo '<div class="menu-wrap">';
                    jobscout_primary_nagivation();
                    echo '</div><!-- .menu-wrap -->';
                ?>
            </div>
        </div> <!-- .header-main -->
    </header> <!-- .site-header -->
    <?php
}
endif;
add_action( 'jobscout_header', 'jobscout_header', 20 );

if( ! function_exists( 'jobscout_breadcrumbs_bar' ) ) :
    /**
     * Breadcrumbs
    */
    function jobscout_breadcrumbs_bar(){
        $ed_breadcrumbs = get_theme_mod( 'ed_breadcrumbs', false );

        if( $ed_breadcrumbs && ! is_front_page() && ! is_404() ){ ?>
    <section class="breadcrumb-wrap">
        <div class="container">
            <?php jobscout_breadcrumbs_cb(); //Breadcrumb ?>
        </div>
    </section>
    <?php 
        }    
    }
endif;
add_action( 'jobscout_after_header', 'jobscout_breadcrumbs_bar', 30 );

if( ! function_exists( 'jobscout_content_start' ) ) :
/**
 * Content Start
 *  
*/
function jobscout_content_start(){       
    echo '<div id="acc-content"><!-- .site-header -->';
    $home_sections = jobscout_get_home_sections(); 
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ //Make necessary adjust for pg template.
        echo is_404() ? '<div class="error-holder">' : '<div id="content" class="site-content">'; 

        if( is_archive() || is_search() || is_page_template( 'templates/portfolio.php' ) ) : ?>
    <header class="page-header">
        <?php
                    if( is_archive() ){ 
                        if( is_author() ) { 
                            $author_title = get_the_author(); ?>
        <div class="author-bio">
            <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></figure>
            <div class="author-content">
                <?php 
                                        echo '<span class="sub-title">' . esc_html__( 'All Posts by', 'jobscout' ) . '</span>';
                                        if( $author_title ) echo '<h1 class="author-title">' . esc_html( $author_title ) . '</h3>';
                                    ?>
            </div>
        </div>
        <?php }else{
                            the_archive_title( '<h1 class="page-title">', '</h1>' );
                            the_archive_description( '<div class="archive-description">', '</div>' );             
                        }
                    }
                    
                    if( is_search() ){ 
                        echo '<div class="container">';
                            echo '<h1 class="page-title">' . esc_html__( 'Search', 'jobscout' ) . '</h1>';
                            get_search_form();
                        echo '</div><!-- .container -->';
                    }

                    if( ! is_author() && ! is_search() ){
                        jobscout_posts_per_page_count();
                    }

                    if( is_page_template( 'templates/portfolio.php' ) ){
                        global $post;
                        echo '<div class="container">';
                            echo '<h1 class="page-title">' . esc_html( get_the_title( $post->ID ), 'jobscout' ) . '</h1>';
                            if( $post->post_content ) echo wpautop( wp_kses_post( $post->post_content ) );
                        echo '</div><!-- .container -->';
                    }
                ?>
    </header>
    <?php endif; 
            if( is_singular( 'job_listing' ) ){
                global $post;
                $banner_image   = get_header_image();
                $show_banner    = get_theme_mod( 'ed_job_banner', true );

                if( $banner_image && $show_banner ){
                    $banner_style = 'background-image: url(' . esc_url( $banner_image ) . '); background-size: cover;';
                    echo '<header class="entry-header" style="'. esc_attr( $banner_style ) .'"></header>';
                }
            } 
        ?>
<<<<<<< HEAD
    <div class="container">
=======
        <div class="container-fluid">
>>>>>>> Lam
        <?php 
    }
}
endif;
add_action( 'jobscout_content', 'jobscout_content_start' );

if ( ! function_exists( 'jobscout_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function jobscout_post_thumbnail() {
    $image_size  = 'thumbnail';
    $ed_featured = get_theme_mod( 'ed_featured_image', true );
    $sidebar     = jobscout_sidebar_layout();
    
    if( is_home() || is_archive() || is_search() ){        
        $image_size = 'jobscout-blog';    
        if( has_post_thumbnail() ){                        
            echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
            echo '</a></figure>';
        }else{
            echo '<figure class="post-thumbnail">';
                jobscout_fallback_svg_image( $image_size );  
            echo '</figure>';  
        }        
    }elseif( is_singular() ){
        $image_size = ( $sidebar ) ? 'jobscout-single' : 'jobscout-single-fullwidth';
        if( is_single() ){
            if( $ed_featured && has_post_thumbnail() ){
                echo '<figure class="post-thumbnail">';
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                echo '</figure>';
            }
        }else{
            echo '<figure class="post-thumbnail">';
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
            echo '</figure>';
        }
    }
}
endif;
add_action( 'jobscout_before_post_entry_content', 'jobscout_post_thumbnail', 15 );
add_action( 'jobscout_before_page_entry_content', 'jobscout_post_thumbnail', 15 );
add_action( 'jobscout_before_single_post_entry_content', 'jobscout_post_thumbnail', 15 );

if( ! function_exists( 'jobscout_entry_header' ) ) :
/**
 * Entry Header
*/
function jobscout_entry_header(){ ?>
        <header class="entry-header">
            <?php 
            $ed_cat_single = get_theme_mod( 'ed_category', false );
            $hide_author   = get_theme_mod( 'ed_post_author', false );
            $hide_date     = get_theme_mod( 'ed_post_date', false );


            if ( is_singular() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;        
        ?>
        </header>
        <?php    
}
endif;
add_action( 'jobscout_post_entry_content', 'jobscout_entry_header', 10 );
add_action( 'jobscout_before_page_entry_content', 'jobscout_entry_header', 10 );
add_action( 'jobscout_before_single_post_entry_content', 'jobscout_entry_header', 10 );

if( ! function_exists( 'jobscout_entry_content' ) ) :
/**
 * Entry Content
*/
function jobscout_entry_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true ); ?>
    <div class="entry-content row" itemprop="text">
		<?php
			if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                the_content();    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jobscout' ),
    				'after'  => '</div>',
    			) );
            }else{
                the_excerpt();
            }
		?>
        </div><!-- .entry-content -->
        <?php
}
endif;
add_action( 'jobscout_post_entry_content', 'jobscout_entry_content', 15 );
add_action( 'jobscout_page_entry_content', 'jobscout_entry_content', 15 );
add_action( 'jobscout_single_post_entry_content', 'jobscout_entry_content', 15 );
add_action( 'jobscout_single_post_entry_content', 'jobscout_entry_content', 15 );
add_action( 'jobscout_before_single_job_content', 'jobscout_entry_content', 15 );

if( ! function_exists( 'jobscout_entry_footer' ) ) :
/**
 * Entry Footer
*/
function jobscout_entry_footer(){ 
    $readmore = get_theme_mod( 'read_more_text', __( 'Read More', 'jobscout' ) );
    $ed_post_date   = get_theme_mod( 'ed_post_date', false ); ?>
        <footer class="entry-footer">
            <?php
			if( is_single() ){
			    jobscout_tag();
			}
            
            if( is_front_page() || is_home() || is_search() || is_archive() ){
                echo '<a href="' . esc_url( get_the_permalink() ) . '" class="readmore-link"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.207 8.58"><defs><style>.c{fill:none;stroke:#2ace5e;}</style></defs><g transform="translate(-701.5 -958.173)"><path class="c" d="M-9326.909-9204.917l-3.937,3.937,3.937,3.937" transform="translate(-8613.846 -8238.518) rotate(180)"/><line class="c" x2="15.154" transform="translate(701.5 962.426)"/></g></svg>' . esc_html( $readmore ) . '</a>';    
            }

            if( is_single() ) echo '<div class="entry-footer-right">';
            if( 'post' === get_post_type() && is_single() ){
                if( ! $ed_post_date ) jobscout_posted_on( true );
                jobscout_comment_count();
            }
            
        
            if( is_single() ) echo '</div>';
		?>
        </footer><!-- .entry-footer -->
        <?php 
}
endif;
add_action( 'jobscout_post_entry_content', 'jobscout_entry_footer', 20 );
add_action( 'jobscout_page_entry_content', 'jobscout_entry_footer', 20 );
add_action( 'jobscout_single_post_entry_content', 'jobscout_entry_footer', 20 );

if( ! function_exists( 'jobscout_get_single_job_title' ) ) :
/**
 * Before wp_head 
*/
function jobscout_get_single_job_title(){ 
    ?>
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php
            if ( get_option( 'job_manager_enable_types' ) ) { 
                echo '<div class="job-type">';
                    $types = wpjm_get_the_job_types(); 
                    if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
            <span
                class="btn <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></span>
            <?php endforeach; endif;
                echo '</div>';
            } 
        ?>
        </header>
        <?php
}
endif;
add_action( 'jobscout_before_single_job_content', 'jobscout_get_single_job_title' );

if( ! function_exists( 'jobscout_navigation' ) ) :
/**
 * Navigation
*/
function jobscout_navigation(){
    if( is_single() ){
        $previous = get_previous_post_link(
    		'<div class="nav-previous nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Previous Article', 'jobscout' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
    
    	$next = get_next_post_link(
    		'<div class="nav-next nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Next Article', 'jobscout' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	); 
        
        if( $previous || $next ){?>
        <nav class="navigation post-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'jobscout' ); ?></h2>
            <div class="nav-links">
                <?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
            </div>
        </nav>
        <?php
        }
    }else{
        the_posts_navigation();
    }
}
endif;
add_action( 'jobscout_after_post_content', 'jobscout_navigation', 10 );
add_action( 'jobscout_after_posts_content', 'jobscout_navigation' );

if( ! function_exists( 'jobscout_author' ) ) :
/**
 * Author Section
*/
function jobscout_author(){ 
    $ed_author    = get_theme_mod( 'ed_author', false );
    $author_title = get_theme_mod( 'author_title', __( 'About Author', 'jobscout' ) );
    if( ! $ed_author && get_the_author_meta( 'description' ) ){ ?>
        <div class="author-bio">
            <?php if( $author_title ) echo '<h3 class="title">' . esc_html( $author_title ) . '</h3>'; ?>
            <div class="author-bio-inner">
                <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></figure>
                <div class="author-content">
                    <?php echo '<div class="author-info">' . wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ) . '</div>';
                ?>
                </div>
            </div>
        </div>
        <?php
    }
}
endif;
add_action( 'jobscout_after_post_content', 'jobscout_author', 20 );

if( ! function_exists( 'jobscout_comment' ) ) :
/**
 * Comments Template 
*/
function jobscout_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if( get_theme_mod( 'ed_comments', true ) && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
}
endif;
add_action( 'jobscout_after_post_content', 'jobscout_comment', 30 );
add_action( 'jobscout_after_page_content', 'jobscout_comment' );

if( ! function_exists( 'jobscout_content_end' ) ) :
/**
 * Content End
*/
function jobscout_content_end(){ 
    $home_sections = jobscout_get_home_sections(); 
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ ?>
    </div><!-- .container/ -->
</div><!-- .error-holder/site-content -->
<?php
    }
}
endif;
add_action( 'jobscout_before_footer', 'jobscout_content_end', 20 );

if( ! function_exists( 'jobscout_footer_start' ) ) :
/**
 * Footer Start
*/
function jobscout_footer_start(){
    ?>
<footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'jobscout_footer', 'jobscout_footer_start', 20 );

if( ! function_exists( 'jobscout_footer_top' ) ) :
/**
 * Footer Top
*/
function jobscout_footer_top(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
    <div class="footer-t" style="padding-top: 0px;">
        <section id="block-7" class="widget widget_block">
            <div class="wp-block-contact-form-7-contact-form-selector">
                <div class="wpcf7 no-js" id="wpcf7-f972-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    <form action="/cms_nhome/#wpcf7-f972-o1" method="post" class="wpcf7-form init"
                        aria-label="Contact form" novalidate="novalidate" data-status="init">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="972" />
                            <input type="hidden" name="_wpcf7_version" value="5.8.3" />
                            <input type="hidden" name="_wpcf7_locale" value="en_US" />
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f972-o1" />
                            <input type="hidden" name="_wpcf7_container_post" value="0" />
                            <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                        </div>
                        <div class="container-fluid"
                            style="height: 100px; background-color:#ff6200; text-align: center; justify-content: center;">
                            <div class="row" style="
                          display: flex;
                          justify-content: center;
                        ">
                                <div class="col-md-2">
                                    <p>
                                    <h4 style="    
                                              margin-top: 10%;
                                                margin-left: 10%;
                                                text-align: left;
                                                color: white;">
                                        Subscribe To <br>
                                        Out Newsletter
                                    </h4>
                                    </p>
                                </div>
                                <div class="col-md-6" style=" text-align: start;">
                                    <div class="contact-input" style="padding-top: 25px; position: relative;">
                                        <p>
                                            <ul style="
                                                top: 25;
                                                position: absolute;
                                                display: flex;
                                            ">
                                                <li style="
                                                        height: 50;
                                                        display: flex;
                                                        background: white;
                                                ">
                                                
                                            <span class="icon" style="
                                        
                                        border: solid 1px white;
                                        padding-left: 12;
                                        padding-top: 12;
                                        top: 48;
                                        padding-bottom: 11;
                                    ">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                    viewBox="0 0 512 512">
                                                    <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <style>
                                                    svg {
                                                        fill: #ff6200
                                                    }
                                                    </style>
                                                    <path
                                                        d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z" />
                                                </svg>
                                            </span>
                                            <span class="wpcf7-form-control-wrap" data-name="email-324">
                                                <input size="40"
                                                    class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email contact-email"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Input your email address" value="" type="email"
                                                    name="email-324" style="
                                                border: solid 1px white;
                                                border-radius: 0;
                                                padding: 11;
                                                margin-left: 0;
                                                width: 410;
                        
                                                " />
                                            </span>
                                                </li>
                                                <li>
                                                <input class="wpcf7-form-control wpcf7-submit has-spinner contact-sub"
                                                type="submit" value="SUBCRIBE" style="
                                                    border: solid 1px white;
                                                    border-radius: 0;
                                                    margin-left: 10;
                                                    color: white;
                                                    font-size: 20;
                                                    background: #ff6200;
                                                    padding-left: 23px;
                                                    padding-top: 9px;
                                                    padding-right: 23px;
                                                    padding-bottom: 10px;
                                        " />
                                                </li>
                                            </ul>
                                         

                                        </p>
                                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                                    </div>
                                </div>
                            </div>



                        </div>
        <div class="footer-b" style="background-color: #F2F2F2; ">
    		<div class="container">
            <h3>
            <a href=" <?php echo esc_url( home_url( '/' ) ) ?> " style="color:black;  display: flex;justify-content: center; padding-bottom:10px"> <?php  echo esc_html( get_bloginfo( 'name' ) ) ?>  </a></h3>
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
                    <div class="col editFooter-t">

    				   <b><?php dynamic_sidebar( $active ); ?>	</b>
                    </div>

                    <div class="icon-footer-t" style="text-align: center; margin-top: -70px;padding-bottom:50px">
                        <a href="">
                            <?xml version="1.0" ?><svg id="Layer_1" style="enable-background:new 0 0 1000 1000; width:40px;height:30px;padding-right:10px" version="1.1" viewBox="0 0 1000 1000" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
                                .st0{fill:#3B579D;}
                                .st1{fill:#FFFFFF;}
                            </style><title/><g><path class="st0" d="M500,1000L500,1000C223.9,1000,0,776.1,0,500v0C0,223.9,223.9,0,500,0h0c276.1,0,500,223.9,500,500v0   C1000,776.1,776.1,1000,500,1000z"/><path class="st1" d="M630,1000V612.7h130l19.5-150.9H630v-96.4c0-43.7,12.1-73.5,74.8-73.5l79.9,0V157   c-13.8-1.8-61.3-5.9-116.5-5.9c-115.2,0-194.1,70.3-194.1,199.5v111.3H343.8v150.9h130.3V1000H630z" id="f"/></g></svg> 
                         </a>
                         <a href="">
                            <?xml version="1.0" ?><svg style="width:40px;height:30px;padding-right:10px" enable-background="new 0 0 24 24" id="Layer_1" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M12,5c1.6167603,0,3.1012573,0.5535278,4.2863159,1.4740601l3.637146-3.4699707   C17.8087769,1.1399536,15.0406494,0,12,0C7.392395,0,3.3966675,2.5999146,1.3858032,6.4098511l4.0444336,3.1929321   C6.4099731,6.9193726,8.977478,5,12,5z" fill="#F44336"/><path d="M23.8960571,13.5018311C23.9585571,13.0101929,24,12.508667,24,12   c0-0.8578491-0.093689-1.6931763-0.2647705-2.5H12v5h6.4862061c-0.5247192,1.3637695-1.4589844,2.5177612-2.6481934,3.319458   l4.0594482,3.204834C22.0493774,19.135437,23.5219727,16.4903564,23.8960571,13.5018311z" fill="#2196F3"/><path d="M5,12c0-0.8434448,0.1568604-1.6483765,0.4302368-2.3972168L1.3858032,6.4098511   C0.5043335,8.0800171,0,9.9801636,0,12c0,1.9972534,0.4950562,3.8763428,1.3582153,5.532959l4.0495605-3.1970215   C5.1484375,13.6044312,5,12.8204346,5,12z" fill="#FFC107"/><path d="M12,19c-3.0455322,0-5.6295776-1.9484863-6.5922241-4.6640625L1.3582153,17.532959   C3.3592529,21.3734741,7.369812,24,12,24c3.027771,0,5.7887573-1.1248169,7.8974609-2.975708l-4.0594482-3.204834   C14.7412109,18.5588989,13.4284058,19,12,19z" fill="#00B060"/><path d="M12,23.75c-3.5316772,0-6.7072754-1.4571533-8.9524536-3.7786865C5.2453613,22.4378052,8.4364624,24,12,24   c3.5305786,0,6.6952515-1.5313721,8.8881226-3.9592285C18.6495972,22.324646,15.4981079,23.75,12,23.75z" opacity="0.1"/><polygon opacity="0.1" points="12,14.25 12,14.5 18.4862061,14.5 18.587492,14.25  "/><path d="M23.9944458,12.1470337C23.9952393,12.0977783,24,12.0493774,24,12   c0-0.0139771-0.0021973-0.0274658-0.0022583-0.0414429C23.9970703,12.0215454,23.9938965,12.0838013,23.9944458,12.1470337z" fill="#E6E6E6"/><path d="M12,9.5v0.25h11.7855721c-0.0157471-0.0825195-0.0329475-0.1680908-0.0503426-0.25H12z" fill="#FFFFFF" opacity="0.2"/><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_1_" x1="0" x2="24" y1="12" y2="12"><stop offset="0" style="stop-color:#FFFFFF;stop-opacity:0.2"/><stop offset="1" style="stop-color:#FFFFFF;stop-opacity:0"/></linearGradient><path d="M23.7352295,9.5H12v5h6.4862061C17.4775391,17.121582,14.9771729,19,12,19   c-3.8659668,0-7-3.1340332-7-7c0-3.8660278,3.1340332-7,7-7c1.4018555,0,2.6939087,0.4306641,3.7885132,1.140686   c0.1675415,0.1088867,0.3403931,0.2111206,0.4978027,0.333374l3.637146-3.4699707L19.8414307,2.940979   C17.7369385,1.1170654,15.00354,0,12,0C5.3725586,0,0,5.3725586,0,12c0,6.6273804,5.3725586,12,12,12   c6.1176758,0,11.1554565-4.5812378,11.8960571-10.4981689C23.9585571,13.0101929,24,12.508667,24,12   C24,11.1421509,23.906311,10.3068237,23.7352295,9.5z" fill="url(#SVGID_1_)"/><path d="M15.7885132,5.890686C14.6939087,5.1806641,13.4018555,4.75,12,4.75c-3.8659668,0-7,3.1339722-7,7   c0,0.0421753,0.0005674,0.0751343,0.0012999,0.1171875C5.0687437,8.0595093,8.1762085,5,12,5   c1.4018555,0,2.6939087,0.4306641,3.7885132,1.140686c0.1675415,0.1088867,0.3403931,0.2111206,0.4978027,0.333374   l3.637146-3.4699707l-3.637146,3.2199707C16.1289062,6.1018066,15.9560547,5.9995728,15.7885132,5.890686z" opacity="0.1"/><path d="M12,0.25c2.9750366,0,5.6829224,1.0983887,7.7792969,2.8916016l0.144165-0.1375122   l-0.110014-0.0958166C17.7089558,1.0843592,15.00354,0,12,0C5.3725586,0,0,5.3725586,0,12   c0,0.0421753,0.0058594,0.0828857,0.0062866,0.125C0.0740356,5.5558472,5.4147339,0.25,12,0.25z" fill="#FFFFFF" opacity="0.2"/></g><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/></svg>
                         </a>
                         <a href="">
                         <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg height="512px" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision;width:40px;height:30px;padding-right:10px; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xodm="http://www.corel.com/coreldraw/odm/2003"><defs><style type="text/css">
                                <![CDATA[
                                    .fil1 {fill:white;fill-rule:nonzero}
                                    .fil0 {fill:url(#id0)}
                                ]]>
                                </style><linearGradient gradientUnits="userSpaceOnUse" id="id0" x1="67.83" x2="474.19" y1="82.42" y2="389.98"><stop offset="0" style="stop-opacity:1; stop-color:#3ACD01"/><stop offset="1" style="stop-opacity:1; stop-color:#4BE010"/></linearGradient></defs><g id="Layer_x0020_1"><g id="_1725966223216"><path class="fil0" d="M256 0c141.39,0 256,114.61 256,256 0,141.39 -114.61,256 -256,256 -141.39,0 -256,-114.61 -256,-256 0,-141.39 114.61,-256 256,-256z"/><path class="fil1" d="M256 119.53c80.56,0 145.87,52.29 145.87,116.8 0,77.65 -144.76,164.26 -155.92,155.53 -9.6,-7.5 16.67,-35.95 -15.57,-40.53 -58.67,-8.38 -120.25,-50.14 -120.25,-115 0,-64.51 65.31,-116.8 145.87,-116.8zm-84 154.05l28.79 0c4.18,0 7.6,-3.42 7.6,-7.6 0,-4.51 -2.87,-8.25 -7.6,-8.25l-21.18 0 0 -48.18c0,-4.18 -3.42,-7.6 -7.61,-7.6 -4.51,0 -8.24,2.87 -8.24,7.6l0 56.43c0,4.72 3.73,7.6 8.24,7.6zm181.66 -35.36c0,-4.51 -2.87,-8.24 -7.61,-8.24l-21.17 0 0 -12.05 21.17 0c4.19,0 7.61,-3.42 7.61,-7.61 0,-4.51 -2.88,-8.24 -7.61,-8.24l-28.78 0c-4.51,0 -8.24,2.88 -8.24,7.61l0 56.42c0,4.19 3.42,7.61 7.61,7.61l29.41 0c4.19,0 7.61,-3.42 7.61,-7.61 0,-4.51 -2.87,-8.24 -7.61,-8.24l-21.17 0 0 -12.04 21.17 0c4.19,0 7.61,-3.43 7.61,-7.61zm-54.37 27.76l0 -56.42c0,-4.19 -3.42,-7.61 -7.61,-7.61 -4.51,0 -8.24,2.87 -8.24,7.61l0 33.12 -27.5 -36.89c-1.31,-2.29 -3.79,-3.84 -6.6,-3.84 -4.51,0 -8.25,2.87 -8.25,7.61l0 56.42c0,4.73 3.73,7.61 8.25,7.61 4.18,0 7.6,-3.43 7.6,-7.61l0 -33.74 27.7 37.82c1.45,2.25 3.66,3.52 6.4,3.52 4.53,0 8.25,-2.84 8.25,-7.6zm-76.51 7.6c4.18,0 7.6,-3.42 7.6,-7.6l0 -56.42c0,-4.19 -3.42,-7.61 -7.6,-7.61 -4.51,0 -8.25,2.87 -8.25,7.61l0 56.42c0,4.73 3.74,7.6 8.25,7.6z"/></g></g></svg>
                         </a>
                         <a href="">
                         <?xml version="1.0" ?><svg id="Layer_1" style="enable-background:new 0 0 1000 1000;width:40px;padding-right:10px" version="1.1" viewBox="0 0 1000 1000" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
                            .st0{fill:#1DA1F2;}
                            .st1{fill:#FFFFFF;}
                            .st2{fill:none;}
                            </style><title/><g><g id="Dark_Blue"><path class="st0" d="M500,0L500,0c276.1,0,500,223.9,500,500v0c0,276.1-223.9,500-500,500h0C223.9,1000,0,776.1,0,500v0    C0,223.9,223.9,0,500,0z"/></g><g id="Logo_FIXED"><path class="st1" d="M384,754c235.8,0,364.9-195.4,364.9-364.9c0-5.5,0-11.1-0.4-16.6c25.1-18.2,46.8-40.6,64-66.4    c-23.4,10.4-48.2,17.2-73.6,20.2c26.8-16,46.8-41.2,56.4-70.9c-25.2,14.9-52.7,25.5-81.4,31.1c-48.6-51.6-129.8-54.1-181.4-5.6    c-33.3,31.3-47.4,78-37.1,122.5c-103.1-5.2-199.2-53.9-264.3-134c-34,58.6-16.7,133.5,39.7,171.2c-20.4-0.6-40.4-6.1-58.2-16    c0,0.5,0,1.1,0,1.6c0,61,43,113.6,102.9,125.7c-18.9,5.1-38.7,5.9-57.9,2.2c16.8,52.2,64.9,88,119.8,89.1    c-45.4,35.7-101.5,55.1-159.2,55c-10.2,0-20.4-0.6-30.5-1.9C246.1,734,314.4,754,384,753.9"/><path class="st2" d="M500,0L500,0c276.1,0,500,223.9,500,500v0c0,276.1-223.9,500-500,500h0C223.9,1000,0,776.1,0,500v0    C0,223.9,223.9,0,500,0z"/></g></g></svg>
                         </a>

                    </div>

                    </div>
                <?php } ?>
                </div>
                </form>
            </div>
        </section>
    </div>
    <?php 
    }
}
endif;
add_action( 'jobscout_footer', 'jobscout_footer_top', 30 );

if( ! function_exists( 'jobscout_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function jobscout_footer_bottom(){ ?>
    <div class="footer-b">
        <div class="container">
            <?php 
                if ( function_exists( 'the_privacy_policy_link' )  )  the_privacy_policy_link( '<div class="privacy-block">', '</div>' );
            ?>
            <div class="copyright">
                <?php
                jobscout_get_footer_copyright();
                jobscout_ed_author_link();
                jobscout_ed_wp_link();
            ?>              
            </div>
        </div>
    </div>
    <?php
}
endif;
add_action( 'jobscout_footer', 'jobscout_footer_bottom', 40 );

if( ! function_exists( 'jobscout_footer_end' ) ) :
/**
 * Footer End 
*/
function jobscout_footer_end(){ ?>
</footer><!-- #colophon -->
<?php
}
endif;
add_action( 'jobscout_footer', 'jobscout_footer_end', 50 );

if( ! function_exists( 'jobscout_page_end' ) ) :
/**
 * Page End
*/
function jobscout_page_end(){ ?>
</div><!-- #acc-content -->
</div><!-- #page -->
<?php
}
endif;
add_action( 'jobscout_after_footer', 'jobscout_page_end', 20 );
