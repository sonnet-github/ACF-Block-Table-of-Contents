<?php
/**
 * Sectors we Specialize Template
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
    $background_color = get_field('background_color') ?: '#172438';
    $content_background_color = get_field('content_background_color') ?: '#FFFFFF';

    $image = get_field('image');
    $image_placement = get_field('image_placement');

    $heading = get_field('heading');
    $heading_color = get_field('heading_color') ?: '#EBB323';
    $heading_alignment = get_field('heading_alignment');

    $content_type = get_field('content_type');
    $content_alignment = get_field('content_alignment');
    $content_list = get_field('content_list');

    $queryHelper = new \SDEV\Helper\Query();

    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'sectors',
        'post_status' => 'publish',
        'posts_per_page' => '-1'
    ])
    ->setOrder('date', 'desc')
    ->setPageSize(-1)
    ->setPage(1)
    ->getList();


    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__sectors-we-specialize';
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

 <div class="block--custom-layout <?= $class_name ?>" style="background-color: <?= $background_color; ?>;">
        <div class="tb-wr container-block <?= $image_placement; ?>" style="background-color: <?= $content_background_color; ?>;">
            <div class="tb-c-wr image-cell va-middle">
                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
            </div>
            <div class="tb-c-wr text-cell va-middle">
                <h4 class="heading <?= $heading_alignment; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h4>
                <div class="sectors-list <?= $content_alignment; ?>">
                    <?php if ($content_type === 'sectors') : ?>
                        <?php foreach($posts as $pi => $pv) : ?>
                            <div class="sector-item">
                                <a href="<?= get_permalink($pv->ID) ?>">
                                    <?= $pv->post_title ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif ($content_type === 'manual') : ?>
                        <?php foreach($content_list as $si => $sv) : ?>
                            <div class="sector-item">
                                <a href="<?= $sv['link']['url']; ?>" target="<?= $sv['link']['target']; ?>" style="color: <?= $sv['text_color']; ?>">
                                    <?= $sv['link']['title']; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 </div>

<?php endif; ?>