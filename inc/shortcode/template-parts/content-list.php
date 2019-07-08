
<div class="b-item-wrap">
    <div class="b-item row">
        <div class="b-thumnail-wrap col-5">
            <div class="b-thumnail"><?php the_post_thumbnail(); ?></div>
        </div>
        <div class="b-title-wrap col-7">
            <div class="b-title"><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth( get_the_title(), 0, $a['title_length'], '...' ); ?></a></div>
            
            <?php if( filter_var( $a['excerpt'], FILTER_VALIDATE_BOOLEAN ) ) : ?>
                <div class="b-excerpt"><?php echo mb_strimwidth( get_the_excerpt(), 0, $a['excerpt_length'], ' <i> [..]</i>' ); ?></div>
            <?php endif; ?>

            <?php
            $date = filter_var( $a['date'], FILTER_VALIDATE_BOOLEAN );
            $author =filter_var( $a['author'], FILTER_VALIDATE_BOOLEAN ); 
            $post_view_count = filter_var( $a['post_view_count'], FILTER_VALIDATE_BOOLEAN );
            
            if( $date || $author || $post_view_count ) : ?>
            <div class="b-meta">
                <?php
                $date ? cam_portal_posted_on() : '';
                $author ? cam_portal_posted_by() : '';
                $post_view_count ? cam_portal_the_posted_view_count() : '';
                ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>