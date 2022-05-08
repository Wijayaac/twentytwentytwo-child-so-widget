<div class="widget-custom">
    <?php echo wp_kses_post($instance['text']) ?>
</div>
<div class="img-wrapper">
    <img src="<?= wp_get_attachment_url(wp_kses_post($instance['image'])) ?>" alt="">
</div>