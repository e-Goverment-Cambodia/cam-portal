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
            <div class="b-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            <div class="b-date"><?php  cam_portal_posted_on(); ?></div>
        </div>
    </div>
</div>
<!-- End b-item-wrap -->