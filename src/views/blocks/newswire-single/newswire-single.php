<?php
/**
 * Newswire Single Template
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
    $show_line = get_field('show_line');
    $show_nav = get_field('show_nav');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__newswire-single';
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
            <?php if ($show_line) : ?>
                <hr>
            <?php endif; ?>
            <?php if ($show_nav) : ?>
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
                                        $terms = get_the_terms( $next_post->ID , 'category' );
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
            <?php endif; ?>
        </div>

        <div class="hidden-id"><?php echo get_the_ID(); ?></div>
    </div>
<?php endif; ?>