<?php
/**
 * Tab showing areas where user has access
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get current user ID
$user_id = get_current_user_id();
$user = wp_get_current_user();
?>

<h3>📍 Mina områden</h3>
<hr>
<p class="small">💡 Områden där du är medlem.</p>

<?php
        wp_reset_postdata();        
        // Store blog IDs (database suffixes) for sites the current user can access.
        $user_access_blog_ids = array();
        if ( $user_id > 0 ) {
            $user_blogs = get_blogs_of_user( $user_id, true );
            foreach ( $user_blogs as $user_blog ) {
                $site_blog_id = isset( $user_blog->userblog_id ) ? (int) $user_blog->userblog_id : 0;
                if ( $site_blog_id > 0 && ! is_main_site( $site_blog_id ) ) {
                    $user_access_blog_ids[] = $site_blog_id;
                }
            }
        }

        $user_access_blog_ids = array_values( array_unique( array_map( 'intval', $user_access_blog_ids ) ) );

        // Get posts with matching "area_blog_id" 
        $args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 50,
            'meta_query'     => array(
                array(
                    'key'     => 'area_blog_id',
                    'value'   => ! empty( $user_access_blog_ids ) ? $user_access_blog_ids : array( 0 ),
                    'compare' => 'IN',
                    'type'    => 'NUMERIC',
                ),
            ),
        );

        $the_query = new WP_Query( $args );
        $count_total = 0;
        if ( $the_query->have_posts() ) {
            foreach ( $the_query->posts as $area_post ) {
                $count_total++;
            }
        }
        ?>

        <!-- List header -->
        <div class="columns">
            <div class="column1">↓ <?php echo $count_total; ?> <?php echo $count_total === 1 ? 'område' : 'områden'; ?></div>
            <div class="column2"></div>
        </div>
        <hr>

        <!-- Posts output -->
        <div class="post-list">
            <?php if ( $the_query->have_posts() ) { ?>
                <?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
                    <?php get_template_part( 'templates/post-list/area-posts' ); ?>
                <?php } ?>
            <?php } else { ?>
			<p>💢 Du är inte medlem i något område.</p>
            <?php } ?>
        </div><!--post-list-->

        <p class="info">💡 Vi planerar att senare öppna för möjligheten att gå med i flera områden.</p>

        <?php wp_reset_postdata(); ?>