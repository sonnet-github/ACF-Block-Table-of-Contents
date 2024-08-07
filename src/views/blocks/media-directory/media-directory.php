<?php
/**
 * Highlighted Slider Block Template
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
    $heading = get_field('heading');
    $heading_color = get_field('heading_color') ?: '#DB6D10';
    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#DB6D10';
    $text_alignment = get_field('text_alignment');

    $queryHelper = new \SDEV\Helper\Query();

    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'media-directory',
        'post_status' => 'publish',
        'posts_per_page' => '-1'
    ])
    ->setOrder('date', 'desc')
    ->setPageSize(-1)
    ->setPage(1)
    ->getList();

    $terms = get_terms([
        'taxonomy' => 'media-directory-category',
        'hide_empty' => false,
    ]);

    $tabsBG = get_field('tabs_background_color') ?: '#A8BFC7';
    $tabsText = get_field('tabs_text_color') ?: '#FFFFFF';
    $pubColor = get_field('tabs_text_color') ?: '#172438';
    $detailsColor = get_field('details_text_color') ?: '#172438';
    $detailsText = get_field('details_text') ?: '+ Details';

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__media-directory';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?>>
        <div class="container-block">
                <div class="heading-wrap <?= $text_alignment; ?>">
                    <h3 class="<?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h3>
                    <?php if ($subheading) : ?>
                        <h4 class="subheading" style="color: <?= $subheading_color; ?>"><?= $subheading; ?></h4>
                    <?php endif; ?>
                </div>
                <!-- TABS -->
                <div class="tabs-content">
                    <?php foreach ($terms as $term) { ?>
                        <a href="#" id="<?= $term->slug; ?>" style="background-color: <?= $tabsBG; ?>; color: <?= $tabsText; ?>">
                            <h4><?= $term->name; ?></h4>
                        </a>
                    <?php } ?>
                </div>

                <!-- MAIN CONTENT -->
                <div class="main-content-container">
                    <!-- Publication details --> 
                    <?php foreach ($terms as $term) { ?>
                        <?php if (get_field('publication_details', $term)) : ?>
                            <?php $pubAlignment = get_field('publication_details_alignment', $term) ?: 'center'; ?>
                            <div class="publication-container <?= $pubAlignment; ?>">
                                <p class="publication" id="<?= $term->slug; ?>" style="color: <?= $pubColor; ?>">
                                    <?php echo get_field('publication_details', $term); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    <?php } ?>

                    <div class="content-wrapper">
                        <div class="main-content">
                            <?php foreach($posts as $pi => $pv) : 
                                $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($pv->ID), "full", true);
                                $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $category = get_the_terms( $pv->ID, 'media-directory-category' );
                            ?>
                                <div class="post-item" id="<?php foreach ( $category as $categ ) { echo $categ->slug; } ?>">
                                    <div class="thumbnail">
                                        <?php if (has_post_thumbnail($pv->ID)) : ?>
                                            <img src="<?php echo $feat_image[0]; ?>" alt="<?=$image_alt?>">
                                        <?php else : ?>
                                            <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/placeholder.png') ?>" alt="placeholder">
                                        <?php endif; ?> 
                                    </div>
                                    <div class="details-container center">
                                        <a class="details" href="#">
                                            <p style="color: <?= $detailsColor; ?>">
                                                <?php if ($detailsText) : ?>
                                                    <?= $detailsText; ?>
                                                <?php else : ?>
                                                    + Details
                                                <?php endif; ?>
                                            </p>
                                        </a>
                                    </div>
                                    <div class="content" style="color: <?= $detailsColor; ?>">
                                        <?= the_field('details_content', $pv->ID); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (have_rows('sidebar_content')) : while (have_rows('sidebar_content')) : the_row(); ?>
                            <div class="sidebar-content">
                                <?php 
                                    $sidebarImage = get_sub_field('image'); 
                                    $sidebarLink = get_sub_field('link');
                                ?>
                                    <?php if ($sidebarLink) : ?>
                                        <a href="<?= $sidebarLink['url']; ?>" target="<?= $sidebarLink['target']; ?>">
                                    <?php endif; ?>
                                    <img src="<?= $sidebarImage['url']; ?>" alt="<?= $sidebarImage['alt']; ?>">
                                    <?php if ($sidebarLink) : ?>
                                        </a>
                                    <?php endif; ?>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>
            </div>
        </div>
    </div>

<?php endif; ?>