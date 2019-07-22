<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cambodia_Portal
 */

?>

<div class="b-item-wrap">
    <div class="b-item row">
        <div class="b-thumnail-wrap col-5">
            <div class="b-thumnail"><?php cam_portal_the_post_thumbnail(); ?></div>
        </div>
        <div class="b-title-wrap col-7">
            <div class="b-title"><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth( get_the_title(), 0, 110, '...' ); ?></a></div>
			<div class="b-excerpt"><?php echo mb_strimwidth( get_the_excerpt(), 0, 180, '...' ); ?></div>
            <div class="b-meta">
                <?php
                cam_portal_posted_on();
                cam_portal_the_posted_view_count();
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End b-item-wrap -->