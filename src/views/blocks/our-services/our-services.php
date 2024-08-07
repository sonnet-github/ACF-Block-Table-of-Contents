<?php
/**
 * Our Services Template
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
    $title = get_field('title');
    $titleColor = get_field('title_color') ?: '#EBB323';
    $title_alignment = get_field('title_alignment');
    $subtitle = get_field('subtitle');
    $subtitle_color = get_field('subtitle_color') ?: '#EBB323';
    $subtitle_alignment = get_field('subtitle_alignment');

    $content_alignment = get_field('content_alignment');

    $background_color = get_field('background_color') ?: '#FFFFFF';

    $queryHelper = new \SDEV\Helper\Query();

    $post = $queryHelper->setQueryArgs([
        'post_type' => 'service',
        'post_status' => 'publish'
    ])
    ->setOrder('date', 'desc')
    ->setPageSize(-1)
    ->setPage(1)
    ->getList();



    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__our-services';
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
            <h3 class="<?= $title_alignment; ?>" style="color: <?= $titleColor; ?>"><?= $title; ?></h3>
            <?php if ($subtitle) : ?>
                <h5 class="subtitle <?= $subtitle_alignment; ?>" style="color: <?= $subtitle_color; ?>"><?= $subtitle; ?></h5>
            <?php endif; ?>
            <div class="list-container <?= $content_alignment; ?>">
                <?php if($post) :  foreach($post as $pi => $pv) : ?>
                    <a href="<?= get_permalink($pv->ID) ?>"><h4><?= $pv->post_title ?></h4></a>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>