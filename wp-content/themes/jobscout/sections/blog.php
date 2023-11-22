<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<style>
    .img {
      width: 220;
      height: 220px;
    }
</style>
<?php
/**
 * Blog Section
 * 
 * @package JobScout
 */

$blog_heading = get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'jobscout' ) );
$sub_title    = get_theme_mod( 'blog_section_subtitle', __( 'We will help you find it. We are your first step to becoming everything you want to be.', 'jobscout' ) );
$blog         = get_option( 'page_for_posts' );
$label        = get_theme_mod( 'blog_view_all', __( 'See More Posts', 'jobscout' ) );
$hide_author  = get_theme_mod( 'ed_post_author', false );
$hide_date    = get_theme_mod( 'ed_post_date', false );
$ed_blog      = get_theme_mod( 'ed_blog', true );

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 4,
    'ignore_sticky_posts' => true
);
?>
     <div class="container fluid">
    <div class="row" style="
        display: flex;
    justify-content: center;
    ">
        <h1 style="   
     padding-top: 50;
    padding-bottom: 30;
    text-align: center;
    ">
    NEWEST BLOG ENTRIES</h1>
<?php
$latest_posts = new WP_Query($args);

if ($latest_posts->have_posts()) :
    while ($latest_posts->have_posts()) :
        $latest_posts->the_post();
        ?>
   

        <div class="col-md-6" style="
                background: aliceblue;
               margin: 30px;
                width: 515;
                height: 250;
        ">
            <a href="<?php the_permalink(); ?>?>"
            style="text-decoration: none; color: black;"
            >
            <ul style="
              margin-left: 10px;
                padding: 0px;
                list-style: none;
                text-decoration: none;
                display: flex;
                margin-top: 15;
            ">
                <li class="img" style=" padding-top: 13%;">
                 <?php the_post_thumbnail();?>
                </li>
                <li style="padding: 10px;">
                    <div class="blog" style="
                        padding-top: 6%;
                    ">
                        <div class="title">
                            <h5>
                                <?php
                             the_title();
                             ?>
                            </h5>
                        </div>
                        <div class="content" style="    
                        font-size: 13;">
                            <p><?php
                              echo mb_substr( get_the_excerpt(),0,100);
                             ?>
                            </p>
                        </div>
                        <h5>
                            <a href="<?php the_permalink(); ?>?>" style="text-decoration: none;
                                    font-size: 15px;
                                    color: #ff6d00;">Read more</a>
                        </h5>
                    </div>
                </li>
            </ul>
            </a>
        </div>

        <?php
    endwhile;
    wp_reset_postdata();
else :
    echo 'Không có bài viết nào.';
endif;
?>
    </div>
</div>
