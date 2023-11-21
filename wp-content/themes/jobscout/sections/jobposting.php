<?php
/**
 * Job Posting Section
 * 
 * @package JobScout
 */

$job_title         = get_theme_mod( 'job_posting_section_title', __( 'Job Posting', 'jobscout' ) );
$ed_jobposting     = get_theme_mod( 'ed_jobposting', true );
$count_posts       = wp_count_posts('job_listing'); 
if ( $ed_jobposting && jobscout_is_wp_job_manager_activated() && $job_title  ) {
    ?>
    <section id="job-posting-section" class="top-job-section">
        <div class="container">
            <?php 
                if( $job_title ) echo '<h2 class="section-title">'. esc_html( $job_title ) .'</h2>';
                if( jobscout_is_wp_job_manager_activated() && $count_posts->publish != 0 ){ 
                     ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo do_shortcode('[jobs show_filters="false" post_status="publish"]'); ?>
                        </div>
                    </div>
                <?php } 
            ?>
        </div>
    </section>
    <?php
}
?>

<style>
    .entry-meta{
        display: flex;
        align-items:center;
        background: var(--font-gray);
        border-radius: 25px;
        font-size: 16px !important;
        padding-top:0 !important;
    }
    .entry-meta > *{
        text-align: center;
        padding: 5px 15px;
        margin: 0 !important;
        border-right: 1px lightgray solid;
    }
    .job-type{
        text-transform: lowercase;
    }
    .company-address{
        border:none;
    }
    .date-time{
        color: lightgray;
    }
</style>