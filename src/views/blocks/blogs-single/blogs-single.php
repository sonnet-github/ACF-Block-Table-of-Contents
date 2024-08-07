<?php
/**
 * Blogs Single Template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    // Support custom "anchor" values.
    $anchor = '';
    if ( ! empty( $block['anchor'] ) ) {
        $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
    }

    // Get acf fields value and set default
    $background = get_field('background_color') ?: '#FFFFFF';

    $content = get_field('content');

    $show_share_icons = get_field('show_share_icons');
    $show_nav = get_field('show_nav');

    $show_slider = get_field('show_slider');
    $slider_type = get_field('slider_type');
    $slider_background_color = get_field('slider_background_color') ?: 'rgba(119, 148, 137, 0.05)';

    if ($slider_type === 'global') {
        $slider = get_field('bss_highlighted_posts','options');
    }
    else {
        $slider = $slider_manual;
    }

    $title = get_field('bss_title', 'options');
    $title_color = get_field('bss_title_color', 'options');
    $subtitle = get_field('bss_subtitle', 'options');
    $subtitle_color = get_field('bss_subtitle_color', 'options');

    $text_alignment = get_field('text_alignment', 'options');


    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__blogs-single';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color:<?= $background ?>;">
        <div class="container-block content-wrap">
            <div class="main-content">
                <?= $content; ?>
            </div>

            <?php if ($show_share_icons) : ?>
                <div class="share-icons">
                    <?php if (has_post_thumbnail(get_the_ID())) : 
                        $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "full", true);
                        $shareImg = $feat_image[0];
                    ?>
                    <?php else : 
                        $shareImg = \SDEV\Utils::getThemeResourcePath('assets/images/logo.png') ?>
                    <?php endif; ?> 
                    <a href="https://www.facebook.com/sharer/sharer.php?u=%20<?php echo get_permalink( get_the_ID() );?>" target="_blank">
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/fb-share.svg') ?>" alt="Facebook share icon">
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=%20<?php echo get_permalink( get_the_ID() );?>" target="_blank">
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/twitter-share.svg') ?>" alt="Twitter share icon">
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=%20<?php echo get_permalink( get_the_ID() );?>" target="_blank">
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/linkedin-share.svg') ?>" alt="Linkedin share icon">
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink( get_the_ID() );?>&media=<?= $shareImg; ?>&description=<?= the_title(); ?>" target="_blank">
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/pinterest-share.svg') ?>" alt="Pinterest share icon">
                    </a>
                    <a class="heart-icon" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30.849" height="26.993" viewBox="0 0 30.849 26.993">
                            <path id="Icon_awesome-heart" data-name="Icon awesome-heart" d="M27.854,4.093a8.239,8.239,0,0,0-11.243.819L15.424,6.136,14.237,4.913A8.239,8.239,0,0,0,2.994,4.093,8.652,8.652,0,0,0,2.4,16.62L14.056,28.658a1.889,1.889,0,0,0,2.729,0L28.444,16.62a8.646,8.646,0,0,0-.59-12.526Z" transform="translate(0.001 -2.248)" fill="#a8bfc7"/>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>

            <?php if ($show_slider) : ?>
                <div class="single-highlighted-slider" style="background-color: <?= $slider_background_color; ?>">
                    <div class="container-block">
                        <div class="content-wrap">
                            <div class="heading-wrap <?= $text_alignment; ?>">
                                <h2 class="<?php if ($subtitle) : ?>heading<?php endif; ?>" style="color: <?= $title_color; ?>"><?= $title; ?></h2>
                                <?php if ($subtitle) : ?>
                                    <h4 class="subtitle" style="color: <?= $subtitle_color; ?>"><?= $subtitle; ?></h4>
                                <?php endif; ?>
                                <?php if(is_admin() && isset($_GET['action']) && $_GET['action'] == 'edit'): ?>
                                    <h5 style="text-align: center;">Slider goes here<br/>(Live preview not available here)</h5>
                                <?php endif; ?>
                            </div>
                            <?php if($slider) : ?>
                                <div class="highlighted-slider owl-carousel" 
                                    data-prev="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-left-grey.svg') ?>" 
                                    data-next="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-right-grey.svg') ?>">
                                    <?php foreach($slider as $pi => $pv) : 
                                        $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($pv->ID), "full", true);
                                        $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                        $terms = get_the_terms( $pv->ID, 'category' );
                                    ?>
                                        <div class="list-item">
                                            <div class="thumbnail">
                                                <?php if (has_post_thumbnail($pv->ID)) : ?>
                                                    <img src="<?php echo $feat_image[0]; ?>" alt="<?=$image_alt?>">
                                                <?php else : ?>
                                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/placeholder.png') ?>" alt="placeholder">
                                                <?php endif; ?> 
                                            </div>
                                            <div class="content">
                                                <p class="date">
                                                        <span><?php echo get_the_date('j F Y', $pv->ID); ?></span> • 
                                                        <?php 
                                                            $count = count($terms);
                                                            foreach( $terms as $term ) { 
                                                                if ($term->term_id != 1) { 
                                                                    echo $term->name; if ($count > 1) echo ', '; $count--;
                                                                }
                                                            }
                                                        ?>
                                                </p>
                                                <h4><?= $pv->post_title ?></h4>
                                                <p><?= $pv->post_excerpt ?></p>
                                                <div class="cta-wrap">
                                                    <a href="<?= get_permalink($pv->ID) ?>">Find out more</a>
                                                </div>
                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($show_nav) : ?>
                <div class="container-block content-wrap">
                    <div class="next-posts">
                        <div class="prev">
                            <?php
                                $next_post = get_next_post();
                                $prev_post = get_previous_post();
                                if($next_post) {
                                    $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                            ?>
                                <a href="<?php echo get_permalink($next_post->ID); ?>">
                                    <p>Previous</p>
                                    <h4 class="desktop-only"><?= $next_title; ?></h4>
                                    <div class="categories desktop-only">
                                        <?php  
                                            $terms = get_the_terms( $next_post->ID , 'blog-category' );
                                            $count = count($terms);
                                            foreach( $terms as $term ) { 
                                                if ($term->term_id != 1) { ?>
                                                <?php echo $term->name; ?><?php if ($count > 1) echo ', '; $count--; ?>
                                        <?php } } ?>
                                    </div>
                                </a>
                            <?php } else { } ?>
                        </div>
                        <div class="next">
                            <?php
                                $next_post = get_next_post();
                                $prev_post = get_previous_post();
                                if($prev_post) {
                                    $prev_post = get_previous_post();
                                    $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title)); 
                                ?>
                                <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                    <p>Next</p>
                                    <h4 class="desktop-only"><?= $prev_title; ?></h4>
                                    <div class="categories desktop-only">
                                        <?php  
                                            $terms = get_the_terms( $prev_post->ID , 'category' );
                                            $count = count($terms);
                                            foreach( $terms as $term ) { 
                                                if ($term->term_id != 1) { ?>
                                                <?php echo $term->name; ?><?php if ($count > 1) echo ', '; $count--; ?>
                                        <?php } } ?>
                                    </div>
                                </a>
                            <?php } else { } ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="hidden-id"><?php echo get_the_ID(); ?></div>
    </div>
<?php endif; ?>