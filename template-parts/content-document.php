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
    <div class="b-item">
        <div class="b-title-wrap">
            <div class="b-title margin-bottom-15"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            <div class="b-cat">
                <span class="oi oi-calendar"></span>
                <?php  cam_portal_posted_on(); ?>

                <?php 
                $pdf_arr = get_post_meta( get_the_ID(), 'cam_group_pdf_items', true ); 
                if ( is_array( $pdf_arr ) && count( $pdf_arr ) ) {
                ?>
                <a href="<?php echo $pdf_arr[0]['pdf_url'];?>"><span class="oi oi-cloud-download"></span><?php echo __( 'ទាញយកឯកសារ', 'cam-portal' ); ?></a>
                <?php }?>

                <a href="<?php the_permalink(); ?>"><span class="oi oi-eye"></span><?php echo __( 'ចូលមើល', 'cam-portal' ); ?></a>
            </div>
        </div>
    </div>
</div>