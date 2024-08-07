<?php
/**
 * Listing Template
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

    $post_type = get_field('post_type');

    $getPostsID = get_posts(
        array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => '-1',
            'fields' => 'ids', // return an array of ids
        )
    );


    if ($post_type === 'blogs') {
        $selectText = "Let's talk about...";
        $postCategory = 'blog-category';
        $categoryList = get_terms([
            'object_ids' => $getPostsID,
            'taxonomy' => $postCategory,
            'hide_empty' => true, //false
        ]);
    } elseif ($post_type === 'newswire') {
        $selectText = "View news about...";
        $postCategory = 'category';
        $categoryList = get_terms([
            'object_ids' => $getPostsID,
            'taxonomy' => $postCategory,
            'hide_empty' => true, //false
            'exclude'    => array(1)
        ]);
    }

    $queryHelper = new \SDEV\Helper\Query();

    $posts = $queryHelper->setQueryArgs([
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => '-1',
    ])
    ->setOrder('date', 'desc')
    ->setPageSize(-1)
    ->setPage(1)
    ->getList();

    $thumbnail_caption = get_field('thumbnail_caption');

    $show_line = get_field('show_line');
    $show_mailing_form = get_field('show_mailing_form');
    
    $heading = get_field('heading');
    $heading_color = get_field('heading_color') ?: '#323F52';
    $heading_alignment = get_field('heading_alignment');

    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#323F52';
    $subheading_alignment = get_field('subheading_alignment');

    $form = get_field('form_shortcode');
    $customForm = get_field('custom_form');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__listing-page';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color: <?= $background; ?>">
        <div class="container-block">
            <div class="listing-content <?= $post_type; ?>">
                <div class="select-wrapper">
                    <select id="dropdown">
                        <option disabled selected><?= $selectText; ?></option>
                        <?php foreach ($categoryList as $term) { ?>
                            <option value=<?php echo $term->slug; ?>><?php echo $term->name; ?></option>
                        <?php } ?>
                    </select>
                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/dropdown-arrow.svg') ?>" alt="Dropdown arrow">
                </div>

                <div class="listing-wrapper">
                    <?php foreach($posts as $pi => $pv) : 
                        $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($pv->ID), "full", true);
                        $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                        if ($post_type === 'blogs') {
                            $terms = get_the_terms( $pv->ID, 'blog-category' ) ?: '';    
                        } elseif ($post_type === 'newswire') {
                            $terms = get_the_terms( $pv->ID, 'category' );
                        } 
                    ?>
                        <div class="item" data-category="<?php if (is_array($terms)) { foreach ( $terms as $term ) { echo $term->slug . ' '; } }?>">
                            <div class="thumbnail">
                                <a href="<?= get_permalink($pv->ID) ?>">
                                    <?php if (has_post_thumbnail($pv->ID)) : ?>
                                        <img src="<?php echo $feat_image[0]; ?>" alt="<?=$image_alt?>">
                                    <?php else : ?>
                                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/placeholder.png') ?>" alt="placeholder">
                                    <?php endif; ?> 
                                </a>
                                <div class="caption">
                                    <p>
                                        <?php if ($thumbnail_caption) : ?>
                                            <?= $thumbnail_caption ?>
                                        <?php elseif ($post_type === 'blogs') : ?>
                                            Blog
                                        <?php elseif ($post_type === 'newswire') : ?>
                                            Client news
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <p class="date">
                                <span><?php echo get_the_date('j F Y', $pv->ID); ?></span>
                                <?php if ($post_type === 'newswire') : ?> 
                                     
                                    <?php 
                                        $count = count($terms);
                                        foreach( $terms as $term ) { 
                                            if ($term->term_id > 1) {
                                                echo '• ';
                                            }
                                            if ($term->term_id != 1) { 
                                                echo $term->name; if ($count > 1) echo ', '; $count--;
                                            }
                                        }
                                    ?>
                                <?php endif; ?>
                            </p>
                            <div class="content">
                                <h4><?= $pv->post_title ?></h4>
                            </div>
                             <a href="<?= get_permalink($pv->ID) ?>">Find out more</a>   
                        </div>
                    <?php endforeach; ?>                               
                </div>
                       
                <div class="older-posts">
                    <a href="#">Older posts <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-down-gray.svg') ?>" alt="arrow down"></a>
                </div>

            </div>
            <?php if ($show_line) : ?>
                <hr>
            <?php endif; ?>
            <?php if ($show_mailing_form) : ?>
                <div class="mailing-form-container">
                    <h5 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h5>
                    <?php if ($subheading) : ?>
                        <h5 class="subtitle <?= $subheading_alignment; ?>" style="color: <?= $subheading_color; ?>"><?= $subheading ?></h5>
                    <?php endif; ?>         
                    <div class="form-container">
                        <?php if ($customForm) : ?>
                            <?= $customForm; ?>
                        <?php else : ?>
                            <?php echo @do_shortcode($form); ?>
                        <?php endif; ?>    
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>