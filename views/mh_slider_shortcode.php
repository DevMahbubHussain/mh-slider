 <?php var_dump(MH_slider_settings::$options);?>
<h3><?php echo ( ! empty ( $content ) ) ? esc_html( $content ) : esc_html( MH_slider_settings::$options["'mh_slider_title'"] ); ?></h3>
<div class="mv-slider flexslider <?php echo esc_html(isset(MH_slider_settings::$options["mh_slider_style"]) ? MH_slider_settings::$options["mh_slider_style"] : 'style-1');?>">
    <ul class="slides">
        <?php
        $args = array(
            'post_type' =>'mh-slider',
            'post_status' =>'publish',
             'post__in' =>$id,
             'orderby'=>$orderby,
        );
        $my_query = new WP_Query($args);
            if($my_query->have_posts()):
                while($my_query->have_posts()):$my_query->the_post();
                $slider_title = get_post_meta(get_the_ID(), 'mv_slider_link_text', true);
                $slider_title_url = get_post_meta(get_the_ID(), 'mv_slider_link_url', true);
           ?>
            <li>
                <?php 
                    if( has_post_thumbnail() ) the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
                else
                    echo mv_slider_get_placeholder_image();
                    ?> 
                <div class="mvs-container">
                    <div class="slider-details-container">
                        <div class="wrapper">
                            <div class="slider-title">
                                <h2><?php the_title();?></h2>
                            </div>
                            <div class="slider-description">
                                <div class="subtitle"><?php echo esc_attr($slider_title);?></div>
                                <a class="link" href="<?php echo esc_url($slider_title_url);?>"><?php echo esc_attr($slider_title);?></a>
                            </div>
                        </div>
                    </div>              
                </div>
            </li>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
</div>