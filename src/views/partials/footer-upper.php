<?php
/**
 * Footer Upper Template (Footer Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    $phone = get_field('gen_phone_number', 'options');
    $email = get_field('gen_email_address', 'options');
    $location = get_field('gen_location', 'options');
    $icon_class = (defined('FOOTER_ALT_CLASS')) ? '-light' : '';
?>
<div class="pf-upper container-block">
    <div id="get-in-touch">
        <div class="git-heading">
            <h3><?= get_field('get_in_touch_heading', 'options')  ?></h3>
            <h5><?= get_field('get_in_touch_subheading', 'options')  ?></h5>
        </div>
        <div class="git-details">
            <div class="tb-wr">
                <div class="tb-c-wr spacer-cell"></div>
                <div class="tb-c-wr phone-cell">
                    <?php if($phone) : ?>
                        <a href="tel:<?= $phone ?>" target="_blank">
                            <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/phone-icon'.$icon_class.'.svg') ?>" alt="Phone Icon" />
                            <span><?= $phone ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="tb-c-wr email-cell">
                    <?php if($email) : ?>
                        <a href="mailto:<?= $email ?>" target="_blank">
                            <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/email-icon'.$icon_class.'.svg') ?>" alt="E-mail Icon" />
                            <span><?= $email ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="tb-c-wr location-cell">
                    <?php if($location) : ?>
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/location-pin-icon'.$icon_class.'.svg') ?>" alt="Location Pin Icon" />
                        <span><?= $location ?></span>
                    <?php endif; ?>
                </div>
                <div class="tb-c-wr spacer-cell"></div>
            </div>
        </div>
    </div>
</div>