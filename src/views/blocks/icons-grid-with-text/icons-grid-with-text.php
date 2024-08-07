<?php
/**
 * Icons Grid with Text Template
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
    $heading_color = get_field('heading_color') ?: '#FFFFFF'; 
    $heading_alignment = get_field('heading_alignment');

    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#FFFFFF';
    $subheading_alignment = get_field('subheading_alignment');

    $background_color = get_field('background_color') ?: '#FFFFFF';

    $content_type = get_field('content_type');

    $queryHelper = new \SDEV\Helper\Query();

    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'service',
        'post_status' => 'publish',
        'posts_per_page' => '-1'
    ])
    ->setOrder('date', 'desc')
    ->setPageSize(-1)
    ->setPage(1)
    ->getList();

    $tiles = get_field('column_content');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__icons-grid-with-text';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color: <?= $background_color; ?>"> 
        <div class="container-block">
            <?php if ($heading) : ?>
                <h4 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h4>
            <?php endif; ?>
            <?php if ($subheading) : ?>
                <h4 style="color: <?= $subheading_color; ?>" class="subtitle <?= $subheading_alignment; ?>"><?= $subheading; ?></h4>
            <?php endif; ?>
            <div class="tiles-grid">
                <?php if ($content_type === 'services') : ?>
                    <?php foreach($posts as $pi => $pv) : 
                            $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($pv->ID), "full", true);
                            $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                    ?>
                        <div class="tile-item">
                            <a href="<?= get_permalink($pv->ID) ?>">
                                <?php if (has_post_thumbnail($pv->ID)) : ?>
                                    <img src="<?php echo $feat_image[0]; ?>" alt="<?=$image_alt?>">
                                <?php else : ?>
                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/placeholder.png') ?>" alt="placeholder">
                                <?php endif; ?> 
                                <h4><?= $pv->post_title ?></h4>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php elseif ($content_type === 'manual-input') : ?>
                    <?php foreach($tiles as $si => $sv) : ?>
                        <div class="tile-item">
                            <?php if ($sv['link']) : ?>
                                <a href="<?= $sv['link']['url']; ?>" target="<?= $sv['link']['target']; ?>">
                            <?php endif; ?>
                            <?php if ($sv['icon']) : ?>
                                <img src="<?= $sv['icon']['url']; ?>" alt="<?= $sv['icon']['alt']; ?>">
                            <?php endif; ?>
                            <h4 class="<?= $sv['title_alignment']; ?>" style="color: <?= $sv['title_color']; ?>"><?= $sv['title']; ?></h4>
                            <?php if ($sv['subtitle']) : ?>
                                <p class="<?= $sv['subtitle_alignment']; ?>" style="color: <?= $sv['subtitle_color']; ?>"><?= $sv['subtitle']; ?></p>
                            <?php endif; ?>

                            <?php if ($sv['link']) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>